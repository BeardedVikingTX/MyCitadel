<?php
/* ============================================================================
 * ███ INCLUDES/MAILER.PHP ███
 * MyCitadel — SMTP Mailer (Web Side)
 * ----------------------------------------------------------------------------
 * Uses PHPMailer (installed in secure_mycitadel.lol/vendor) with SMTP
 * credentials loaded from the API's .env — one source of truth for mail.
 * ========================================================================== */

declare(strict_types=1);

if (!defined('CITADEL_CONFIG_LOADED')) {
    require_once __DIR__ . '/config.php';
}

/* ── Autoload PHPMailer from the secure core ─────────────────────────── */
$autoload = '/home/beardedviking/secure_mycitadel.lol/vendor/autoload.php';
if (!is_file($autoload)) {
    throw new RuntimeException('Composer autoload not found.');
}
require_once $autoload;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;


/**
 * Minimal .env reader — only loads values we need for mail.
 * We do NOT expose the whole env; only specific keys are surfaced.
 */
function citadel_web_env(string $key, ?string $default = null): ?string
{
    static $env = null;
    if ($env === null) {
        $env = [];
        $path = '/home/beardedviking/secure_mycitadel.lol/.env';
        if (is_readable($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '' || $line[0] === '#') continue;
                    $eq = strpos($line, '=');
                    if ($eq === false) continue;
                    $k = trim(substr($line, 0, $eq));
                    $v = trim(substr($line, $eq + 1));
                    if (strlen($v) >= 2) {
                        $f = $v[0]; $l = $v[-1];
                        if (($f === '"' && $l === '"') || ($f === "'" && $l === "'")) {
                            $v = substr($v, 1, -1);
                        }
                    }
                    $env[$k] = $v;
                }
            }
        }
    }
    $val = $env[$key] ?? null;
    return ($val === null || $val === '') ? $default : $val;
}


/**
 * Send an HTML email via SMTP. Returns true on success, false on failure.
 * Never leaks SMTP errors to the caller — logs them instead.
 *
 * @param string $to
 * @param string $subject
 * @param string $htmlBody
 * @param array  $opts  ['text' => string, 'reply_to' => string]
 */
function citadel_web_send_email(
    string $to,
    string $subject,
    string $htmlBody,
    array $opts = []
): bool {
    // Reject header injection attempts
    if (preg_match('/[\r\n]/', $to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
        @error_log('[web-mailer] invalid recipient');
        return false;
    }
    if (preg_match('/[\r\n]/', $subject)) {
        @error_log('[web-mailer] invalid subject');
        return false;
    }

    $host     = citadel_web_env('MAIL_HOST');
    $port     = (int) citadel_web_env('MAIL_PORT', '587');
    $username = citadel_web_env('MAIL_USERNAME');
    $password = citadel_web_env('MAIL_PASSWORD');
    $encrypt  = citadel_web_env('MAIL_ENCRYPTION', 'tls');
    $fromAddr = citadel_web_env('MAIL_FROM_ADDRESS', 'noreply@mycitadel.lol');
    $fromName = citadel_web_env('MAIL_FROM_NAME', 'MyCitadel');
    $replyTo  = $opts['reply_to'] ?? citadel_web_env('MAIL_REPLY_TO', $fromAddr);

    if (!$host || !$username || !$password) {
        @error_log('[web-mailer] SMTP not configured');
        return false;
    }

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $host;
        $mail->Port       = $port;
        $mail->SMTPAuth   = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->SMTPSecure = ($encrypt === 'ssl')
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPDebug  = 0;

        $mail->setFrom($fromAddr, $fromName);
        $mail->addReplyTo($replyTo, $fromName);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = $opts['text'] ?? strip_tags(str_replace(
            ['<br>', '<br/>', '<br />', '</p>'],
            ["\n", "\n", "\n", "\n\n"],
            $htmlBody
        ));

        $mail->send();
        return true;

    } catch (PHPMailerException $e) {
        @error_log('[web-mailer] SMTP failed: ' . $e->getMessage());
        return false;
    } catch (Throwable $e) {
        @error_log('[web-mailer] unexpected: ' . $e->getMessage());
        return false;
    }
}