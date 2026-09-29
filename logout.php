<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/LOGOUT.PHP ███
 * Server-side rendered logout shell. The actual session termination
 * happens via the API on the api.mycitadel.lol origin — the browser
 * must make that call because the session cookie lives there, not here.
 *
 * This page exists so that direct navigation to /logout works:
 *   • Nav link click  → nav.js handles it inline (already wired)
 *   • Direct URL hit  → this page loads, logout.js terminates the session,
 *                       redirects home
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Logging Out — MyCitadel',
    'description' => 'Ending your Citadel session.',
    'og_title'    => 'Logging Out — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/logout',
    'canonical'   => CITADEL_SITE_URL . '/logout',
    'body_class'  => 'page-logout',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$LOGIN_URL     = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
$HOME_URL      = '/';
?>

<div class="logout-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
     data-home-url="<?= htmlspecialchars($HOME_URL, ENT_QUOTES, 'UTF-8') ?>">

    <div class="logout-card" id="logout-card">
        <div class="logout-spinner" aria-hidden="true"></div>
        <h1>Signing you out…</h1>
        <p>Ending your session. You'll be redirected in a moment.</p>
    </div>

    <div class="logout-done" id="logout-done" hidden>
        <div class="logout-done__icon" aria-hidden="true">⏻</div>
        <h1>Signed Out</h1>
        <p>Your session has ended. Stay safe out there, Citizen.</p>
        <a href="/" class="btn-cyber">Return Home</a>
        <a href="/login" class="btn-cyber btn-gold">Log Back In</a>
    </div>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/logout.js?v=<?= @filemtime('/home/beardedviking/vendors.mycitadel.lol/js/logout.js') ?: time() ?>" defer></script>

<?php require __DIR__ . '/includes/footer.php'; ?>