<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/ABOUT.PHP ███
 * The story, the why, and the people this exists for.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'About — MyCitadel',
    'description' => 'Why MyCitadel exists, who built it, and why privacy matters more than any of us realized. A father of four building the platform he wants his kids to use.',
    'og_title'    => 'About MyCitadel',
    'og_description' => 'A father of four built the platform he wants his kids to use. Here is the story.',
    'og_url'      => CITADEL_SITE_URL . '/about',
    'canonical'   => CITADEL_SITE_URL . '/about',
    'body_class'  => 'page-about',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main class="page-about__main">

    <!-- ═══════════════════════════════════════════════════════════════════
         HERO — glitched, floating, alive
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="about-hero">

        <!-- Floating decorative runes -->
        <span class="about-float about-float--1" aria-hidden="true">ᚠ</span>
        <span class="about-float about-float--2" aria-hidden="true">ᛉ</span>
        <span class="about-float about-float--3" aria-hidden="true">ᛏ</span>
        <span class="about-float about-float--4" aria-hidden="true">ᚨ</span>
        <span class="about-float about-float--5" aria-hidden="true">ᛒ</span>
        <span class="about-float about-float--6" aria-hidden="true">ᛗ</span>

        <div class="about-hero__inner">
            <span class="about-hero__eyebrow">The Story</span>
            <h1 class="about-hero__title glitch" data-text="MyCitadel">MyCitadel</h1>
            <p class="about-hero__subtitle">A fortress built by a father</p>
            <p class="about-hero__lede">
                This is not a startup. There is no venture capital, no board
                of directors, no growth-at-any-cost mandate. This is one person
                who decided the internet his children inherit should be better
                than the one we were given.
            </p>
        </div>

        <!-- Scroll hint -->
        <div class="about-hero__scroll" aria-hidden="true">
            <span class="about-hero__scroll-line"></span>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         THE STORY
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section about-story">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">01</span>
                The Story
            </h2>

            <p class="about-lede">
                I am a father of four. Three daughters and a son. The oldest
                is old enough to use social media. The youngest is not yet.
                Every single day I watch the older ones navigate a world
                where the apps on their phones are designed to extract as
                much of their attention, identity, and behavior as possible
                — and sell it to the highest bidder.
            </p>

            <p class="about-lede">
                I have spent my career in technology. I know what happens
                under the hood. I know how the tracking pixels work. I know
                how the recommendation algorithms are tuned. I know what a
                "shadow profile" is, and I know that even people who have
                never created a Facebook account have one — built from
                browsing data, phone contacts, and inference.
            </p>

            <p class="about-lede">
                For years, I told myself I was overreacting. I told myself
                that "everyone uses these platforms" and that my concern was
                paranoia. Then I read a leaked document. Then another. Then
                I watched a regulator fine a company the size of a small
                country for what they had done to children. And I stopped
                telling myself anything.
            </p>

            <p class="about-lede about-lede--highlight">
                <strong>I built the alternative because my kids deserve one.</strong>
            </p>

            <p class="about-lede">
                Not a louder platform. Not a prettier one. A <em>different</em>
                one. One where the business model does not depend on knowing
                anything about you. One where a stranger cannot look up your
                daughter by name and find her school. One where the servers
                themselves cannot read what you wrote to the people you love.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FOR OUR CHILDREN
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark about-children">
        <div class="citadel-section__inner">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">02</span>
                For Our Children
            </h2>

            <p class="citadel-section__lede" style="text-align:center; margin-left:auto; margin-right:auto;">
                A platform where a parent does not have to wonder what is
                being done with their kid's data — because nothing is being
                done with it at all.
            </p>

            <div class="children-grid">

                <article class="panel child-card child-card--protect">
                    <div class="child-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="56" height="56" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M32 6 L54 16 v18 c0 12 -9 20 -22 24 c-13 -4 -22 -12 -22 -24 v-18 z"/>
                            <path d="M22 32 l8 8 l14 -16" />
                        </svg>
                    </div>
                    <h3>Their identity stays theirs</h3>
                    <p>No behavioral fingerprints. No shadow profiles. No
                       third-party analytics watching how long they hover
                       over a photo. What they see, they see. That is all.</p>
                </article>

                <article class="panel child-card child-card--shield">
                    <div class="child-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="56" height="56" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="32" cy="32" r="22"/>
                            <path d="M32 14 v36 M14 32 h36"/>
                            <circle cx="32" cy="32" r="8" fill="currentColor" opacity="0.4"/>
                        </svg>
                    </div>
                    <h3>Visibility is a choice</h3>
                    <p>Nothing about your child is visible to strangers by
                       default. Connections are mutual. Profiles are gated.
                       Blocks are silent. Hidden means hidden — even from us.</p>
                </article>

                <article class="panel child-card child-card--private">
                    <div class="child-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="56" height="56" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="14" y="28" width="36" height="26" rx="4"/>
                            <path d="M22 28 v-8 a10 10 0 0 1 20 0 v8"/>
                            <circle cx="32" cy="41" r="3" fill="currentColor"/>
                            <path d="M32 44 v6"/>
                        </svg>
                    </div>
                    <h3>Private by architecture</h3>
                    <p>Messages are encrypted before they leave the device.
                       Photos are encrypted at rest. Even if our servers were
                       seized tomorrow, what would be found is unreadable.</p>
                </article>

                <article class="panel child-card child-card--future">
                    <div class="child-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="56" height="56" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M32 8 v14"/>
                            <circle cx="32" cy="32" r="12" fill="currentColor" opacity="0.25"/>
                            <circle cx="32" cy="32" r="20"/>
                            <path d="M14 52 h36"/>
                        </svg>
                    </div>
                    <h3>Yours to leave</h3>
                    <p>When they grow up and want out, deletion is real.
                       Not soft-deleted, not archived, not "hidden." Destroyed
                       — posts, comments, connections, and identity.
                       Gone.</p>
                </article>

            </div>

            <blockquote class="about-quote">
                The internet did not have to become a surveillance machine.
                It became one because we let it. It does not have to stay
                this way — and this is my small attempt at making sure it
                does not.
            </blockquote>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         THE PRINCIPLES
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section about-values">
        <div class="citadel-section__inner">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">03</span>
                What I Stand For
            </h2>

            <div class="values-grid">

                <article class="value-card">
                    <h3>Privacy is not a feature.</h3>
                    <p>It is the default. Anything less is a compromise dressed
                       up as a setting, waiting to be quietly reversed by a
                       policy update.</p>
                </article>

                <article class="value-card">
                    <h3>Security through mathematics.</h3>
                    <p>Encryption is not a marketing bullet. It is the reason
                       a stolen database is worthless. We do not trust
                       promises. We trust proofs.</p>
                </article>

                <article class="value-card">
                    <h3>Transparency earns trust.</h3>
                    <p>Our code is open source. Our threat model is documented.
                       Our limits are published. If we ever betray these
                       principles, the record will show it.</p>
                </article>

                <article class="value-card">
                    <h3>Slow is fine.</h3>
                    <p>We would rather be correct than fast. Platforms that
                       chase growth at any cost end up selling users to
                       survive. That is not a trap we intend to walk into.</p>
                </article>

                <article class="value-card">
                    <h3>You can always leave.</h3>
                    <p>No hostage data. No retention games. No soft delete.
                       Deleting your account destroys everything, permanently,
                       on the day you ask.</p>
                </article>

                <article class="value-card">
                    <h3>Communities over algorithms.</h3>
                    <p>We do not manipulate your feed to maximize engagement.
                       You see what your connections post, in order. Nothing
                       more, nothing less.</p>
                </article>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         ROADMAP
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">04</span>
                The Road Ahead
            </h2>

            <div class="roadmap">
                <div class="roadmap__item roadmap__item--done">
                    <span class="roadmap__dot"></span>
                    <div>
                        <h3>Backend — Complete</h3>
                        <p>Authentication, 2FA, profiles, uploads, posts,
                           comments, reactions, connections, notifications,
                           Web Push, and premium subscriptions.</p>
                    </div>
                </div>
                <div class="roadmap__item roadmap__item--current">
                    <span class="roadmap__dot"></span>
                    <div>
                        <h3>Web Frontend — In Progress</h3>
                        <p>Marketing pages, account flows, dashboard, profile
                           editor, feed. Public launch preparation.</p>
                    </div>
                </div>
                <div class="roadmap__item">
                    <span class="roadmap__dot"></span>
                    <div>
                        <h3>Android App</h3>
                        <p>Native client for Android devices, sharing the same
                           zero-knowledge API. Push notifications via FCM.</p>
                    </div>
                </div>
                <div class="roadmap__item">
                    <span class="roadmap__dot"></span>
                    <div>
                        <h3>Bug Bounty Program</h3>
                        <p>HackerOne launch with reputation and merchandise
                           rewards for responsible disclosure. Security
                           researchers as allies, not adversaries.</p>
                    </div>
                </div>
                <div class="roadmap__item">
                    <span class="roadmap__dot"></span>
                    <div>
                        <h3>iOS App</h3>
                        <p>Apple client for iOS devices. Requires Apple
                           Developer Program enrollment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FOUNDER
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">05</span>
                Who Built This
            </h2>

            <div class="panel founder-card founder-card--large">
                <div class="founder-card__avatar founder-card__avatar--rune">
                    <!-- Fallback rune — only visible if the image fails to load -->
                    <span class="founder-card__avatar-fallback" aria-hidden="true">ᛒ</span>
                
                    <!-- Your avatar image -->
                    <img
                        src="/assets/img/placeholder-og.jpg"
                        alt="Bearded Viking"
                        class="founder-card__avatar-img"
                        loading="lazy"
                        decoding="async"
                        onerror="this.style.display='none'">
                
                    <!-- Animated dashed ring, always on top -->
                    <span class="founder-card__avatar-ring" aria-hidden="true"></span>
                </div>

                <div class="founder-card__body">
                    <h3>Bearded Viking</h3>
                    <p class="founder-card__tagline">
                        Self-taught builder. Father of four. Privacy absolutist.
                    </p>
                    <p>
                        Building MyCitadel alone, one commit at a time, between
                        school runs and bedtime stories. Not because it is
                        easy — but because the platform that should exist
                        does not yet, and I am not willing to wait for
                        someone else to build it.
                    </p>
                    <p>
                        If any of this resonates with you — if you are a parent
                        who has felt the same unease, a developer who sees
                        the same rot, or just someone who thinks the internet
                        can be better — reach out. This is a long road, and
                        it is one worth walking together.
                    </p>
                    <div class="founder-card__links">
                        <a href="https://beardedviking.org" rel="noopener" class="btn-cyber">BeardedViking.org</a>
                        <a href="https://github.com/BeardedVikingTX" rel="noopener" class="btn-cyber">GitHub</a>
                        <a href="/contact" class="btn-cyber btn-gold">Reach Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FINAL CTA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--final">
        <div class="citadel-section__inner citadel-section__inner--center">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h2>Build It With Us.</h2>
            <p>A better internet is not a slogan. It is a choice, made one user at a time.</p>
            <a href="/register" class="btn-cyber btn-gold">Enter the Citadel</a>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>