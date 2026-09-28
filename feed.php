<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/FEED.PHP ███
 * The aggregated timeline. Composer at top, posts below.
 * Pulls from /v1/feed.php — own posts + connections' posts.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Feed — MyCitadel',
    'description' => 'Your timeline. Posts from you and the Citizens you are connected to.',
    'og_title'    => 'Feed — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/feed',
    'canonical'   => CITADEL_SITE_URL . '/feed',
    'body_class'  => 'page-feed',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

$API_BASE = 'https://api.mycitadel.lol/v1';
$LOGIN_URL = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
?>

<div class="feed-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>">

    <div class="feed-toast-layer" id="feed-toast-layer" aria-live="polite"></div>

    <!-- Loading -->
    <div class="feed-loading" id="feed-loading">
        <div class="feed-loading__spinner" aria-hidden="true"></div>
        <p class="feed-loading__text">Gathering the timeline…</p>
    </div>

    <!-- Error -->
    <div class="feed-error" id="feed-error" hidden>
        <div class="feed-error__icon" aria-hidden="true">⚠</div>
        <h2>Could not load your feed</h2>
        <p id="feed-error-msg">Something went wrong.</p>
        <button type="button" class="btn-cyber" id="feed-retry">Retry</button>
    </div>

    <!-- Main -->
    <div class="feed-shell" id="feed-shell" hidden>

        <!-- Left sidebar: profile card + scope -->
        <aside class="feed-side">
            <div class="feed-side__card" id="feed-identity-card"></div>

            <nav class="feed-side__scopes" aria-label="Feed scope">
                <button type="button" class="feed-scope is-active" data-scope="all">All</button>
                <button type="button" class="feed-scope" data-scope="self">Only Mine</button>
                <button type="button" class="feed-scope" data-scope="connections">Connections</button>
            </nav>

            <div class="feed-side__stats" id="feed-side-stats"></div>
        </aside>

        <!-- Main column -->
        <main class="feed-main">

            <!-- Composer -->
            <section class="composer" id="composer">
                <div class="composer__head">
                    <div class="composer__avatar" id="composer-avatar"></div>
                    <textarea
                        id="composer-text"
                        class="composer__text"
                        placeholder="What's on your mind, Citizen?"
                        maxlength="2000"
                        rows="3"></textarea>
                </div>

                <div class="composer__bar">
                    <div class="composer__visibility" role="radiogroup" aria-label="Post visibility">
                        <button type="button" class="vis-btn is-active" data-vis="public" title="Anyone in the Citadel">
                            🌐 <span>Public</span>
                        </button>
                        <button type="button" class="vis-btn" data-vis="connections" title="Only your connections">
                            ⚔ <span>Connections</span>
                        </button>
                        <button type="button" class="vis-btn" data-vis="private" title="Only you">
                            🔒 <span>Private</span>
                        </button>
                    </div>
                
                    <div class="composer__meta">
                        <button type="button" class="composer__attach" id="composer-attach" title="Attach files">
                            📎 <span>Attach</span>
                        </button>
                        <input type="file" id="composer-file-input" multiple hidden
                               accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/webm,audio/mpeg,audio/ogg,audio/wav,application/pdf,text/plain,text/markdown,application/zip">
                
                        <span class="composer__count" id="composer-count">0 / 2000</span>
                        <button type="button" class="btn-cyber composer__submit" id="composer-submit" disabled>
                            Post
                        </button>
                    </div>
                </div>
                
                <!-- Attachment preview grid (empty until user picks files) -->
                <div class="composer__attachments" id="composer-attachments"></div>
            </section>

            <!-- Feed list -->
            <section class="feed-list" id="feed-list" aria-label="Posts"></section>

            <!-- Load more -->
            <div class="feed-more" id="feed-more" hidden>
                <button type="button" class="btn-cyber" id="feed-more-btn">Load More</button>
            </div>

            <!-- Empty state -->
            <div class="feed-empty" id="feed-empty" hidden>
                <p>The timeline is quiet.</p>
                <p class="feed-empty__sub">Post something, or connect with another Citizen to see their thoughts here.</p>
            </div>

        </main>
    </div>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/feed.js?v=<?= @filemtime('/home/beardedviking/vendors.mycitadel.lol/js/feed.js') ?: time() ?>" defer></script>

<?php require __DIR__ . '/includes/footer.php'; ?>