<?php
/* ============================================================================
 * ███ PREMIUM/SUCCESS.PHP ███
 * MyCitadel — Post-checkout landing
 * ----------------------------------------------------------------------------
 * Route : /premium/success?session_id=cs_...
 *
 * Stripe redirects here after a successful payment. The session_id in the
 * URL is a HINT, not proof — the only authority is /v1/premium/status.php.
 * Webhook processing can lag by 1–3 seconds, so this page polls a few
 * times before declaring success or handing off to a manual refresh.
 *
 * STATES
 *   loading    — polling status
 *   ready      — premium confirmed, celebrate
 *   activating — polling timed out, show manual refresh
 *   guest      — not logged in (shouldn't happen, but guard anyway)
 *   error      — status endpoint unreachable
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

citadel_set_meta([
    'title'       => 'Welcome to Premium — MyCitadel',
    'description' => 'Your Citadel+ Premium subscription is active.',
    'og_title'    => 'Welcome to Premium — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/premium/success',
    'canonical'   => CITADEL_SITE_URL . '/premium/success',
    'robots'      => 'noindex, follow',
    'body_class'  => 'page-premium-success',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$CLIENT_HEADER = 'browser/1.0.0';
$LOGIN_URL     = '/login';
$DASHBOARD_URL = '/users/dashboard.php';
$FEED_URL      = '/feed';
?>

<main class="page-premium-success">

    <section class="premium-success"
             data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
             data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
             data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
             data-dashboard-url="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>">

        <!-- Loading -->
        <div class="premium-success__state" data-state="loading">
            <div class="premium-success__spinner" aria-hidden="true"></div>
            <h1 class="premium-success__title">Confirming your subscription…</h1>
            <p class="premium-success__lede">
                This usually takes a few seconds. Do not close this tab.
            </p>
        </div>

        <!-- Ready — premium confirmed -->
        <div class="premium-success__state premium-success__state--ready"
             data-state="ready" hidden>
            <span class="premium-success__icon" aria-hidden="true">★</span>
            <h1 class="premium-success__title">Welcome, Premium Citizen.</h1>
            <p class="premium-success__lede">
                Your subscription is active. Here is what just changed.
            </p>

            <ul class="premium-success__list">
                <li>
                    <span class="premium-success__check" aria-hidden="true">✓</span>
                    <span><strong>1,500</strong> character posts &amp; comments</span>
                </li>
                <li>
                    <span class="premium-success__check" aria-hidden="true">✓</span>
                    <span><strong>10</strong> attachments per post — every file type</span>
                </li>
                <li>
                    <span class="premium-success__check" aria-hidden="true">✓</span>
                    <span><strong>All four</strong> reactions unlocked</span>
                </li>
                <li>
                    <span class="premium-success__check" aria-hidden="true">✓</span>
                    <span><strong>Group messaging</strong> with admin controls</span>
                </li>
                <li>
                    <span class="premium-success__check" aria-hidden="true">✓</span>
                    <span><strong>+2,500 reputation</strong> awarded on this renewal</span>
                </li>
                <li>
                    <span class="premium-success__check" aria-hidden="true">✓</span>
                    <span><strong>Premium badge</strong> now shown everywhere you appear</span>
                </li>
            </ul>

            <div class="premium-success__cta">
                <a href="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>"
                   class="btn-cyber btn-gold btn-lg">
                    Go to your dashboard
                </a>
                <a href="<?= htmlspecialchars($FEED_URL, ENT_QUOTES, 'UTF-8') ?>"
                   class="btn-cyber btn-lg">
                    Back to the feed
                </a>
            </div>

            <p class="premium-success__fine">
                A receipt has been emailed to you by Stripe.
                You can manage your subscription any time from the
                <a href="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>#premium">
                    dashboard
                </a>.
            </p>
        </div>

        <!-- Activating — polling timed out -->
        <div class="premium-success__state" data-state="activating" hidden>
            <span class="premium-success__icon premium-success__icon--warn" aria-hidden="true">◐</span>
            <h1 class="premium-success__title">Your subscription is being activated.</h1>
            <p class="premium-success__lede">
                Stripe confirmed the payment, but our server has not yet
                received the notification. This is normal and usually
                completes within a minute.
            </p>
            <div class="premium-success__cta">
                <button type="button" class="btn-cyber btn-gold btn-lg" data-recheck>
                    Check again
                </button>
                <a href="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>"
                   class="btn-cyber btn-lg">
                    Go to dashboard anyway
                </a>
            </div>
            <p class="premium-success__fine">
                If it has been more than 5 minutes and you are still not
                premium, email
                <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>
                with your Stripe session ID.
            </p>
        </div>

        <!-- Guest — not logged in -->
        <div class="premium-success__state" data-state="guest" hidden>
            <h1 class="premium-success__title">Session not found.</h1>
            <p class="premium-success__lede">
                You appear to be logged out. Log back in and check your
                dashboard — the subscription should already be active.
            </p>
            <div class="premium-success__cta">
                <a href="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
                   class="btn-cyber btn-gold btn-lg">
                    Log in
                </a>
            </div>
        </div>

        <!-- Error — status endpoint unreachable -->
        <div class="premium-success__state" data-state="error" hidden>
            <h1 class="premium-success__title">Something went wrong.</h1>
            <p class="premium-success__lede">
                We could not confirm your subscription right now. Your payment
                went through — that part is certain. The activation status is
                what we cannot check at this moment.
            </p>
            <div class="premium-success__cta">
                <button type="button" class="btn-cyber btn-gold btn-lg" data-recheck>
                    Try again
                </button>
                <a href="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>"
                   class="btn-cyber btn-lg">
                    Go to dashboard
                </a>
            </div>
        </div>

    </section>
</main>

<script>
(function () {
    'use strict';

    var root = document.querySelector('.premium-success');
    if (!root) return;

    var API = root.dataset.apiBase;
    var CLIENT = root.dataset.client;
    var MAX_TRIES = 8;
    var INTERVAL_MS = 1500;
    var attempt = 0;

    var states = {
        loading:    root.querySelector('[data-state="loading"]'),
        ready:      root.querySelector('[data-state="ready"]'),
        activating: root.querySelector('[data-state="activating"]'),
        guest:      root.querySelector('[data-state="guest"]'),
        error:      root.querySelector('[data-state="error"]')
    };

    function show(name) {
        Object.keys(states).forEach(function (k) {
            if (states[k]) states[k].hidden = (k !== name);
        });
    }

    async function checkStatus() {
        var r = await fetch(API + '/premium/status.php', {
            credentials: 'include',
            headers: { 'X-Citadel-Client': CLIENT }
        });
        if (r.status === 401) return { unauthenticated: true };
        if (!r.ok) throw new Error('status_' + r.status);
        var d = await r.json();
        return d.premium || {};
    }

    async function poll() {
        attempt++;
        try {
            var status = await checkStatus();

            if (status.unauthenticated) {
                show('guest');
                return;
            }
            if (status.is_premium === true) {
                show('ready');
                return;
            }
            if (attempt < MAX_TRIES) {
                setTimeout(poll, INTERVAL_MS);
            } else {
                show('activating');
            }
        } catch (err) {
            if (attempt < MAX_TRIES) {
                setTimeout(poll, INTERVAL_MS);
            } else {
                show('error');
            }
        }
    }

    var recheckBtn = root.querySelector('[data-recheck]');
    if (recheckBtn) {
        recheckBtn.addEventListener('click', function () {
            attempt = 0;
            show('loading');
            poll();
        });
    }

    poll();
})();
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>