<?php
/* ============================================================================
 * ███ PREMIUM/INDEX.PHP ███
 * MyCitadel — Premium upgrade page
 * ----------------------------------------------------------------------------
 * Route : /premium
 *
 * THE UPGRADE PAGE. Follows the same shell pattern as the rest of the site:
 * page renders immediately, JS hydrates the state-aware CTA by talking to
 * api.mycitadel.lol directly (the session cookie lives on the API origin,
 * not on mycitadel.lol — so PHP here cannot know the auth state).
 *
 * The CTA has five states, driven by JS:
 *   loading    — checking /users/me.php
 *   guest      — 401, show "log in to subscribe"
 *   subscribe  — logged in, not premium
 *   manage     — logged in, already premium
 *   error      — network or API failure
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

citadel_set_meta([
    'title'       => 'Premium — MyCitadel',
    'description' => 'Upgrade to Citadel+ Premium. Higher limits, all four reactions, group messaging with admin controls, and a badge that announces itself everywhere you appear. $10/month. Cancel anytime.',
    'og_title'    => 'Citadel+ Premium — MyCitadel',
    'og_description' => 'Higher limits. Group messaging. Every reaction. A badge that follows you. $10/month.',
    'og_url'      => CITADEL_SITE_URL . '/premium',
    'canonical'   => CITADEL_SITE_URL . '/premium',
    'body_class'  => 'page-premium',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$CLIENT_HEADER = 'browser/1.0.0';
$LOGIN_URL     = '/login';
$DASHBOARD_URL = '/users/dashboard.php';
?>

<main class="page-premium">

    <!-- ═══════════════════════════════════════════════════════════════════
         HERO
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-hero premium-hero">
        <div class="citadel-hero__inner">
            <span class="citadel-hero__rune" aria-hidden="true">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <span class="premium-eyebrow">Citadel+ Premium</span>
            <h1 class="citadel-title">Go Premium</h1>
            <p class="citadel-subtitle">$10 / month. Cancel anytime.</p>
            <p class="citadel-hero__lede">
                Higher limits. Group messaging with admin controls. Every
                reaction. A badge that follows you everywhere. No ads. No
                data sale. Just more room to be a Citizen.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         PRICING CARD + CTA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section premium-pricing-section" id="subscribe">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <div class="premium-card">
                <span class="premium-card__badge">Premium</span>

                <h2 class="premium-card__name">Citadel+</h2>

                <div class="premium-card__price">
                    <span class="premium-card__currency">$</span>10
                    <span class="premium-card__unit">/ month</span>
                </div>

                <p class="premium-card__tagline">
                    Everything in free, plus the room and the tools to be a
                    real presence in the Citadel.
                </p>

                <ul class="premium-card__highlights">
                    <li><strong>1,500</strong> character posts &amp; comments</li>
                    <li><strong>10</strong> attachments per post &mdash; every file type</li>
                    <li><strong>All four</strong> reactions: like, dislike, heart, angry</li>
                    <li><strong>Group messaging</strong> with admin moderation</li>
                    <li><strong>+2,500 reputation</strong> every month it renews</li>
                    <li><strong>Premium badge</strong> on every profile, post, comment</li>
                </ul>

                <!-- ═══ JS-driven CTA state machine ═══════════════════════ -->
                <div class="premium-cta"
                     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
                     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
                     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
                     data-dashboard-url="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>">

                    <!-- Loading -->
                    <div class="premium-cta__state" data-state="loading">
                        <div class="premium-cta__spinner" aria-hidden="true"></div>
                        <p class="premium-cta__text">Checking your account…</p>
                    </div>

                    <!-- Guest -->
                    <div class="premium-cta__state" data-state="guest" hidden>
                        <p class="premium-cta__text">
                            You need an account to subscribe. It takes 15 seconds.
                        </p>
                        <a href="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>"
                           class="btn-cyber btn-gold premium-cta__button">
                            Log in to subscribe
                        </a>
                        <p class="premium-cta__fine">
                            No account yet? <a href="/register">Create one first</a>.
                        </p>
                    </div>

                    <!-- Subscribe -->
                    <div class="premium-cta__state" data-state="subscribe" hidden>
                        <button type="button"
                                class="btn-cyber btn-gold premium-cta__button premium-subscribe-btn">
                            Subscribe — $10 / month
                        </button>
                        <p class="premium-cta__fine">
                            Billed securely by <strong>Stripe</strong>. Cancel anytime
                            from your billing portal. No hidden fees.
                        </p>
                    </div>

                    <!-- Manage (already premium) -->
                    <div class="premium-cta__state" data-state="manage" hidden>
                        <div class="premium-cta__already">
                            <span class="premium-cta__already-icon" aria-hidden="true">★</span>
                            <div>
                                <strong class="premium-cta__already-title">
                                    You&rsquo;re already a Premium Citizen.
                                </strong>
                                <p class="premium-cta__text">
                                    Manage your subscription, update your card, or
                                    download invoices from the billing portal.
                                </p>
                            </div>
                        </div>
                        <button type="button"
                                class="btn-cyber premium-cta__button premium-manage-btn">
                            Manage subscription
                        </button>
                        <p class="premium-cta__fine">
                            <a href="<?= htmlspecialchars($DASHBOARD_URL, ENT_QUOTES, 'UTF-8') ?>">
                                Back to dashboard →
                            </a>
                        </p>
                    </div>

                    <!-- Error -->
                    <div class="premium-cta__state" data-state="error" hidden>
                        <p class="premium-cta__error" data-error-msg>
                            Could not reach the server.
                        </p>
                        <button type="button"
                                class="btn-cyber premium-cta__button"
                                data-retry>
                            Retry
                        </button>
                    </div>

                </div><!-- /.premium-cta -->

                <p class="premium-card__fine">
                    Subscriptions renew monthly. Cancel any time and you keep
                    premium access until the end of your billing period.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         BENEFITS TOUR — 4 things that change the day you subscribe
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section premium-benefits">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">What Changes</h2>
            <p class="citadel-section__lede">
                Four things you feel the moment you go premium — and every
                day after.
            </p>

            <div class="premium-benefits__grid">

                <article class="premium-benefit">
                    <div class="premium-benefit__icon" aria-hidden="true">✍️</div>
                    <h3>Room to Say What You Mean</h3>
                    <p>
                        Free posts cut off at 50 characters. Premium posts run
                        to <strong>1,500</strong> — long enough for a paragraph,
                        a story, a real thought. Same for comments: 25 becomes
                        <strong>1,500</strong>.
                    </p>
                </article>

                <article class="premium-benefit">
                    <div class="premium-benefit__icon" aria-hidden="true">❤️</div>
                    <h3>The Full Emotional Vocabulary</h3>
                    <p>
                        Free gives you like and dislike. Premium unlocks
                        <strong>heart</strong> and <strong>angry</strong> — the
                        reactions that actually carry weight when a friend
                        shares something that matters.
                    </p>
                </article>

                <article class="premium-benefit">
                    <div class="premium-benefit__icon" aria-hidden="true">👥</div>
                    <h3>Groups, With Rules You Set</h3>
                    <p>
                        Start group conversations. As the creator, you are the
                        admin — you can remove members, and <strong>delete any
                        message</strong> for everyone. Hard delete. Gone from
                        every device, gone from the database.
                    </p>
                </article>

                <article class="premium-benefit">
                    <div class="premium-benefit__icon" aria-hidden="true">🏅</div>
                    <h3>A Badge That Travels</h3>
                    <p>
                        Every post, comment, and message you write carries the
                        premium badge. Plus <strong>+2,500 reputation</strong>
                        on every renewal — a visible signal that you are
                        invested in the Citadel.
                    </p>
                </article>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FULL COMPARISON TABLE
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Full Comparison</h2>
            <p class="citadel-section__lede">
                Everything, in one table. No asterisks.
            </p>

            <div class="tier-compare">

                <div class="tier-compare__head tier-compare__head--label"></div>
                <div class="tier-compare__head tier-compare__head--free">Free</div>
                <div class="tier-compare__head tier-compare__head--premium">Premium</div>

                <!-- Posts -->
                <div class="tier-compare__group">Posts</div>

                <div class="tier-compare__label">Post length</div>
                <div class="tier-compare__free">50 characters</div>
                <div class="tier-compare__premium">1,500 characters</div>

                <div class="tier-compare__label">Attachments per post</div>
                <div class="tier-compare__free">1 image</div>
                <div class="tier-compare__premium">Up to 10 — images, video, audio, documents, archives</div>

                <div class="tier-compare__label">Post visibility</div>
                <div class="tier-compare__free"><span class="tc-check">✓</span> Public · Connections · Private</div>
                <div class="tier-compare__premium"><span class="tc-check">✓</span> Public · Connections · Private</div>

                <!-- Comments -->
                <div class="tier-compare__group">Comments</div>

                <div class="tier-compare__label">Comment length</div>
                <div class="tier-compare__free">25 characters</div>
                <div class="tier-compare__premium">1,500 characters</div>

                <div class="tier-compare__label">Attachments per comment</div>
                <div class="tier-compare__free">1 image</div>
                <div class="tier-compare__premium">Up to 5 — all file types</div>

                <!-- Reactions -->
                <div class="tier-compare__group">Reactions</div>

                <div class="tier-compare__label">Available reactions</div>
                <div class="tier-compare__free">Like · Dislike</div>
                <div class="tier-compare__premium">Like · Dislike · Heart · Angry</div>

                <!-- Messaging -->
                <div class="tier-compare__group">Messaging</div>

                <div class="tier-compare__label">Start conversations</div>
                <div class="tier-compare__free">1-on-1 only</div>
                <div class="tier-compare__premium">1-on-1 and group</div>

                <div class="tier-compare__label">Be invited to groups</div>
                <div class="tier-compare__free"><span class="tc-check">✓</span></div>
                <div class="tier-compare__premium"><span class="tc-check">✓</span></div>

                <div class="tier-compare__label">Attachments per message</div>
                <div class="tier-compare__free">1 image</div>
                <div class="tier-compare__premium">Up to 10 — all file types</div>

                <div class="tier-compare__label">Delete own messages</div>
                <div class="tier-compare__free"><span class="tc-check">✓</span></div>
                <div class="tier-compare__premium"><span class="tc-check">✓</span></div>

                <div class="tier-compare__label">Delete conversations you created</div>
                <div class="tier-compare__free"><span class="tc-x">—</span></div>
                <div class="tier-compare__premium">Full destruction for all participants</div>

                <div class="tier-compare__label">Group admins can delete any message</div>
                <div class="tier-compare__free"><span class="tc-x">—</span></div>
                <div class="tier-compare__premium">Hard delete — gone for everyone</div>

                <!-- Profile -->
                <div class="tier-compare__group">Profile &amp; Standing</div>

                <div class="tier-compare__label">Premium badge</div>
                <div class="tier-compare__free"><span class="tc-x">—</span></div>
                <div class="tier-compare__premium"><span class="tc-check">✓</span> Everywhere you appear</div>

                <div class="tier-compare__label">Monthly reputation bonus</div>
                <div class="tier-compare__free"><span class="tc-x">—</span></div>
                <div class="tier-compare__premium"><strong>+2,500 rep</strong> on every renewal</div>

                <div class="tier-compare__label">Priority support</div>
                <div class="tier-compare__free">Standard</div>
                <div class="tier-compare__premium">Priority queue</div>

            </div>

            <p class="tier-compare__fine">
                <strong>Downgrading is not punishment.</strong> If you cancel
                Premium, everything you created while subscribed stays exactly
                as it is — posts, comments, attachments, deleted conversations.
                You lose the badge, the monthly bonus, and the higher limits
                on <em>new</em> activity. Nothing you have made is destroyed.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FAQ
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section premium-faq-section">
        <div class="citadel-section__inner citadel-section__inner--narrow">
            <h2 class="citadel-section__title">Frequently Asked</h2>

            <div class="premium-faq">

                <details class="premium-faq__item">
                    <summary>Can I cancel anytime?</summary>
                    <div class="premium-faq__body">
                        <p>
                            Yes. Cancel from the billing portal with two clicks.
                            Your premium access continues until the end of the
                            period you already paid for — then the free tier
                            takes over. No phone calls, no retention scripts,
                            no &ldquo;are you sure?&rdquo; gauntlets.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>What happens to my content if I cancel?</summary>
                    <div class="premium-faq__body">
                        <p>
                            It stays. Every post, comment, attachment, and
                            conversation you created while subscribed remains
                            exactly as it is. Downgrading does not destroy
                            anything you have already made. You only lose
                            the ability to create new content above the free
                            tier limits.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>Is the badge removed if I cancel?</summary>
                    <div class="premium-faq__body">
                        <p>
                            Yes — the premium badge is tied to an active
                            subscription. When it lapses, the badge stops
                            appearing on new activity. Old posts keep whatever
                            state they had when they were written. The badge
                            itself is not retroactively stripped from posts
                            you already made.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>Do I keep the reputation I earned?</summary>
                    <div class="premium-faq__body">
                        <p>
                            Every reputation point you have earned stays with
                            you, always. The +2,500 monthly bonus stops
                            accumulating when the subscription ends, but you
                            never lose points you already have. Reputation is
                            permanent — it is not rented.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>What payment methods do you accept?</summary>
                    <div class="premium-faq__body">
                        <p>
                            Payment is handled entirely by <strong>Stripe</strong>
                            — the same processor trusted by millions of
                            businesses. All major credit and debit cards are
                            accepted, plus whatever local payment methods
                            Stripe supports in your region. MyCitadel never
                            sees or stores your card details.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>Can I get a refund?</summary>
                    <div class="premium-faq__body">
                        <p>
                            We do not refund partial months. If you cancel
                            mid-month, you keep premium access through the
                            end of the period you already paid for — no
                            clawback, no pro-rated surprises. If something
                            went wrong that requires a human look, email
                            <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>
                            and we will figure it out.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>Will the price ever go up?</summary>
                    <div class="premium-faq__body">
                        <p>
                            We may raise prices for new subscribers in the
                            future. If we ever raise it for existing
                            subscribers, you will get at least 30 days'
                            notice by email — and the change will never be
                            retroactive.
                        </p>
                    </div>
                </details>

                <details class="premium-faq__item">
                    <summary>Does Premium affect my privacy?</summary>
                    <div class="premium-faq__body">
                        <p>
                            No. Premium buys you higher limits and more
                            features — not a different privacy posture. Free
                            and Premium Citizens are protected by the exact
                            same encryption, the same lack of tracking, and
                            the same absence of data sale. We do not sell
                            premium users' data any more than we sell free
                            users' data. Which is to say: not at all.
                        </p>
                    </div>
                </details>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         TRUST STRIP
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="premium-trust">
        <div class="premium-trust__inner">
            <div class="premium-trust__item">
                <span class="premium-trust__icon" aria-hidden="true">🔒</span>
                <span class="premium-trust__label">Payments by Stripe</span>
            </div>
            <div class="premium-trust__item">
                <span class="premium-trust__icon" aria-hidden="true">↺</span>
                <span class="premium-trust__label">Cancel anytime</span>
            </div>
            <div class="premium-trust__item">
                <span class="premium-trust__icon" aria-hidden="true">✕</span>
                <span class="premium-trust__label">No ads, ever</span>
            </div>
            <div class="premium-trust__item">
                <span class="premium-trust__icon" aria-hidden="true">◆</span>
                <span class="premium-trust__label">No data sale</span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FINAL CTA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--final">
        <div class="citadel-section__inner citadel-section__inner--center">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h2>Room to Be a Citizen.</h2>
            <p>Higher limits. Real tools. A badge that travels with you.</p>
            <div class="citadel-hero__cta">
                <a href="#subscribe" class="btn-cyber btn-gold btn-lg">
                    Go Premium — $10 / month
                </a>
            </div>
        </div>
    </section>

</main>

<!-- ══════════════════════════════════════════════════════════════════════════
     PREMIUM CHECKOUT SCRIPT
     --------------------------------------------------------------------------
     Drives the state-aware CTA. Fetches /me, decides which state to show,
     and handles both "start checkout" and "open billing portal" clicks.
     ========================================================================== -->
<script>
(function () {
    'use strict';

    var root = document.querySelector('.premium-cta');
    if (!root) return;

    var API     = root.dataset.apiBase;
    var CLIENT  = root.dataset.client;
    var states  = {
        loading:   root.querySelector('[data-state="loading"]'),
        guest:     root.querySelector('[data-state="guest"]'),
        subscribe: root.querySelector('[data-state="subscribe"]'),
        manage:    root.querySelector('[data-state="manage"]'),
        error:     root.querySelector('[data-state="error"]')
    };

    var csrfToken = null;

    function show(name) {
        Object.keys(states).forEach(function (k) {
            if (states[k]) states[k].hidden = (k !== name);
        });
    }

    function showError(msg) {
        var el = root.querySelector('[data-error-msg]');
        if (el) el.textContent = msg || 'Something went wrong.';
        show('error');
    }

    async function fetchCsrf() {
        var r = await fetch(API + '/auth/csrf.php', {
            credentials: 'include',
            headers: { 'X-Citadel-Client': CLIENT }
        });
        var d = await r.json();
        if (!d.token) throw new Error('Could not get a session token.');
        csrfToken = d.token;
        return csrfToken;
    }

    async function fetchMe() {
        var r = await fetch(API + '/users/me.php', {
            credentials: 'include',
            headers: { 'X-Citadel-Client': CLIENT }
        });
        if (r.status === 401) return null;
        if (!r.ok) throw new Error('Server returned ' + r.code);
        var d = await r.json();
        return d.user || null;
    }

    async function startCheckout() {
        var r = await fetch(API + '/premium/checkout.php', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'X-Citadel-Client': CLIENT,
                'X-CSRF-Token': csrfToken || ''
            },
            body: '{}'
        });
        var d = await r.json();
        if (r.status === 401) {
            show('guest');
            throw new Error('__handled__');
        }
        if (r.status === 409 && d.code === 'already_premium') {
            await init();
            throw new Error('__handled__');
        }
        if (!r.ok || !d.checkout_url) {
            throw new Error(d.message || 'Could not start checkout.');
        }
        return d.checkout_url;
    }

    async function openPortal() {
        var r = await fetch(API + '/premium/portal.php', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'X-Citadel-Client': CLIENT,
                'X-CSRF-Token': csrfToken || ''
            },
            body: '{}'
        });
        var d = await r.json();
        if (!r.ok || !d.portal_url) {
            throw new Error(d.message || 'Could not open the billing portal.');
        }
        return d.portal_url;
    }

    async function init() {
        show('loading');
        try {
            if (!csrfToken) await fetchCsrf();
            var user = await fetchMe();
            if (!user) {
                show('guest');
                return;
            }
            if (user.premium) {
                show('manage');
                return;
            }
            show('subscribe');
        } catch (err) {
            showError(err.message || 'Could not reach the server.');
        }
    }

    // Wire the subscribe button
    var subBtn = root.querySelector('.premium-subscribe-btn');
    if (subBtn) {
        subBtn.addEventListener('click', async function () {
            var original = subBtn.textContent;
            subBtn.disabled = true;
            subBtn.textContent = 'Starting checkout…';
            try {
                var url = await startCheckout();
                window.location.href = url;
            } catch (err) {
                subBtn.disabled = false;
                subBtn.textContent = original;
                if (err.message !== '__handled__') {
                    showError(err.message);
                }
            }
        });
    }

    // Wire the manage button
    var manageBtn = root.querySelector('.premium-manage-btn');
    if (manageBtn) {
        manageBtn.addEventListener('click', async function () {
            var original = manageBtn.textContent;
            manageBtn.disabled = true;
            manageBtn.textContent = 'Opening billing portal…';
            try {
                var url = await openPortal();
                window.location.href = url;
            } catch (err) {
                manageBtn.disabled = false;
                manageBtn.textContent = original;
                showError(err.message);
            }
        });
    }

    // Wire the retry button
    var retryBtn = root.querySelector('[data-retry]');
    if (retryBtn) retryBtn.addEventListener('click', init);

    init();
})();
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>