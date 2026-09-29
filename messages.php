<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Messages — MyCitadel',
    'description' => 'Private encrypted conversations with your connections.',
    'og_title'    => 'Messages — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/messages',
    'canonical'   => CITADEL_SITE_URL . '/messages',
    'body_class'  => 'page-messages',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$LOGIN_URL     = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
$initialConv   = isset($_GET['c']) ? (int) $_GET['c'] : 0;
?>

<div class="msg-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
     data-initial-conversation="<?= (int) $initialConv ?>">

    <div class="msg-toast-layer" id="msg-toast-layer" aria-live="polite"></div>

    <div class="msg-loading" id="msg-loading">
        <div class="msg-spinner"></div>
        <p>Loading messages…</p>
    </div>

    <div class="msg-error" id="msg-error" hidden>
        <h2>Could not load messages</h2>
        <p id="msg-error-text">Something went wrong.</p>
        <button type="button" class="btn-cyber" id="msg-retry">Retry</button>
    </div>

    <div class="msg-shell" id="msg-shell" hidden>

        <!-- Sidebar: conversations -->
        <aside class="msg-side">
            <header class="msg-side__head">
                <h1>Messages</h1>
            </header>
            <div class="msg-side__list" id="msg-conv-list"></div>
            <div class="msg-side__empty" id="msg-conv-empty" hidden>
                <p>No conversations yet.</p>
                <p class="msg-side__hint">Visit a Citizen's profile to start one.</p>
            </div>
        </aside>

        <!-- Main: active thread -->
        <main class="msg-main">
            <div class="msg-blank" id="msg-blank">
                <div class="msg-blank__icon">💬</div>
                <p>Select a conversation to start chatting.</p>
            </div>

            <div class="msg-thread" id="msg-thread" hidden>
                <header class="msg-thread__head" id="msg-thread-head"></header>
                <div class="msg-thread__body" id="msg-thread-body"></div>
                <form class="msg-thread__composer" id="msg-composer" autocomplete="off">
                    <div class="msg-composer__attach-row" id="msg-attach-row"></div>
                    <div class="msg-composer__row">
                        <button type="button" class="msg-attach-btn" id="msg-attach-btn" title="Attach">
                            📎
                        </button>
                        <input type="file" id="msg-file-input" multiple hidden
                               accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,audio/mpeg,audio/ogg,audio/wav,application/pdf,text/plain,text/markdown,application/zip">
                        <textarea id="msg-input" placeholder="Write a message…" maxlength="2000" rows="1"></textarea>
                        <button type="submit" class="msg-send-btn" id="msg-send-btn" disabled>Send</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/messages.js?v=<?= @filemtime('/home/beardedviking/vendors.mycitadel.lol/js/messages.js') ?: time() ?>" defer></script>

<?php require __DIR__ . '/includes/footer.php'; ?>