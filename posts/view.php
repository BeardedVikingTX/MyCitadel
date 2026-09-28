<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/config.php';

$postId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

citadel_set_meta([
    'title'       => 'Post — MyCitadel',
    'description' => 'A single post from the Citadel.',
    'og_url'      => CITADEL_SITE_URL . '/posts/view?id=' . $postId,
    'canonical'   => CITADEL_SITE_URL . '/posts/view?id=' . $postId,
    'body_class'  => 'page-post-view',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';
?>

<div class="post-view-root"
     data-api-base="https://api.mycitadel.lol/v1"
     data-client="browser/1.0.0"
     data-login-url="/login"
     data-post-id="<?= (int) $postId ?>">

    <div class="post-view-loading" id="post-view-loading">
        <div class="feed-loading__spinner"></div>
        <p class="feed-loading__text">Loading post…</p>
    </div>

    <div class="post-view-error" id="post-view-error" hidden>
        <h2>Post not found</h2>
        <p>The post may have been deleted, or you may not have permission to view it.</p>
        <a href="/feed" class="btn-cyber">Back to Feed</a>
    </div>

    <div class="post-view-shell" id="post-view-shell" hidden>
        <a href="/feed" class="post-view__back">← Back to feed</a>
        <div id="post-view-card"></div>
    </div>
</div>

<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/post-view.js?v=<?= @filemtime('/home/beardedviking/vendors.mycitadel.lol/js/post-view.js') ?: time() ?>" defer></script>

<?php require __DIR__ . '/../includes/footer.php'; ?>