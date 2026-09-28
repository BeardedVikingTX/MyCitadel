<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/INDEX.PHP ███
 * The public landing page. Hook, evidence, solution, and call to action.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

// ── Per-page meta ─────────────────────────────────────────────────────────
citadel_set_meta([
    'title'       => 'MyCitadel — Your Digital Fortress',
    'description' => 'A privacy-first social platform built on zero-knowledge architecture. Argon2id, envelope encryption, no tracking. Your data is encrypted before it ever reaches our servers.',
    'og_title'    => 'MyCitadel — Your Digital Fortress',
    'og_url'      => CITADEL_SITE_URL,
    'canonical'   => CITADEL_SITE_URL,
    'body_class'  => 'page-home',
]);

// ── Load includes ─────────────────────────────────────────────────────────
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main class="page-home__main">

    <!-- ═══════════════════════════════════════════════════════════════════
         HERO
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-hero">
        <div class="citadel-hero__inner">
            <span class="citadel-hero__rune" aria-hidden="true">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h1 class="citadel-title">MyCitadel</h1>
            <p class="citadel-subtitle">Your Digital Fortress</p>
            <p class="citadel-hero__lede">
                Social media has become surveillance. We built the alternative —
                a platform where your data is encrypted before it ever leaves your device.
                No trackers. No ad networks. No compromise.
            </p>
            <div class="citadel-hero__cta">
                <a href="/register" class="btn btn-outline-success btn-lg">
                    <button type="button" class="btn btn-outline-success btn-lg">
                        Enter the Citadel
                    </button>
                </a>
                <a href="#evidence" class="btn btn-outline-warning btn-lg">See the Evidence</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         THE EVIDENCE — "WHY YOU NEED A FORTRESS"
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="evidence">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Why We Built This</h2>
            <p class="citadel-section__lede">
                Every social platform you have ever used sells your attention.
                Here is what the public record shows about how they treat
                your data — and what it costs them when they get caught.
            </p>

            <div class="evidence-grid">

                <article class="panel evidence-card">
                    <h3>Meta (Facebook & Instagram)</h3>
                    <div class="evidence-card__stat">
                        <span class="evidence-card__number">43.8M</span>
                        <span class="evidence-card__label">Privacy Violations Found by Jury</span>
                    </div>
                    <ul class="evidence-card__list">
                        <li>Jury found Facebook liable for <strong>43.8 million violations</strong> of consumer protection law. <a href="https://nmdoj.gov/press-release/jury-finds-facebook-violated-new-mexico-consumer-protection-law-faces-billions-in-potential-civil-penalties/" target="_blank" rel="noopener">Source</a></li>
                        <li>Ranked the <strong>most invasive app</strong>, collecting 32 of 35 possible data types. <a href="https://techround.co.uk/news/facebook-instagram-invasive-apps-privacy-study/" target="_blank" rel="noopener">Source</a></li>
                        <li>Caught using a <strong>covert tracking tool</strong> on Android to link browsing data to identities even in incognito mode. <a href="https://www.euractiv.com/section/tech/news/spain-probes-meta-over-privacy-abuse-of-millions-of-android-users/" target="_blank" rel="noopener">Source</a></li>
                        <li>Fined <strong>€1.2 billion</strong> for illegally transferring user data to the US. <a href="https://gdprlocal.com/metas-e1-2-billion-gdpr-fine-why-it-still-matters-in-2025/" target="_blank" rel="noopener">Source</a></li>
                    </ul>
                    <div class="evidence-card__cost">
                        <strong>Their Premium Fee:</strong> $11.99 – $14.99/month
                    </div>
                </article>

                <article class="panel evidence-card">
                    <h3>TikTok</h3>
                    <div class="evidence-card__stat">
                        <span class="evidence-card__number">$400M</span>
                        <span class="evidence-card__label">Settlement for Children's Privacy Violations</span>
                    </div>
                    <ul class="evidence-card__list">
                        <li>Agreed to a <strong>$400 million settlement</strong> for violating children's privacy laws. <a href="https://hunton.sitepilot11.firmseek.com/2026/09/doj-reaches-400-million-settlement-with-tiktok-over-childrens-privacy-litigation/" target="_blank" rel="noopener">Source</a></li>
                        <li>Fined <strong>€345 million</strong> under GDPR for its handling of children's personal data. <a href="https://www.lexology.com/library/detail.aspx?g=8dd1b9fc-5e82-43ed-89b3-b1c34a2708ae" target="_blank" rel="noopener">Source</a></li>
                    </ul>
                    <div class="evidence-card__cost">
                        <strong>Their Ad-Free Fee:</strong> ~$5.50/month
                    </div>
                </article>

                <article class="panel evidence-card">
                    <h3>X (formerly Twitter)</h3>
                    <div class="evidence-card__stat">
                        <span class="evidence-card__number">$150M</span>
                        <span class="evidence-card__label">FTC Fine for Deceptive Data Use</span>
                    </div>
                    <ul class="evidence-card__list">
                        <li>Fined <strong>$150 million</strong> for using phone numbers and emails provided for security to target ads, affecting 140 million users. <a href="https://therecord.media/ftc-considers-modifying-150-million-twitter-privacy-fine" target="_blank" rel="noopener">Source</a></li>
                        <li>Under an FTC order that requires independent audits until <strong>2042</strong>. <a href="https://arstechnica.com/tech-policy/2026/06/elon-musk-tries-again-to-escape-ftc-audits-of-x-data-handling/" target="_blank" rel="noopener">Source</a></li>
                    </ul>
                    <div class="evidence-card__cost">
                        <strong>Their Premium Fee:</strong> $3 – $40/month
                    </div>
                </article>

                <article class="panel evidence-card">
                    <h3>LinkedIn</h3>
                    <div class="evidence-card__stat">
                        <span class="evidence-card__number">€310M</span>
                        <span class="evidence-card__label">GDPR Fine for Targeted Advertising</span>
                    </div>
                    <ul class="evidence-card__list">
                        <li>Fined <strong>€310 million</strong> for unlawfully processing personal data for behavioral analysis and targeted advertising without consent. <a href="https://www.gdprbuzz.com/news/linkedin-fined-e310-million-for-misusing-personal-data/" target="_blank" rel="noopener">Source</a></li>
                    </ul>
                    <div class="evidence-card__cost">
                        <strong>Their Premium Fee:</strong> $29.99+/month
                    </div>
                </article>

            </div>

            <div class="citadel-quote">
                "Why should you pay for a social media site, just to have them
                harvest your data, sell it to advertisers and political parties,
                and track your every move? They get your money <em>and</em> your data.
                That is not a business model. That is a shakedown."
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         THE MECHANISM — HOW WE'RE DIFFERENT
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">The Mechanism</h2>
            <p class="citadel-section__lede">
                This is not marketing. This is how the platform is actually
                built. Every claim below has a corresponding line of code
                you can audit on GitHub.
            </p>

            <div class="pillars-grid">
                <article class="panel pillar-card">
                    <div class="pillar-card__icon" aria-hidden="true">🔐</div>
                    <h3>Encrypted at Rest</h3>
                    <p>Email, phone, real name, address — every piece of personal data
                       is envelope-encrypted with a key derived just for you. A stolen
                       database yields nothing but ciphertext.</p>
                </article>

                <article class="panel pillar-card">
                    <div class="pillar-card__icon" aria-hidden="true">🛡️</div>
                    <h3>Argon2id Auth</h3>
                    <p>256 MiB of memory cost per password hash. Even with our entire
                       database in hand, a password cannot be recovered. Sessions are
                       fingerprinted and rotate on every privilege change.</p>
                </article>

                <article class="panel pillar-card">
                    <div class="pillar-card__icon" aria-hidden="true">⚔️</div>
                    <h3>Zero Tracking</h3>
                    <p>No analytics scripts. No third-party cookies. No fingerprinting.
                       The only cookie we set is the one that keeps you logged in —
                       and it never leaves our domain.</p>
                </article>

                <article class="panel pillar-card">
                    <div class="pillar-card__icon" aria-hidden="true">👁️</div>
                    <h3>Open Source</h3>
                    <p>Every line of code is public on GitHub. Audit it yourself, or
                       hire someone to. Security through architecture, not promises
                       or trust-me-bro marketing.</p>
                </article>
            </div>

            <div class="citadel-section__cta">
                <a href="https://github.com/BeardedVikingTX?tab=repositories" rel="noopener" class="btn-cyber" target="_blank">View Our Source Code</a>
                <a href="/security" class="btn-cyber">Read Our Security Promise</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         HOW IT WORKS
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">How It Works</h2>
            <p class="citadel-section__lede">Four steps from outsider to citizen.</p>

            <ol class="steps-grid">
                <li class="step-card">
                    <div class="step-card__num">01</div>
                    <h3>Register</h3>
                    <p>Choose a username, provide an email, set a strong password.
                       Verify ownership through a signed link.</p>
                </li>
                <li class="step-card">
                    <div class="step-card__num">02</div>
                    <h3>Harden</h3>
                    <p>Enable two-factor authentication. Scan the QR code with any
                       TOTP app. Save your recovery codes offline.</p>
                </li>
                <li class="step-card">
                    <div class="step-card__num">03</div>
                    <h3>Connect</h3>
                    <p>Send connection requests to people you trust. Nobody sees your
                       profile until you accept them — and vice versa.</p>
                </li>
                <li class="step-card">
                    <div class="step-card__num">04</div>
                    <h3>Engage</h3>
                    <p>Post, comment, react. Every interaction is connection-gated
                       and every privacy setting is honored completely.</p>
                </li>
            </ol>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         GUARANTEES
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Our Promises</h2>

            <div class="guarantee-list">
                <div class="guarantee-item">
                    <span class="guarantee-item__mark" aria-hidden="true">✓</span>
                    <div>
                        <strong>We do not sell your data. Ever.</strong>
                        <p>We have no business model that depends on knowing anything
                           about you. Premium subscriptions are how this platform
                           stays alive.</p>
                    </div>
                </div>

                <div class="guarantee-item">
                    <span class="guarantee-item__mark" aria-hidden="true">✓</span>
                    <div>
                        <strong>You can leave at any time.</strong>
                        <p>Account deletion destroys your posts, comments, reactions,
                           and connections — permanently. No soft-delete limbo, no
                           data retention games.</p>
                    </div>
                </div>

                <div class="guarantee-item">
                    <span class="guarantee-item__mark" aria-hidden="true">✓</span>
                    <div>
                        <strong>We pay for bugs.</strong>
                        <p>Once we launch, we will run a HackerOne bug bounty
                           program. Security researchers are invited — and rewarded.</p>
                    </div>
                </div>

                <div class="guarantee-item">
                    <span class="guarantee-item__mark" aria-hidden="true">✓</span>
                    <div>
                        <strong>Security you can verify.</strong>
                        <p>Our code is public on GitHub. Our threat model is
                           documented. Our limits are published. Audit us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         PREMIUM TEASER
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section">
        <div class="citadel-section__inner">
            <div class="panel premium-teaser">
                <span class="premium-teaser__badge">Premium</span>
                <h2>$10 / month</h2>
                <p>Advanced features, priority support, higher limits, and
                   exclusive badges. Cancel anytime, no hidden fees. Billed
                   securely through Stripe.</p>
                <a href="/premium" class="btn-cyber btn-gold">Explore Premium</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FINAL CTA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--final">
        <div class="citadel-section__inner citadel-section__inner--center">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h2>Your Data Should Be Yours Alone.</h2>
            <p>Join the citizens building a better internet.</p>
            <a href="/register" class="btn-cyber btn-gold">Enter the Citadel</a>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>