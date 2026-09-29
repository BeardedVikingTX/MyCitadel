<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Notifications — MyCitadel',
    'description' => 'Your Citadel alerts: connection requests, comments, reactions.',
    'og_title'    => 'Notifications — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/notifications',
    'canonical'   => CITADEL_SITE_URL . '/notifications',
    'body_class'  => 'page-notifications',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$LOGIN_URL     = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
?>

<div class="notif-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>">

    <div class="notif-toast-layer" id="notif-toast-layer" aria-live="polite"></div>

    <header class="notif-hero">
        <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
        <h1>Notifications</h1>
        <p>Connection requests, replies, and reactions — all in one place.</p>
    </header>

    <div class="notif-toolbar">
        <div class="notif-tabs" role="tablist">
            <button type="button" class="notif-tab is-active" data-tab="all">All</button>
            <button type="button" class="notif-tab" data-tab="unread">Unread</button>
        </div>
        <button type="button" class="notif-mark-all" id="notif-mark-all" hidden>
            Mark all read
        </button>
    </div>

    <div class="notif-loading" id="notif-loading">
        <div class="notif-loading__spinner" aria-hidden="true"></div>
        <p class="notif-loading__text">Loading notifications…</p>
    </div>

    <div class="notif-error" id="notif-error" hidden>
        <div class="notif-error__icon" aria-hidden="true">⚠</div>
        <h2>Could not load notifications</h2>
        <p id="notif-error-msg">Something went wrong.</p>
        <button type="button" class="btn-cyber" id="notif-retry">Retry</button>
    </div>

    <div class="notif-list" id="notif-list" hidden></div>

    <div class="notif-empty" id="notif-empty" hidden>
        <p class="notif-empty__title">All quiet.</p>
        <p class="notif-empty__sub">Nothing needs your attention right now.</p>
    </div>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/notifications.js?v=<?= @filemtime('/home/beardedviking/vendors.mycitadel.lol/js/notifications.js') ?: time() ?>" defer></script>

<?php require __DIR__ . '/includes/footer.php'; ?>