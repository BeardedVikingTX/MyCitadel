<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/LOGIN.PHP ███
 * Login page — identifier + password, with optional 2FA second step.
 * ----------------------------------------------------------------------------
 * The API handles all the security: rate limiting, lockout, timing defense,
 * generic error responses. This page is the shell.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Log In — MyCitadel',
    'description' => 'Log in to your MyCitadel account.',
    'og_title'    => 'Log In — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/login',
    'canonical'   => CITADEL_SITE_URL . '/login',
    'body_class'  => 'page-auth page-login',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

$API_BASE = 'https://api.mycitadel.lol/v1';
$REDIRECT_TO = '/users/dashboard.php';
?>

<main class="page-static page-auth">

    <!-- ═══════════════════════════════════════════════════════════════
         HERO
         =============================================================== -->
    <header class="page-static__header">
        <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
        <h1>Welcome Back</h1>
        <p class="page-static__lede">
            The gate is not locked. It never was — you have the key.
        </p>
    </header>

    <!-- ═══════════════════════════════════════════════════════════════
         LOGIN FORM
         =============================================================== -->
    <section class="citadel-section auth-section">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <!-- Status banner (filled by JS) -->
            <div id="login-status" class="auth-status" role="alert" aria-live="polite"></div>

            <!-- ── STEP 1: password ──────────────────────────────────── -->
            <form id="login-form"
                  class="auth-form"
                  action="/login"
                  method="post"
                  data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
                  data-client="browser/1.0.0"
                  data-redirect="<?= htmlspecialchars($REDIRECT_TO, ENT_QUOTES, 'UTF-8') ?>"
                  novalidate
                  autocomplete="on">

                <div class="auth-field">
                    <label for="identifier">Username or Email</label>
                    <input
                        type="text"
                        id="identifier"
                        name="identifier"
                        required
                        maxlength="254"
                        autocomplete="username"
                        spellcheck="false"
                        autocapitalize="none"
                        placeholder="viking_42 or you@example.com"
                        autofocus
                    >
                </div>

                <div class="auth-field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        maxlength="1024"
                        autocomplete="current-password"
                        placeholder="Your password"
                    >
                </div>

                <div class="auth-row">
                    <div class="auth-checkbox auth-checkbox--inline">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember this device</label>
                    </div>
                    <a href="/forgot-password" class="auth-inline-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-cyber auth-submit" id="login-btn">
                    Log In
                </button>

                <p class="auth-alt">
                    No account yet?
                    <a href="/register">Create one</a>
                </p>
            </form>

            <!-- ── STEP 2: 2FA code (hidden until needed) ────────────── -->
            <form id="login-2fa-form"
                  class="auth-form"
                  style="display:none;"
                  data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
                  data-client="browser/1.0.0"
                  data-redirect="<?= htmlspecialchars($REDIRECT_TO, ENT_QUOTES, 'UTF-8') ?>"
                  novalidate>

                <div class="auth-2fa-header">
                    <span class="auth-2fa-icon" aria-hidden="true">🔐</span>
                    <h2>Two-Factor Required</h2>
                    <p>
                        Enter the 6-digit code from your authenticator app,
                        or one of your recovery codes.
                    </p>
                </div>

                <div class="auth-field">
                    <label for="code">Code</label>
                    <input
                        type="text"
                        id="code"
                        name="code"
                        required
                        minlength="6"
                        maxlength="32"
                        autocomplete="one-time-code"
                        spellcheck="false"
                        autocapitalize="characters"
                        inputmode="text"
                        placeholder="123456"
                        autofocus
                    >
                </div>

                <button type="submit" class="btn-cyber auth-submit" id="login-2fa-btn">
                    Verify
                </button>

                <p class="auth-alt">
                    <a href="#" id="login-2fa-back">← Back to password</a>
                </p>
            </form>

            <p class="auth-fine">
                By logging in you agree to our
                <a href="/terms">Terms of Service</a> and
                <a href="/privacy">Privacy Policy</a>.
            </p>

        </div>
    </section>

</main>

<script src="/assets/js/login.js" defer></script>

<?php require __DIR__ . '/includes/footer.php'; ?>