<?php
declare(strict_types=1);

require_once '/home/beardedviking/api.mycitadel.lol/v1/bootstrap.php';
require_once CITADEL_CONFIG . '/db.php';
require_once CITADEL_CONFIG . '/attachments.php';

$token = $_GET['t'] ?? '';
if (!is_string($token) || !preg_match('/^[a-f0-9]{32}$/', $token)) {
    http_response_code(404); exit('Not found');
}

$att = citadel_media_lookup($token);
if ($att === null || !is_file($att['stored_path'])) {
    http_response_code(404); exit('Not found');
}

$mime = (string) $att['mime_type'];
$kind = (string) $att['kind'];
$name = (string) ($att['original_name'] ?? 'file');

$inline = in_array($kind, ['image', 'video', 'audio'], true);
$etag   = '"' . $token . '"';

if (($_SERVER['HTTP_IF_NONE_MATCH'] ?? '') === $etag) {
    http_response_code(304); exit;
}

while (ob_get_level() > 0) ob_end_clean();

header('Content-Type: ' . $mime);
header('Content-Length: ' . (int) $att['file_size']);
header('Content-Disposition: ' . ($inline ? 'inline' : 'attachment') . '; filename="' . rawurlencode($name) . '"');
header('Cache-Control: public, max-age=31536000, immutable');
header('ETag: ' . $etag);
header('X-Content-Type-Options: nosniff');

if ($kind === 'image' && $att['width'] && $att['height']) {
    header('X-Image-Width: '  . (int) $att['width']);
    header('X-Image-Height: ' . (int) $att['height']);
}

readfile($att['stored_path']);
exit;