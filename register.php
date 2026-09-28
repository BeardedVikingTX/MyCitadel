<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/REGISTER.PHP ███
 * Registration page — full form, validation, API submission.
 * ----------------------------------------------------------------------------
 * The actual account creation happens at api.mycitadel.lol/v1/auth/register.php.
 * This page is the shell: it renders the form, mints a CSRF token, and
 * submits via fetch() with credentials: 'include' so the API's session
 * cookie is set for the browser.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Register — MyCitadel',
    'description' => 'Create your MyCitadel account. Privacy-first, encrypted at rest, built for people who value their data.',
    'og_title'    => 'Register — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/register',
    'canonical'   => CITADEL_SITE_URL . '/register',
    'body_class'  => 'page-auth page-register',
]);

// If already logged in, bounce to dashboard
// (Session check is via the API cookie — a lightweight /me probe handled in JS)

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

$API_BASE = 'https://api.mycitadel.lol/v1';
$prefillReferral = isset($_GET['ref']) && is_string($_GET['ref'])
    ? htmlspecialchars(substr($_GET['ref'], 0, 16), ENT_QUOTES, 'UTF-8')
    : '';
?>

<main class="page-static page-auth">

    <!-- ═══════════════════════════════════════════════════════════════
         HERO
         =============================================================== -->
    <header class="page-static__header">
        <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
        <h1>Enter the Citadel</h1>
        <p class="page-static__lede">
            No trackers. No ads. No data sale. Just a place where your
            private life stays private.
        </p>
    </header>

    <!-- ═══════════════════════════════════════════════════════════════
         REGISTRATION FORM
         =============================================================== -->
    <section class="citadel-section auth-section">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <form id="register-form"
              class="auth-form"
              action="/register"
              method="post"
              data-api-base="https://api.mycitadel.lol/v1"
              data-client="browser/1.0.0"
              data-redirect="/users/dashboard"
              novalidate
              autocomplete="on">

                <!-- Status banner (filled by JS) -->
                <div id="register-status" class="auth-status" role="alert" aria-live="polite"></div>

                <!-- ── Username ──────────────────────────────────────── -->
                <div class="auth-field">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        minlength="3"
                        maxlength="32"
                        pattern="[a-zA-Z0-9_]{3,32}"
                        autocomplete="username"
                        spellcheck="false"
                        autocapitalize="none"
                        placeholder="viking_42"
                    >
                    <p class="auth-hint">
                        3–32 characters. Letters, numbers, and underscores only.
                    </p>
                </div>

                <!-- ── Email ─────────────────────────────────────────── -->
                <div class="auth-field">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        maxlength="254"
                        autocomplete="email"
                        spellcheck="false"
                        autocapitalize="none"
                        placeholder="you@example.com"
                    >
                    <p class="auth-hint">
                        Used for account recovery and security alerts. Encrypted
                        at rest — we cannot read it.
                    </p>
                </div>

                <!-- ── Password ──────────────────────────────────────── -->
                <div class="auth-field">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        minlength="12"
                        maxlength="1024"
                        autocomplete="new-password"
                        placeholder="At least 12 characters"
                    >
                    <div class="pw-meter" aria-hidden="true">
                        <div class="pw-meter__bar" data-level="0"></div>
                    </div>
                    <p class="auth-hint" id="pw-hint">
                        Minimum 12 characters. A passphrase of three or four
                        random words is stronger than a short complex string.
                    </p>
                </div>

                <!-- ── Confirm Password ──────────────────────────────── -->
                <div class="auth-field">
                    <label for="password_confirm">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        required
                        minlength="12"
                        maxlength="1024"
                        autocomplete="new-password"
                        placeholder="Type it again"
                    >
                </div>

                <!-- ── Referral Code (pre-filled from ?ref=) ─────────── -->
                <div class="auth-field">
                    <label for="referral_code">
                        Referral Code <span class="auth-optional">(optional)</span>
                    </label>
                    <input
                        type="text"
                        id="referral_code"
                        name="referral_code"
                        maxlength="16"
                        autocomplete="off"
                        spellcheck="false"
                        autocapitalize="characters"
                        placeholder="VIKING-A7X9"
                        value="<?= $prefillReferral ?>"
                    >
                    <p class="auth-hint">
                        If someone invited you, enter their code — you both
                        get 500 reputation points.
                    </p>
                </div>

                <!-- ── Terms acceptance ──────────────────────────────── -->
                <div class="auth-checkbox">
                    <input type="checkbox" id="accept_terms" required>
                    <label for="accept_terms">
                        I agree to the
                        <a href="/terms" target="_blank" rel="noopener">Terms of Service</a>
                        and
                        <a href="/privacy" target="_blank" rel="noopener">Privacy Policy</a>.
                    </label>
                </div>

                <!-- ── Age gate ──────────────────────────────────────── -->
                <div class="auth-checkbox">
                    <input type="checkbox" id="accept_age" required>
                    <label for="accept_age">
                        I confirm I am at least 13 years old.
                    </label>
                </div>

                <!-- ── Submit ────────────────────────────────────────── -->
                <button type="submit" class="btn-cyber auth-submit" id="register-btn">
                    Create Account
                </button>

                <p class="auth-alt">
                    Already have an account?
                    <a href="/login">Log in instead</a>
                </p>

                <p class="auth-fine">
                    Registration takes about 15 seconds. We send a confirmation
                    email so you can verify ownership — nothing else.
                </p>

            </form>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════
         WHAT YOU GET
         =============================================================== -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner citadel-section__inner--narrow">
            <h2 class="about-h2 about-h2--center">What Awaits Inside</h2>

            <div class="register-perks">
                <div class="register-perk">
                    <span class="register-perk__icon" aria-hidden="true">🔐</span>
                    <h3>Encrypted at Rest</h3>
                    <p>Your email, name, and personal fields are encrypted
                       with keys tied to your account.</p>
                </div>
                <div class="register-perk">
                    <span class="register-perk__icon" aria-hidden="true">🛡️</span>
                    <h3>Stalker Shield</h3>
                    <p>Visibility is a choice. No cold DMs. Blocking is
                       silent, permanent, and mutual.</p>
                </div>
                <div class="register-perk">
                    <span class="register-perk__icon" aria-hidden="true">🚫</span>
                    <h3>No Trackers</h3>
                    <p>No Google Analytics, no Facebook Pixel, no session
                       replay, no third-party scripts.</p>
                </div>
                <div class="register-perk">
                    <span class="register-perk__icon" aria-hidden="true">⚡</span>
                    <h3>Two-Factor Available</h3>
                    <p>Enable TOTP in seconds — compatible with any
                       authenticator app.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- ═══════════════════════════════════════════════════════════════════
     REGISTRATION SCRIPT
     =================================================================== -->

<?php require __DIR__ . '/includes/footer.php'; ?>