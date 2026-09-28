<?php
/* ============================================================================
 * ███ I.PHP ███
 * MyCitadel — Image Serving Proxy
 * ----------------------------------------------------------------------------
 * Path   : /home/beardedviking/mycitadel.lol/i.php
 * Route  : Rewritten to from /i/{type}/{user_id}/{filename}
 *
 * Serves user uploads from secure_mycitadel.lol/uploads/ (outside webroot).
 *
 * WHY A PROXY INSTEAD OF DIRECT SERVING
 *   1. Files live outside the webroot — cannot be executed even if the
 *      web server is misconfigured.
 *   2. Path is validated with a strict regex before any filesystem access.
 *   3. Cache headers are under our control.
 *   4. Swapping to a CDN later is a single-file change.
 *
 * .htaccess in mycitadel.lol/ should contain:
 *   RewriteEngine On
 *   RewriteRule ^i/(.+)$ /i.php?p=$1 [L,QSA]
 * ========================================================================== */

declare(strict_types=1);
// Hide PHP version — consistent with the API endpoints.
header_remove('X-Powered-By');
define('CITADEL_ROOT', '/home/beardedviking/secure_mycitadel.lol');

// Path from the URL
$path = $_GET['p'] ?? '';
if (!is_string($path) || $path === '') {
    http_response_code(404);
    exit;
}

// Strict validation. NO user-controlled characters reach the filesystem.
if (!preg_match('#^(avatar|banner|wallpaper)/(\d+)/([a-f0-9]{16}\.jpg)$#', $path, $m)) {
    http_response_code(404);
    exit;
}

$storageType = $m[1];
$userId      = (int) $m[2];
$file        = $m[3];

// Sanity check the user_id range
if ($userId <= 0 || $userId > PHP_INT_MAX) {
    http_response_code(404);
    exit;
}

$fullPath = CITADEL_ROOT . '/uploads/' . $storageType . '/' . $userId . '/' . $file;

// Belt & suspenders: realpath check. Reject if outside our uploads dir.
$realBase = realpath(CITADEL_ROOT . '/uploads');
$realFile = realpath($fullPath);

if ($realBase === false || $realFile === false) {
    http_response_code(404);
    exit;
}

if (!str_starts_with($realFile, $realBase . DIRECTORY_SEPARATOR)) {
    http_response_code(404);
    exit;
}

if (!is_file($realFile)) {
    http_response_code(404);
    exit;
}

// ── Headers ──────────────────────────────────────────────────────────────
// Content-Type is always image/jpeg — we only store JPEGs.
header('Content-Type: image/jpeg');

// Immutable caching — filenames are content-unique (random hex).
// A given URL will never point to different content.
header('Cache-Control: public, max-age=' . 31536000 . ', immutable');
header('Pragma: public');

// Content-Length so clients can show progress
$size = filesize($realFile);
if ($size !== false) {
    header('Content-Length: ' . $size);
}

// Defensive headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Content-Disposition: inline; filename="' . $file . '"');

// ETag for conditional requests
$etag = '"' . substr(hash_file('sha256', $realFile), 0, 16) . '"';
header('ETag: ' . $etag);

if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === $etag) {
    http_response_code(304);
    exit;
}

// ── Stream the file ──────────────────────────────────────────────────────
// Disable any output buffering to avoid memory spikes
while (ob_get_level() > 0) { ob_end_clean(); }

readfile($realFile);
exit;