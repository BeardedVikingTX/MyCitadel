<?php
/* ============================================================================
 * ███ INCLUDES/FOOTER.PHP ███
 * Closes the page. Renders the site footer, loads the JS bundle,
 * and boots the session hydration.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/config.php';
?>
<footer class="citadel-footer">
    <div class="citadel-footer__inner">

        <div class="citadel-footer__brand">
            <span class="citadel-footer__mark" aria-hidden="true">ᛗ</span>
            <span class="citadel-footer__name">MyCitadel</span>
            <p class="citadel-footer__tagline"><?= e(CITADEL_SITE_TAGLINE) ?></p>
        </div>

        <div class="citadel-footer__cols">
            <div class="citadel-footer__col">
                <h4>Platform</h4>
                <ul>
                    <li><a href="/feed">Feed</a></li>
                    <li><a href="/users">Citizens</a></li>
                    <li><a href="/premium">Premium</a></li>
                    <li><a href="/about">About</a></li>
                </ul>
            </div>
            <div class="citadel-footer__col">
                <h4>Legal</h4>
                <ul>
                    <li><a href="/terms">Terms</a></li>
                    <li><a href="/privacy">Privacy</a></li>
                    <li><a href="/security">Security</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="citadel-footer__col">
                <h4>Developers</h4>
                <ul>
                    <li><a href="https://api.mycitadel.lol" rel="noopener">API Reference</a></li>
                    <li><a href="https://github.com/BeardedVikingTX" rel="noopener">GitHub</a></li>
                    <li><a href="/security#bug-bounty">Bug Bounty</a></li>
                    <li><a href="/status">Status</a></li>
                </ul>
            </div>
        </div>

        <div class="citadel-footer__bottom">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <p>
                &copy; <?= CITADEL_YEAR ?> <?= e(CITADEL_SITE_NAME) ?>.
                Built by <a href="https://beardedviking.org" rel="noopener">Bearded Viking</a>.
            </p>
            <p class="citadel-footer__note">
                Because your data should be yours alone.
            </p>
        </div>
    </div>
</footer>

<!-- ══════════════════════════════════════════════════════════════════════════
     SCRIPTS
     --------------------------------------------------------------------------
     • citadel-app.js — the API client (bootstrap, CSRF, fetch wrapper)
     • cookies.js     — UI session hydration (this project)
     Loaded with `defer` so they don't block the first paint.
     ========================================================================== -->
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/citadel-app.js?v=<?= filemtime('/home/beardedviking/vendors.mycitadel.lol/js/citadel-app.js') ?>" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/cookies.js" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/nav.js?v=<?= filemtime('/home/beardedviking/vendors.mycitadel.lol/js/nav.js') ?>" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/contact.js" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/register.js" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/login.js" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/dashboard.js" defer></script>
<script src="<?= e(CITADEL_VENDORS_URL) ?>/js/profile-edit.js?v=1" defer></script>

<?php if (!empty($GLOBALS['citadel_extra_scripts'] ?? null)): ?>
<?php foreach ($GLOBALS['citadel_extra_scripts'] as $src): ?>
<script src="<?= e($src) ?>" defer></script>
<?php endforeach; ?>
<?php endif; ?>

</body>
</html>