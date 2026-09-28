<?php
/* ============================================================================
 * ███ INCLUDES/CONTACT-HANDLER.PHP ███
 * Contact Form — Validation, Anti-Bot, Routing, Dispatch
 * ----------------------------------------------------------------------------
 * Design principles:
 *   • Fail silently for bots — always return success to the browser so
 *     the attacker gets no signal that they were detected.
 *   • Fail loudly for humans — real errors get real messages.
 *   • Log every rejection for security monitoring.
 * ========================================================================== */

declare(strict_types=1);

if (!defined('CITADEL_CONFIG_LOADED')) {
    require_once __DIR__ . '/config.php';
}
require_once __DIR__ . '/mailer.php';


/* ══════════════════════════════════════════════════════════════════════════
 * ROTATING VERIFICATION PHRASES
 * --------------------------------------------------------------------------
 * Short, thematic, easy to type. Rotated per-session. Stored in $_SESSION
 * so the client cannot see what phrase is expected until they've loaded
 * the form (which triggers session creation).
 * ========================================================================== */

function citadel_contact_phrases(): array
{
    return [
        'runic shield',
        'iron wolf',
        'frost giant',
        'mead hall',
        'longship oars',
        'bifrost bridge',
        'valhalla gate',
        'rune stone',
        'northern star',
        'raven wing',
    ];
}


/* ══════════════════════════════════════════════════════════════════════════
 * DEPARTMENT ROUTING
 * ========================================================================== */

function citadel_contact_departments(): array
{
    return [
        'general' => [
            'label'   => 'General Inquiry',
            'email'   => 'info@mycitadel.lol',
            'target'  => 'the MyCitadel team',
            'subject_prefix' => '[General]',
        ],
        'developer' => [
            'label'   => 'Contact the Developer',
            'email'   => 'beardedviking@mycitadel.lol',
            'target'  => 'Bearded Viking',
            'subject_prefix' => '[Developer]',
        ],
        'security' => [
            'label'   => 'Security / Bug Bounty',
            'email'   => 'security@mycitadel.lol',
            'target'  => 'the security team',
            'subject_prefix' => '[Security]',
        ],
    ];
}


/* ══════════════════════════════════════════════════════════════════════════
 * RATE LIMITING (per IP, file-backed)
 * ========================================================================== */

function citadel_contact_rate_limit(string $ip, int $max, int $window): bool
{
    $dir = '/home/beardedviking/secure_mycitadel.lol/logs/contact';
    if (!is_dir($dir)) @mkdir($dir, 0700, true);

    $key = hash('sha256', $ip . '|contact');
    $file = $dir . '/rl_' . $key . '.json';

    $now = time();
    $hits = [];
    if (is_file($file)) {
        $raw = @file_get_contents($file);
        if ($raw !== false) {
            $arr = json_decode($raw, true);
            if (is_array($arr)) {
                $hits = array_filter($arr, fn($t) => is_int($t) && $t > $now - $window);
            }
        }
    }

    if (count($hits) >= $max) return false;

    $hits[] = $now;
    @file_put_contents($file, json_encode(array_values($hits)), LOCK_EX);
    return true;
}


/* ══════════════════════════════════════════════════════════════════════════
 * REQUEST LOGGING (only successful or suspicious attempts)
 * ========================================================================== */

function citadel_contact_log(string $event, array $ctx = []): void
{
    $dir = '/home/beardedviking/secure_mycitadel.lol/logs/contact';
    if (!is_dir($dir)) @mkdir($dir, 0700, true);

    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $ipHash = substr(hash('sha256', $ip . '|' . (citadel_web_env('APP_KEY', 'x'))), 0, 16);

    $entry = array_merge([
        'ts'         => gmdate('c'),
        'event'      => $event,
        'ip_hash'    => $ipHash,
        'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 200),
        'uri'        => $_SERVER['REQUEST_URI'] ?? '',
    ], $ctx);

    @file_put_contents(
        $dir . '/contact.log',
        json_encode($entry, JSON_UNESCAPED_SLASHES) . "\n",
        FILE_APPEND | LOCK_EX
    );
}


/* ══════════════════════════════════════════════════════════════════════════
 * MAIN HANDLER
 * --------------------------------------------------------------------------
 * Returns:
 *   ['ok' => true, 'silent' => bool, 'message' => string]
 *   ['ok' => false, 'message' => string, 'field' => string]
 *
 * `silent` = true means it was a bot — report success to the client,
 * but do NOT send anything and do NOT signal detection.
 * ========================================================================== */

function citadel_contact_handle(array $post): array
{
    /* ── 1. CSRF check ────────────────────────────────────────────────── */
    $csrf = (string) ($post['_csrf'] ?? '');
    $sessionCsrf = (string) ($_SESSION['contact_csrf'] ?? '');
    if ($csrf === '' || $sessionCsrf === '' || !hash_equals($sessionCsrf, $csrf)) {
        citadel_contact_log('csrf_fail');
        return ['ok' => false, 'message' => 'Session expired. Please refresh the page and try again.', 'field' => '_csrf'];
    }

    /* ── 2. Time gate ─────────────────────────────────────────────────── */
    $loadedAt = (int) ($_SESSION['contact_loaded_at'] ?? 0);
    $elapsed  = time() - $loadedAt;

    if ($loadedAt === 0 || $elapsed < 4) {
        // Suspiciously fast — likely a bot
        citadel_contact_log('too_fast', ['elapsed' => $elapsed]);
        return ['ok' => true, 'silent' => true, 'message' => 'Message received.'];
    }
    if ($elapsed > 3600) {
        return ['ok' => false, 'message' => 'Your session has expired. Please refresh and try again.', 'field' => null];
    }

    /* ── 3. Triple honeypot ───────────────────────────────────────────── */
    // Any of these being filled means a bot filled it, because humans
    // cannot see them.
    foreach (['website', 'company', 'fax'] as $trap) {
        if (!empty($post[$trap])) {
            citadel_contact_log('honeypot_' . $trap);
            return ['ok' => true, 'silent' => true, 'message' => 'Message received.'];
        }
    }

    /* ── 4. Verification phrase ───────────────────────────────────────── */
    $expected = (string) ($_SESSION['contact_phrase'] ?? '');
    $supplied = trim((string) ($post['phrase'] ?? ''));

    if ($expected === '' || $supplied === '') {
        return ['ok' => false, 'message' => 'Please type the verification phrase shown above.', 'field' => 'phrase'];
    }
    if (strcasecmp($expected, $supplied) !== 0) {
        citadel_contact_log('phrase_mismatch');
        return ['ok' => false, 'message' => 'That phrase does not match. Please try again.', 'field' => 'phrase'];
    }

    /* ── 5. Field validation ──────────────────────────────────────────── */
    $name        = trim((string) ($post['name'] ?? ''));
    $email       = trim((string) ($post['email'] ?? ''));
    $subject     = trim((string) ($post['subject'] ?? ''));
    $message     = trim((string) ($post['message'] ?? ''));
    $department  = (string) ($post['department'] ?? 'general');

    if ($name === '' || mb_strlen($name) > 120) {
        return ['ok' => false, 'message' => 'Please provide your name.', 'field' => 'name'];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 254) {
        return ['ok' => false, 'message' => 'Please provide a valid email address.', 'field' => 'email'];
    }
    if ($subject === '' || mb_strlen($subject) > 200) {
        return ['ok' => false, 'message' => 'Please provide a subject (up to 200 characters).', 'field' => 'subject'];
    }
    if (mb_strlen($message) < 20 || mb_strlen($message) > 5000) {
        return ['ok' => false, 'message' => 'Message must be between 20 and 5000 characters.', 'field' => 'message'];
    }

    $departments = citadel_contact_departments();
    if (!isset($departments[$department])) {
        $department = 'general';
    }
    $dept = $departments[$department];

    /* ── 6. Rate limit ────────────────────────────────────────────────── */
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if (!citadel_contact_rate_limit($ip, 3, 3600)) {
        citadel_contact_log('rate_limited');
        return ['ok' => false, 'message' => 'Too many submissions. Please wait before trying again.', 'field' => null];
    }

    /* ── 7. Sanitize for output ───────────────────────────────────────── */
    $safeName    = htmlspecialchars($name,    ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeEmail   = htmlspecialchars($email,   ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeSubject = htmlspecialchars($subject, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));

    $ipHash = substr(hash('sha256', $ip . '|' . (citadel_web_env('APP_KEY', 'x'))), 0, 16);
    $when   = gmdate('Y-m-d H:i:s \U\T\C');

    /* ── 8. Compose recipient email ───────────────────────────────────── */
    $fullSubject = $dept['subject_prefix'] . ' ' . $subject;

    $recipientBody = <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="font-family:Inter,Arial,sans-serif;background:#05070a;color:#e0e6ed;padding:32px;margin:0;">
  <div style="max-width:600px;margin:0 auto;background:#10151d;border:1px solid rgba(0,229,255,0.22);border-radius:14px;padding:32px;">
    <h1 style="font-family:Georgia,serif;color:#7df9ff;letter-spacing:0.08em;text-transform:uppercase;margin:0 0 4px;">MyCitadel</h1>
    <p style="color:#475569;font-size:12px;letter-spacing:0.15em;text-transform:uppercase;margin:0 0 24px;">New Contact Form Submission</p>

    <table style="width:100%;border-collapse:collapse;font-size:14px;">
      <tr><td style="padding:8px 0;color:#94a3b8;width:120px;">Name</td><td style="padding:8px 0;color:#e0e6ed;">{$safeName}</td></tr>
      <tr><td style="padding:8px 0;color:#94a3b8;">Email</td><td style="padding:8px 0;color:#e0e6ed;"><a href="mailto:{$safeEmail}" style="color:#00e5ff;">{$safeEmail}</a></td></tr>
      <tr><td style="padding:8px 0;color:#94a3b8;">Department</td><td style="padding:8px 0;color:#d4af37;">{$dept['label']}</td></tr>
      <tr><td style="padding:8px 0;color:#94a3b8;">Subject</td><td style="padding:8px 0;color:#e0e6ed;">{$safeSubject}</td></tr>
      <tr><td style="padding:8px 0;color:#94a3b8;">Received</td><td style="padding:8px 0;color:#e0e6ed;font-family:monospace;">{$when}</td></tr>
    </table>

    <hr style="border:none;border-top:1px solid rgba(0,229,255,0.15);margin:24px 0;">

    <div style="padding:16px;background:#0a0e14;border-left:3px solid #00e5ff;border-radius:6px;font-size:14px;line-height:1.7;color:#e0e6ed;">
      {$safeMessage}
    </div>

    <p style="color:#475569;font-size:11px;margin-top:24px;">
      Source IP hash: <code>{$ipHash}</code>
    </p>
  </div>
</body></html>
HTML;

    /* ── 9. Compose sender confirmation ───────────────────────────────── */
    $senderBody = <<<HTML
<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="font-family:Inter,Arial,sans-serif;background:#05070a;color:#e0e6ed;padding:32px;margin:0;">
  <div style="max-width:600px;margin:0 auto;background:#10151d;border:1px solid rgba(0,229,255,0.22);border-radius:14px;padding:32px;">
    <h1 style="font-family:Georgia,serif;color:#7df9ff;letter-spacing:0.08em;text-transform:uppercase;margin:0 0 4px;">MyCitadel</h1>
    <p style="color:#475569;font-size:12px;letter-spacing:0.15em;text-transform:uppercase;margin:0 0 24px;">Message Received</p>

    <p>Hello <strong style="color:#e0e6ed;">{$safeName}</strong>,</p>

    <p>We received your message and will route it to <strong style="color:#d4af37;">{$dept['target']}</strong>. If a reply is required, expect to hear back within 2–3 business days.</p>

    <p style="color:#94a3b8;font-size:13px;margin-top:24px;">For your records, here is a copy of what you sent:</p>

    <table style="width:100%;border-collapse:collapse;font-size:14px;">
      <tr><td style="padding:6px 0;color:#94a3b8;width:120px;">Subject</td><td style="padding:6px 0;color:#e0e6ed;">{$safeSubject}</td></tr>
      <tr><td style="padding:6px 0;color:#94a3b8;">Department</td><td style="padding:6px 0;color:#d4af37;">{$dept['label']}</td></tr>
    </table>

    <div style="margin-top:16px;padding:16px;background:#0a0e14;border-left:3px solid #00e5ff;border-radius:6px;font-size:14px;line-height:1.7;color:#e0e6ed;">
      {$safeMessage}
    </div>

    <p style="color:#475569;font-size:12px;margin-top:32px;">
      Do not reply to this email — it is an automated confirmation. To continue the
      conversation, use the address that reached out to you.
    </p>
  </div>
</body></html>
HTML;

    /* ── 10. Send ─────────────────────────────────────────────────────── */
    $sentToRecipient = citadel_web_send_email(
        $dept['email'],
        $fullSubject,
        $recipientBody,
        ['reply_to' => $email]
    );

    // Sender copy — non-fatal if it fails
    if ($sentToRecipient) {
        citadel_web_send_email(
            $email,
            'We received your message — MyCitadel',
            $senderBody
        );
    }

    if (!$sentToRecipient) {
        citadel_contact_log('send_failed', ['department' => $department]);
        return ['ok' => false, 'message' => 'Could not send your message. Please try again later.', 'field' => null];
    }

    citadel_contact_log('sent', ['department' => $department]);

    // Clear the phrase and CSRF so they cannot be reused
    unset($_SESSION['contact_phrase'], $_SESSION['contact_csrf']);

    return [
        'ok'      => true,
        'silent'  => false,
        'message' => "Thank you. Your message has been sent to {$dept['target']}.",
    ];
}