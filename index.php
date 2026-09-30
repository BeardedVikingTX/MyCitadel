<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/INDEX.PHP ███
 * The public landing page. Hook, evidence, features, tiers, and CTA.
 * ----------------------------------------------------------------------------
 * Section order (why it's this order):
 *   01 Hero        — what is this, why care, two doors in
 *   02 Evidence    — the problem (public record of the others)
 *   03 Mechanism   — the difference (how we're built)
 *   04 Arsenal     — the features (what you actually get to do)
 *   05 Tiers       — Free vs Premium (what free covers, what $10 unlocks)
 *   06 Shield      — Stalker Shield (why parents can trust this)
 *   07 Journey     — How it works, four steps
 *   08 Promises    — the guarantees, no weasel words
 *   09 Android     — take it with you (Play Store coming)
 *   10 Final CTA
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'MyCitadel — Your Digital Fortress',
    'description' => 'A privacy-first social platform built on encrypted-by-architecture design. Argon2id authentication, envelope-encrypted PII, no trackers, no ad networks, no data sale. Free to use. $10/month if you want more.',
    'og_title'    => 'MyCitadel — Your Digital Fortress',
    'og_url'      => CITADEL_SITE_URL,
    'canonical'   => CITADEL_SITE_URL,
    'body_class'  => 'page-home',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main class="page-home__main">

    <!-- ═══════════════════════════════════════════════════════════════════
         01 — HERO
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-hero">
        <div class="citadel-hero__inner">
            <span class="citadel-hero__rune" aria-hidden="true">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>

            <h1 class="citadel-title">MyCitadel</h1>
            <p class="citadel-subtitle">Your Digital Fortress</p>

            <p class="citadel-hero__lede">
                Every social platform you use sells your attention.
                We built the one that cannot — because we never see your data
                in the first place. Encrypted before it leaves your device.
                No trackers. No ad networks. No compromise.
            </p>

            <div class="citadel-hero__cta">
                <a href="/register" class="btn-cyber btn-gold btn-lg">Enter the Citadel</a>
                <a href="#tiers" class="btn-cyber btn-lg">See Free vs Premium</a>
            </div>

            <ul class="citadel-hero__stats" aria-label="Platform facts">
                <li><strong>0</strong> third-party trackers</li>
                <li><strong>0</strong> ad networks</li>
                <li><strong>0</strong> data sold</li>
                <li><strong>100%</strong> visible source</li>
            </ul>

            <p class="citadel-hero__fine">
                Free forever. Premium at <strong>$10/month</strong> if you want higher limits.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         02 — EVIDENCE
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
                    <h3>Meta (Facebook &amp; Instagram)</h3>
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
         03 — MECHANISM
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
         04 — ARSENAL (what you actually get to do)
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="features">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">The Arsenal</h2>
            <p class="citadel-section__lede">
                Everything you need to actually live online — without giving
                your life away to do it. All features below are live today.
            </p>

            <div class="arsenal-grid">

                <article class="panel arsenal-card">
                    <h3>⚔ Connections, Not Followers</h3>
                    <p>Mutual by design. Nobody sees your profile, posts, or comments
                       unless you accept them first — and vice versa. Blocking is
                       silent, mutual, and permanent.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>📡 Posts With Real Privacy</h3>
                    <p>Every post carries its own visibility — public, connections-only,
                       or private to yourself. Attach images, video, audio, documents,
                       or archives. Edit freely. Delete for real.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>💬 Threaded Comments</h3>
                    <p>Reply to replies. The conversation stays coherent. Comment
                       visibility follows the post's own visibility — no leaks, no
                       gotchas.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>❤ Reactions That Say Something</h3>
                    <p>Like, dislike, heart, angry. Real emotional vocabulary, not
                       just a binary thumb. Reaction counts on every post.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>✉ Encrypted Messaging</h3>
                    <p>Direct conversations with your connections. Attach files.
                       Every message encrypted at rest. Sever a connection and the
                       whole conversation is destroyed — not archived, destroyed.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>🔔 Real-Time Notifications</h3>
                    <p>Web Push to your browser. Know when someone connects,
                       comments, or reacts — without a tab open. No tracking pixel
                       hiding in the notification payload.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>🏆 Reputation &amp; Badges</h3>
                    <p>Earn reputation for posting, commenting, connecting, and
                       helping. Unlock badges for milestones. Every award is
                       recorded in an immutable ledger you can inspect.</p>
                </article>

                <article class="panel arsenal-card">
                    <h3>🎨 Full Profile Control</h3>
                    <p>Avatar, banner, wallpaper, accent color, fonts, borders,
                       background music. 60+ fields. Every piece of PII optional
                       and encrypted. Your space, your rules.</p>
                </article>

                <article class="panel arsenal-card">
                    <div class="arsenal-card__icon" aria-hidden="true">🔍</div>
                    <h3>Discovery Without Exposure</h3>
                    <p>Search by username or display name. Blocked users never
                       appear. Hidden accounts return 404 — never "you cannot
                       view this user." No existence leak.</p>
                </article>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         05 — TIERS (Free vs Premium — the centerpiece)
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark" id="tiers">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Free vs Premium</h2>
            <p class="citadel-section__lede">
                MyCitadel is free forever. Premium is for Citizens who want
                more room, more reach, and more tools — and it is the only
                thing keeping this platform alive. No ads. No data sale.
                Just $10/month if you choose it.
            </p>

            <!-- ── Two pricing cards ──────────────────────────────────── -->
            <div class="tier-cards">

                <article class="tier-card tier-card--free">
                    <span class="tier-card__badge">Free</span>
                    <h3 class="tier-card__name">Forever</h3>
                    <div class="tier-card__price">$0<span>/month</span></div>
                    <p class="tier-card__tagline">
                        The full platform. Free is not a demo — it is the
                        Citadel, and it always will be.
                    </p>
                    <ul class="tier-card__highlights">
                        <li>Post up to 50 characters + 1 image</li>
                        <li>Comment up to 25 characters</li>
                        <li>Like &amp; dislike reactions</li>
                        <li>1-on-1 encrypted messaging</li>
                        <li>All privacy &amp; connection controls</li>
                    </ul>
                    <a href="/register" class="btn-cyber tier-card__cta">Create free account</a>
                </article>

                <article class="tier-card tier-card--premium">
                    <span class="tier-card__badge tier-card__badge--gold">Premium</span>
                    <h3 class="tier-card__name">Citadel+</h3>
                    <div class="tier-card__price tier-card__price--gold">$10<span>/month</span></div>
                    <p class="tier-card__tagline">
                        Higher limits, all four reactions, group messaging
                        with admin controls, and a badge that announces
                        itself everywhere you appear.
                    </p>
                    <ul class="tier-card__highlights">
                        <li>Post up to <strong>1,500 chars</strong> + 10 attachments</li>
                        <li>Comment up to <strong>1,500 chars</strong> + 5 attachments</li>
                        <li>All reactions: like, dislike, heart, angry</li>
                        <li>Group messaging + admin moderation</li>
                        <li><strong>+2,500 reputation</strong> every month</li>
                    </ul>
                    <a href="/register" class="btn-cyber btn-gold tier-card__cta">Go Premium</a>
                </article>

            </div>

            <!-- ── Full comparison table ─────────────────────────────── -->
            <div class="tier-compare">

                <!-- Header row -->
                <div class="tier-compare__head tier-compare__head--label"></div>
                <div class="tier-compare__head tier-compare__head--free">Free</div>
                <div class="tier-compare__head tier-compare__head--premium">Premium</div>

                <!-- ── Posts ──────────────────────────────────────────── -->
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

                <!-- ── Comments ───────────────────────────────────────── -->
                <div class="tier-compare__group">Comments</div>

                <div class="tier-compare__label">Comment length</div>
                <div class="tier-compare__free">25 characters</div>
                <div class="tier-compare__premium">1,500 characters</div>

                <div class="tier-compare__label">Attachments per comment</div>
                <div class="tier-compare__free">1 image</div>
                <div class="tier-compare__premium">Up to 5 — all file types</div>

                <!-- ── Reactions ──────────────────────────────────────── -->
                <div class="tier-compare__group">Reactions</div>

                <div class="tier-compare__label">Available reactions</div>
                <div class="tier-compare__free">Like · Dislike</div>
                <div class="tier-compare__premium">Like · Dislike · Heart · Angry</div>

                <!-- ── Messaging ──────────────────────────────────────── -->
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

                <!-- ── Profile & Standing ─────────────────────────────── -->
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

            </div><!-- /.tier-compare -->

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
         06 — STALKER SHIELD
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="shield">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Stalker Shield</h2>
            <p class="citadel-section__lede">
                The most dangerous feature of any social platform is the ease
                with which a stranger can find, watch, and follow someone.
                We built against that from day one.
            </p>

            <div class="shield-preview">

                <article class="panel shield-preview__card">
                    <h3>Visibility Is a Choice</h3>
                    <p>Nothing about you is public by default. Every profile,
                       every post, every comment sits behind an accepted
                       connection. You decide who sees what, per person,
                       at any time.</p>
                </article>

                <article class="panel shield-preview__card">
                    <h3>Silent, Permanent Blocks</h3>
                    <p>Blocking is mutual, immediate, and silent. The blocked
                       party gets no notification — they simply vanish from
                       your world, and you from theirs. No escalation, no
                       "user X blocked you" message.</p>
                </article>

                <article class="panel shield-preview__card">
                    <h3>Invisible Mode</h3>
                    <p>Set your account to hidden and you become invisible to
                       everyone but yourself. Even a direct ID guess returns
                       404 — no existence leak. This is a permanent option,
                       not a temporary state.</p>
                </article>

                <article class="panel shield-preview__card">
                    <h3>No Cold Contact</h3>
                    <p>Messaging requires an accepted connection. Connection
                       requests require mutual acceptance. There is no way
                       for a stranger to reach you. Not one. No cold DMs,
                       ever.</p>
                </article>

            </div>

            <div class="citadel-section__cta">
                <a href="/security#stalker-shield" class="btn-cyber">Read the Full Stalker Shield</a>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         07 — HOW IT WORKS
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
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
                    <p>Send connection requests to people you trust. Nobody sees
                       your profile until you accept them — and vice versa.</p>
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
         08 — PROMISES
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section">
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
                           data retention games. When we say delete, we mean it.</p>
                    </div>
                </div>

                <div class="guarantee-item">
                    <span class="guarantee-item__mark" aria-hidden="true">✓</span>
                    <div>
                        <strong>Free is not a demo.</strong>
                        <p>Everything you need to actually use the platform is
                           available for free, forever. Premium exists for people
                           who want more — not to hold the basic experience hostage.</p>
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
         09 — ANDROID
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark" id="android">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Take The Citadel With You</h2>
            <p class="citadel-section__lede">
                The native Android app talks to the same encrypted backend
                as the web. Same account, same posts, same privacy — in your pocket.
            </p>

            <div class="panel android-card">
                <div class="android-card__icon" aria-hidden="true">🤖</div>

                <div class="android-card__body">
                    <div class="android-card__heading">
                        <h3>MyCitadel for Android</h3>
                        <span class="android-card__badge">BETA</span>
                    </div>

                    <ul class="android-card__meta">
                        <li><strong>Version</strong> v0.3.0</li>
                        <li><strong>Requires</strong> Android 8.0+</li>
                        <li><strong>Size</strong> ~15 MB</li>
                        <li><strong>Updated</strong> Sep 2026</li>
                    </ul>

                    <p class="android-card__note">
                        The current beta is a debug build — sideloaded from this
                        page only. A signed release build with in-app Google Play
                        Billing is being prepared and will ship on the Google Play
                        Store. When it does, beta users will be able to migrate
                        cleanly.
                    </p>

                    <div class="android-card__actions">
                        <a href="/downloads/MyCitadel-Beta-v0.3.0.apk"
                           download
                           class="btn-cyber btn-gold">
                            Download Beta APK
                        </a>
                        <a href="#install-instructions" class="btn-cyber">
                            How to Install
                        </a>
                    </div>
                </div>
            </div>

            <div class="android-install" id="install-instructions">
                <h3>Installing the Beta</h3>
                <ol>
                    <li>
                        <strong>Download the APK</strong> on your Android phone.
                        Tap the download button above, or scan the QR code.
                    </li>
                    <li>
                        <strong>Allow installs from this source.</strong>
                        When Android asks, tap <em>Settings</em> and enable
                        &ldquo;Allow from this source&rdquo; for your browser
                        (Chrome, Firefox, etc.).
                    </li>
                    <li>
                        <strong>Open the APK.</strong>
                        From the notification tray, or Files → Downloads →
                        <code>MyCitadel-Beta-v0.3.0.apk</code>.
                    </li>
                    <li>
                        <strong>Tap &ldquo;Install anyway&rdquo;</strong> if
                        Play Protect shows a warning. Only install the file
                        you downloaded from <code>mycitadel.lol</code> — verify
                        the URL in your browser's address bar.
                    </li>
                    <li>
                        <strong>Open the app, register, and explore.</strong>
                        Report bugs to <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>.
                    </li>
                </ol>

                <p class="android-install__warn">
                    <strong>⚠️ Sideloading warning:</strong>
                    Installing apps outside of the Play Store carries risk.
                    Only install from sources you trust. Every APK from
                    MyCitadel is served from <code>mycitadel.lol</code> over
                    HTTPS. Never install an APK that claims to be MyCitadel
                    from any other source.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         10 — FINAL CTA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--final">
        <div class="citadel-section__inner citadel-section__inner--center">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h2>Your Data Should Be Yours Alone.</h2>
            <p>Join the citizens building a better internet.</p>
            <div class="citadel-hero__cta">
                <a href="/register" class="btn-cyber btn-gold btn-lg">Enter the Citadel</a>
                <a href="#tiers" class="btn-cyber btn-lg">Compare Free vs Premium</a>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>