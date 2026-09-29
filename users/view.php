<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/USERS/VIEW.PHP ███
 * Public/connected profile viewer.
 * ----------------------------------------------------------------------------
 * SECURITY MODEL
 *   • NO user input processed server-side except ?id=N (cast to int).
 *   • Every byte of user content is rendered client-side from a JSON API
 *     response, escaped with textContent or the esc() helper.
 *   • All authorization is enforced by /v1/users/view.php — this page cannot
 *     reveal more than the API chooses to return.
 *   • If the API returns 404, we show the same generic message for hidden,
 *     blocked, or non-existent users (no enumeration oracle).
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

// Read id here only to build the canonical/OG URL. Never trusted for anything else.
$targetId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

citadel_set_meta([
    'title'       => 'Profile — MyCitadel',
    'description' => 'A Citizen of the Citadel.',
    'og_title'    => 'Profile — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/users/view' . ($targetId > 0 ? '?id=' . $targetId : ''),
    'canonical'   => CITADEL_SITE_URL . '/users/view' . ($targetId > 0 ? '?id=' . $targetId : ''),
    'body_class'  => 'page-user-view',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$LOGIN_URL     = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
?>

<div class="user-view-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
     data-target-id="<?= (int) $targetId ?>">

    <div class="user-view-toast-layer" id="user-view-toast-layer" aria-live="polite"></div>

    <!-- Loading -->
    <div class="user-view-loading" id="user-view-loading">
        <div class="user-view-loading__spinner" aria-hidden="true"></div>
        <p class="user-view-loading__text">Loading profile…</p>
    </div>

    <!-- Not found / unauthorized — identical message for all cases -->
    <div class="user-view-notfound" id="user-view-notfound" hidden>
        <div class="user-view-notfound__icon" aria-hidden="true">ᚱ</div>
        <h1>Citizen Not Found</h1>
        <p>This Citizen does not exist, or you do not have permission to view them.</p>
        <a href="/users" class="btn-cyber">Browse Citizens</a>
    </div>

    <!-- Generic error (network, 500, etc.) -->
    <div class="user-view-error" id="user-view-error" hidden>
        <div class="user-view-error__icon" aria-hidden="true">⚠</div>
        <h1>Could Not Load Profile</h1>
        <p id="user-view-error-msg">Something went wrong.</p>
        <button type="button" class="btn-cyber" id="user-view-retry">Retry</button>
    </div>

    <!-- Main content, populated by JS -->
    <main class="user-view-shell" id="user-view-shell" hidden>
        <div class="user-view-hero" id="user-view-hero"></div>
        <div class="user-view-actions" id="user-view-actions"></div>
        <div class="user-view-body" id="user-view-body"></div>
        <div class="user-view-badges" id="user-view-badges" hidden></div>
    </main>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/user-view.js?v=<?= @filemtime('/home/beardedviking/vendors.mycitadel.lol/js/user-view.js') ?: time() ?>" defer></script>

<?php require __DIR__ . '/../includes/footer.php'; ?>