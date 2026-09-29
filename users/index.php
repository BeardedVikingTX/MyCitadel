<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/config.php';

citadel_set_meta([
    'title'       => 'Citizens — MyCitadel',
    'description' => 'The people of the Citadel. Connect with Citizens who share your values.',
    'og_title'    => 'Citizens — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/users',
    'canonical'   => CITADEL_SITE_URL . '/users',
    'body_class'  => 'page-citizens',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$LOGIN_URL     = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
?>

<link rel="stylesheet" href="<?= e(CITADEL_VENDORS_URL) ?>/css/citizens.css?v=1">

<div class="citizens-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>">

    <div class="citizens-toast-layer" id="citizens-toast-layer" aria-live="polite"></div>

    <header class="citizens-hero">
        <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
        <h1>Citizens of the Citadel</h1>
        <p>The people who make this place worth coming back to.</p>
    </header>

    <div class="citizens-toolbar">
        <div class="citizens-toolbar__search">
            <input type="text" id="citizens-search" placeholder="Search by name or @username…" maxlength="64" autocomplete="off">
        </div>
        <div class="citizens-toolbar__filters">
            <button type="button" class="chip is-active" data-filter="all">All</button>
            <button type="button" class="chip" data-filter="exclude_connected">Not Connected</button>
        </div>
    </div>

    <div class="citizens-status" id="citizens-status"></div>

    <div class="citizens-grid" id="citizens-grid"></div>

    <div class="citizens-empty" id="citizens-empty" hidden>
        <p class="citizens-empty__title">No Citizens found.</p>
        <p class="citizens-empty__sub">Try a different search term or clear your filters.</p>
    </div>

    <div class="citizens-more" id="citizens-more" hidden>
        <button type="button" class="btn-cyber" id="citizens-more-btn">Load More</button>
    </div>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/citizens.js?v=1" defer></script>

<?php require __DIR__ . '/../includes/footer.php'; ?>