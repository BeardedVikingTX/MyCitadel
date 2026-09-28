<?php
/* ============================================================================
 * ███ I.PHP ███
 * MyCitadel — Image & Media Serving Proxy
 * ----------------------------------------------------------------------------
 * Path   : /home/beardedviking/mycitadel.lol/i.php
 * Route  : Rewritten from /i/{path}  →  /i.php?p={path}
 *
 * Serves user uploads from secure_mycitadel.lol/uploads/ (outside webroot).
 *
 * Two path shapes are supported:
 *
 *   1. Profile images (deterministic, filename-based):
 *         /i/avatar/4/a3f8e2b9c1d4e5f6.jpg
 *         /i/banner/4/a3f8e2b9c1d4e5f6.jpg
 *         /i/wallpaper/4/a3f8e2b9c1d4e5f6.jpg
 *
 *   2. Media attachments (token-based, DB-looked-up):
 *         /i/media/{32-hex-token}
 *
 * WHY A PROXY INSTEAD OF DIRECT SERVING
 *   1. Files live outside the webroot — cannot be executed even if the
 *      web server is misconfigured.
 *   2. Paths are validated with strict regexes before any filesystem access.
 *   3. Cache headers are under our control.
 *   4. Media tokens never expose user_id or the storage path.
 * ========================================================================== */

declare(strict_types=1);

header_remove('X-Powered-By');

define('CITADEL_ROOT', '/home/beardedviking/secure_mycitadel.lol');

$path = $_GET['p'] ?? '';
if (!is_string($path) || $path === '') {
    http_response_code(404);
    exit;
}

/* ══════════════════════════════════════════════════════════════════════════
 * ROUTE 1 — MEDIA ATTACHMENTS
 * --------------------------------------------------------------------------
 * Pattern: media/{32-hex-token}
 * The token maps to a row in post_attachments. We stream whatever that
 * row points at — image, video, audio, or document.
 * ═══════════════════════════════════════════════════════════════════════ */

if (preg_match('#^media/([a-f0-9]{32})$#', $path, $m)) {
    citadel_serve_media($m[1]);
    exit;
}

/* ══════════════════════════════════════════════════════════════════════════
 * ROUTE 2 — PROFILE IMAGES (avatar / banner / wallpaper)
 * --------------------------------------------------------------------------
 * Pattern: (avatar|banner|wallpaper)/{user_id}/{16-hex}.jpg
 * Deterministic — the filename IS the key. No DB lookup needed.
 * ═══════════════════════════════════════════════════════════════════════ */

if (!preg_match('#^(avatar|banner|wallpaper)/(\d+)/([a-f0-9]{16}\.jpg)$#', $path, $m)) {
    http_response_code(404);
    exit;
}

$storageType = $m[1];
$userId      = (int) $m[2];
$file        = $m[3];

if ($userId <= 0) {
    http_response_code(404);
    exit;
}

$fullPath = CITADEL_ROOT . '/uploads/' . $storageType . '/' . $userId . '/' . $file;

/* Belt & suspenders: realpath containment check. */
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

citadel_stream_file($realFile, 'image/jpeg', basename($realFile));
exit;

/* ══════════════════════════════════════════════════════════════════════════
 * MEDIA SERVING — token lookup + streaming
 * ========================================================================== */

function citadel_serve_media(string $token): void
{
    /* Bootstrap gives us DB access + the attachments helpers. */
    $bootstrap = '/home/beardedviking/api.mycitadel.lol/v1/bootstrap.php';
    if (!is_file($bootstrap)) {
        http_response_code(500);
        exit;
    }

    require_once $bootstrap;
    require_once CITADEL_CONFIG . '/db.php';
    require_once CITADEL_CONFIG . '/attachments.php';

    $att = citadel_media_lookup($token);
    if ($att === null) {
        http_response_code(404);
        exit;
    }

    $stored = (string) $att['stored_path'];
    if (!is_file($stored)) {
        http_response_code(404);
        exit;
    }

    $mime = (string) $att['mime_type'];
    $kind = (string) $att['kind'];
    $name = (string) ($att['original_name'] ?? ('file.' . pathinfo($stored, PATHINFO_EXTENSION)));

    /* Docs are forced to download; images/video/audio stream inline. */
    $disposition = in_array($kind, ['image', 'video', 'audio'], true)
        ? 'inline'
        : 'attachment';

    citadel_stream_file($stored, $mime, $name, $disposition, $token);
}

/* ══════════════════════════════════════════════════════════════════════════
 * STREAMING HELPER — shared by both routes
 * ========================================================================== */

function citadel_stream_file(
    string $realFile,
    string $mime,
    string $filename,
    string $disposition = 'inline',
    ?string $etagKey = null
): void {
    $size = @filesize($realFile);
    if ($size === false) {
        http_response_code(404);
        exit;
    }

    /* ETag — cheap fingerprint. Uses the token when available so we don't
     * hash the whole file on every request. */
    $etag = $etagKey !== null
        ? '"' . $etagKey . '"'
        : '"' . substr(hash_file('sha256', $realFile), 0, 16) . '"';

    if (isset($_SERVER['HTTP_IF_NONE_MATCH'])
        && trim($_SERVER['HTTP_IF_NONE_MATCH']) === $etag
    ) {
        http_response_code(304);
        exit;
    }

    /* Flush any buffered output before streaming binary data. */
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    header('Content-Type: ' . $mime);
    header('Content-Length: ' . $size);
    header('Content-Disposition: ' . $disposition
        . '; filename="' . rawurlencode($filename) . '"');
    header('Cache-Control: public, max-age=31536000, immutable');
    header('Pragma: public');
    header('X-Content-Type-Options: nosniff');
    header('ETag: ' . $etag);

    readfile($realFile);
    exit;
}