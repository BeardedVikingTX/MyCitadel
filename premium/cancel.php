<?php
/* ============================================================================
 * ███ PREMIUM/CANCEL.PHP ███
 * MyCitadel — Post-checkout cancel landing
 * ----------------------------------------------------------------------------
 * Route : /premium/cancel
 *
 * Stripe redirects here when the user backs out of the hosted checkout.
 * No charge was made — Stripe does not process anything until the user
 * actually submits the payment form on their side. This page exists to
 * say so, plainly, and to give them a way back.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

citadel_set_meta([
    'title'       => 'Checkout Cancelled — MyCitadel',
    'description' => 'Your checkout was cancelled. No charge was made.',
    'og_title'    => 'Checkout Cancelled — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/premium/cancel',
    'canonical'   => CITADEL_SITE_URL . '/premium/cancel',
    'robots'      => 'noindex, follow',
    'body_class'  => 'page-premium-cancel',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';
?>

<main class="page-premium-cancel">

    <section class="premium-cancel">
        <span class="premium-cancel__icon" aria-hidden="true">ᚱ</span>

        <h1 class="premium-cancel__title">No worries.</h1>

        <p class="premium-cancel__lede">
            Your checkout was cancelled. <strong>No charge was made.</strong>
            Nothing changed on your account.
        </p>

        <p class="premium-cancel__lede premium-cancel__lede--small">
            If something about the price or the plan gave you pause, we would
            genuinely like to know. The founder reads every reply at
            <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>.
        </p>

        <div class="premium-cancel__cta">
            <a href="/premium" class="btn-cyber btn-gold btn-lg">
                Back to Premium
            </a>
            <a href="/" class="btn-cyber btn-lg">
                Return home
            </a>
        </div>

        <p class="premium-cancel__fine">
            MyCitadel stays free. The Citadel will be here whenever you are ready.
        </p>
    </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>