<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/SECURITY.PHP ███
 * Security & Privacy — the mechanism, the guarantees, the limits.
 * ----------------------------------------------------------------------------
 * Anchors supported (via /security#<fragment>):
 *   #promise           — the core security promise
 *   #mechanisms        — how protection is implemented
 *   #stalker-shield    — anti-stalking, anti-harassment controls
 *   #no-backdoors      — no admin spy panels, no oversight tools
 *   #no-data-sale      — we cannot sell what we cannot read
 *   #bug-bounty        — HackerOne + email disclosure program
 *   #limits            — what we explicitly do NOT promise
 *   #report            — how to submit a vulnerability
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Security & Privacy — MyCitadel',
    'description' => 'How MyCitadel protects your data. Envelope encryption, Argon2id, session fingerprinting, anti-stalking controls, no admin spy panels, and an open bug bounty program. The honest threat model.',
    'og_title'    => 'Security & Privacy at MyCitadel',
    'og_description' => 'Real mechanisms. Real limits. No marketing fluff.',
    'og_url'      => CITADEL_SITE_URL . '/security',
    'canonical'   => CITADEL_SITE_URL . '/security',
    'body_class'  => 'page-security',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main class="page-security__main">

    <!-- ═══════════════════════════════════════════════════════════════════
         HERO — locked shield, floating runes, glitched title
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="security-hero">

        <!-- Floating decorative runes -->
        <span class="about-float about-float--1" aria-hidden="true">ᛉ</span>
        <span class="about-float about-float--2" aria-hidden="true">ᛏ</span>
        <span class="about-float about-float--3" aria-hidden="true">ᚨ</span>
        <span class="about-float about-float--4" aria-hidden="true">ᛒ</span>
        <span class="about-float about-float--5" aria-hidden="true">ᛗ</span>
        <span class="about-float about-float--6" aria-hidden="true">ᚠ</span>

        <div class="security-hero__inner">
            <span class="about-hero__eyebrow">Security &amp; Privacy</span>
            <h1 class="about-hero__title glitch" data-text="Security">Security</h1>
            <p class="about-hero__subtitle">Not Promises. Mechanism.</p>
            <p class="about-hero__lede">
                Every claim on this page corresponds to a line of code you can
                audit on GitHub. Every protection has a defined failure mode.
                Every limit is written down. This is the threat model, published.
            </p>

            <!-- Quick-jump pills -->
            <nav class="security-toc" aria-label="Sections">
                <a href="#promise">The Promise</a>
                <a href="#mechanisms">Mechanisms</a>
                <a href="#stalker-shield">Stalker Shield</a>
                <a href="#no-backdoors">No Backdoors</a>
                <a href="#no-data-sale">Data Sales</a>
                <a href="#bug-bounty">Bug Bounty</a>
                <a href="#limits">Limits</a>
                <a href="#report">Report</a>
            </nav>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #promise — THE PROMISE
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="promise">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">01</span>
                The Promise
            </h2>

            <blockquote class="about-quote">
                Your private data is encrypted before it reaches us. We cannot
                read your email address, your phone number, your real name, or
                your physical address. If our database is ever compromised,
                what leaks is ciphertext — useless without keys that live in
                a separate, isolated location.
            </blockquote>

            <p class="about-lede">
                This is not a marketing bullet. It is the architecture. We built
                MyCitadel so that <strong>we cannot betray you even if we wanted
                to</strong> — because we do not have the ability to read the
                data in the first place.
            </p>

            <div class="security-facts">
                <div class="security-fact">
                    <span class="security-fact__num">15</span>
                    <span class="security-fact__label">PII fields encrypted at rest</span>
                </div>
                <div class="security-fact">
                    <span class="security-fact__num">256<span class="security-fact__unit">MiB</span></span>
                    <span class="security-fact__label">Memory cost per Argon2id hash</span>
                </div>
                <div class="security-fact">
                    <span class="security-fact__num">0</span>
                    <span class="security-fact__label">Third-party tracking scripts</span>
                </div>
                <div class="security-fact">
                    <span class="security-fact__num">0</span>
                    <span class="security-fact__label">Admin spy panels</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #mechanisms — HOW WE PROTECT YOU
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark" id="mechanisms">
        <div class="citadel-section__inner">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">02</span>
                The Mechanisms
            </h2>

            <p class="citadel-section__lede" style="text-align:center; margin-left:auto; margin-right:auto;">
                Every item below is implemented. Every item is auditable.
                Nothing here is aspirational.
            </p>

            <div class="mechanisms-grid">

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🔐</div>
                    <h3>Argon2id Password Hashing</h3>
                    <p>Passwords are hashed with <strong>256 MiB memory cost,
                       4 iterations, 2 threads</strong>. Even with our entire
                       users table in hand, recovering a single password requires
                       infeasible compute. Silent rehash upgrades old hashes on
                       next login — no user ever sees a "please reset" prompt.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🗝️</div>
                    <h3>Envelope Encryption for PII</h3>
                    <p>Every personal field — email, phone, real name, address,
                       date of birth — is encrypted with a <strong>per-user key
                       derived from a master key</strong>. The master key lives
                       outside the database, in a directory the web server
                       cannot serve. A stolen DB dump yields ciphertext only.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🎯</div>
                    <h3>Blind Index Lookups</h3>
                    <p>We check "is this email already registered?" without ever
                       storing the email in plaintext. Keyed HMAC indexes give
                       us uniqueness enforcement and lookup — with zero
                       recoverable plaintext on disk.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🧬</div>
                    <h3>Session Fingerprinting</h3>
                    <p>Every session is bound to your browser's
                       <strong>User-Agent + Accept-Language + client hints</strong>.
                       A cookie stolen from Chrome will not validate in Firefox.
                       Session IDs rotate on every login, logout, and password
                       change — fixation attacks do not survive.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🔑</div>
                    <h3>Two-Factor Authentication</h3>
                    <p>TOTP-based, compatible with Google Authenticator,
                       Microsoft Authenticator, Authy, 1Password, Bitwarden,
                       and any RFC 6238 app. Secrets are encrypted at rest.
                       Recovery codes are single-use and stored only as hashes.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🚫</div>
                    <h3>No Third-Party Trackers</h3>
                    <p>No Google Analytics. No Facebook Pixel. No Cloudflare
                       Insights. No session-replay tools. The only third-party
                       script on any page is Stripe.js, loaded exclusively
                       during the checkout flow.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">🛡️</div>
                    <h3>CSRF, XSS, SSRF, IDOR Defenses</h3>
                    <p>Double-submit CSRF tokens on every unsafe request.
                       Strict Content-Security-Policy without inline scripts.
                       SSRF host allowlist on push subscriptions. Every mutating
                       endpoint scoped to the session user — no client-supplied
                       user IDs are trusted for authorization.</p>
                </article>

                <article class="panel mechanism-card">
                    <div class="mechanism-card__icon" aria-hidden="true">📋</div>
                    <h3>Structured Audit Logging</h3>
                    <p>Authentication events are logged with <strong>hashed IPs</strong>
                       and per-request correlation IDs. Every log line is
                       JSON-formatted, greppable, and retained per published
                       schedule. No plaintext PII appears in any log entry.</p>
                </article>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #stalker-shield — ANTI-STALKING CONTROLS
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="stalker-shield">
        <div class="citadel-section__inner">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">03</span>
                Stalker Shield
            </h2>

            <p class="citadel-section__lede" style="text-align:center; margin-left:auto; margin-right:auto;">
                The most dangerous feature of any social platform is the ease
                with which a stranger can find, watch, and follow someone.
                We designed against that from day one.
            </p>

            <div class="shield-grid">

                <article class="panel shield-card shield-card--visibility">
                    <div class="shield-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M32 6 L54 16 v18 c0 12 -9 20 -22 24 c-13 -4 -22 -12 -22 -24 v-18 z"/>
                            <circle cx="32" cy="28" r="5"/>
                            <path d="M22 46 c0 -6 5 -10 10 -10 s10 4 10 10"/>
                        </svg>
                    </div>
                    <h3>Visibility Is a Choice</h3>
                    <p>Nothing about you is public by default. Your profile, your
                       posts, your connections — all gated behind accepted
                       connection requests. You decide who sees what, per
                       person, at any time.</p>
                </article>

                <article class="panel shield-card shield-card--blocks">
                    <div class="shield-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="32" cy="32" r="22"/>
                            <path d="M18 18 L46 46"/>
                            <path d="M46 18 L18 46"/>
                        </svg>
                    </div>
                    <h3>Silent, Permanent Blocks</h3>
                    <p>Blocking is mutual, immediate, and <strong>silent</strong>.
                       The blocked party gets no notification — they simply
                       vanish from your world, and you from theirs. No "user
                       X blocked you" message that could escalate tensions.</p>
                </article>

                <article class="panel shield-card shield-card--hidden">
                    <div class="shield-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 32 c8 -12 16 -18 24 -18 s16 6 24 18 c-8 12 -16 18 -24 18 s-16 -6 -24 -18 z"/>
                            <circle cx="32" cy="32" r="7" fill="currentColor" opacity="0.3"/>
                            <path d="M12 52 L52 12"/>
                        </svg>
                    </div>
                    <h3>Invisible Mode</h3>
                    <p>Set your account to <strong>"hidden"</strong> and you
                       become invisible to everyone except yourself. Even a
                       direct ID guess returns 404 — no existence leak. This
                       is a permanent option, not a temporary state.</p>
                </article>

                <article class="panel shield-card shield-card--noenum">
                    <div class="shield-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="32" cy="32" r="22"/>
                            <path d="M32 22 v10"/>
                            <circle cx="32" cy="42" r="2" fill="currentColor"/>
                        </svg>
                    </div>
                    <h3>Silent 404s, Never 403s</h3>
                    <p>When you cannot view something, you get a
                       <strong>404 Not Found</strong> — never a
                       "You are not allowed" message. Attackers cannot use our
                       error messages to enumerate who exists on the platform.</p>
                </article>

                <article class="panel shield-card shield-card--sever">
                    <div class="shield-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M32 8 v20"/>
                            <path d="M20 28 L32 8 L44 28"/>
                            <path d="M14 40 h36"/>
                            <path d="M18 40 v12 h28 v-12"/>
                        </svg>
                    </div>
                    <h3>Sever Destroys Everything</h3>
                    <p>End a connection and every message between the two of you
                       is <strong>destroyed</strong>. Not hidden, not archived,
                       not soft-deleted. Gone from the servers. Reputation
                       scores are adjusted on both sides.</p>
                </article>

                <article class="panel shield-card shield-card--mute">
                    <div class="shield-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 64 64" width="52" height="52" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="32" cy="24" r="8"/>
                            <path d="M16 52 c0 -9 7 -16 16 -16 s16 7 16 16"/>
                            <path d="M48 16 L60 4"/>
                        </svg>
                    </div>
                    <h3>No Contact Without Consent</h3>
                    <p>You cannot see another user's profile, posts, or comments
                       unless you are connected. Messaging requires connection.
                       Connection requests require mutual acceptance. <strong>No
                       cold DMs. Ever.</strong></p>
                </article>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #no-backdoors — NO ADMIN SPY PANELS
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark" id="no-backdoors">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">04</span>
                No Backdoors
            </h2>

            <p class="about-lede">
                Most platforms quietly build an "admin panel" that lets staff
                read user messages, view private posts, and inspect profiles.
                They call it "trust and safety," "content moderation," or
                "compliance tooling." Regardless of the label, the outcome is
                the same: <em>your private data has more readers than you
                think</em>.
            </p>

            <p class="about-lede">
                MyCitadel has no such panel. <strong>There is no administrative
                interface to read user data — because there is no way for us
                to read it in the first place.</strong> The encryption is not
                a feature that admins can bypass. It is the substrate the
                platform is built on.
            </p>

            <div class="no-backdoor-grid">
                <div class="no-backdoor-item">
                    <span class="no-backdoor-item__check" aria-hidden="true">✗</span>
                    <div>
                        <strong>No admin "view user's email" tool</strong>
                        <p>Emails are encrypted with a key we cannot derive
                           without the user's ID and the master key. There is
                           no button that decrypts it.</p>
                    </div>
                </div>

                <div class="no-backdoor-item">
                    <span class="no-backdoor-item__check" aria-hidden="true">✗</span>
                    <div>
                        <strong>No private message reader</strong>
                        <p>Messages are end-to-end encrypted in the current
                           architecture. Staff cannot see them.</p>
                    </div>
                </div>

                <div class="no-backdoor-item">
                    <span class="no-backdoor-item__check" aria-hidden="true">✗</span>
                    <div>
                        <strong>No "search all users by real name" tool</strong>
                        <p>Real names are encrypted. We cannot build a search
                           index on data we cannot read.</p>
                    </div>
                </div>

                <div class="no-backdoor-item">
                    <span class="no-backdoor-item__check" aria-hidden="true">✗</span>
                    <div>
                        <strong>No shadow profile building</strong>
                        <p>We do not accept third-party data feeds, purchase
                           marketing lists, or infer user traits from browsing
                           patterns. We only know what you tell us — and even
                           that is encrypted.</p>
                    </div>
                </div>
            </div>

            <blockquote class="about-quote" style="margin-top:2.5rem;">
                We do not want to see your private data. We cannot see your
                private data. Those two facts are the same design decision,
                made twice.
            </blockquote>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #no-data-sale — WE CANNOT SELL YOUR DATA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="no-data-sale">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">05</span>
                We Cannot Sell Your Data
            </h2>

            <p class="about-lede">
                Other platforms promise they will not sell your data. We do not
                have to promise — because <strong>we do not have anything to
                sell.</strong>
            </p>

            <p class="about-lede">
                Your email address is ciphertext. Your real name is ciphertext.
                Your phone number is ciphertext. Your address is ciphertext.
                There is no advertiser willing to pay for a base64 string that
                even we cannot read. When we say "your data is not for sale,"
                we mean it literally — there is no product to offer.
            </p>

            <div class="math-callout">
                <div class="math-callout__glyph" aria-hidden="true">Σ</div>
                <div class="math-callout__body">
                    <h3>The only thing we could ever sell is mathematics.</h3>
                    <p>And nobody wants to buy our equations. They want your
                       behavior, your attention, your identity — none of which
                       we have access to. This is what "privacy by architecture"
                       actually means.</p>
                </div>
            </div>

            <div class="business-model">
                <h3>How We Stay Alive</h3>
                <p>
                    MyCitadel is funded entirely by <strong>$10/month premium
                    subscriptions</strong> and donations. We do not run ads. We
                    do not accept sponsored content. We do not have investors
                    demanding growth-at-any-cost. Premium features are the
                    entire business model — and that is intentional.
                </p>
                <p class="business-model__note">
                    A platform funded by users cannot betray users without
                    losing its users. A platform funded by advertisers cannot
                    serve users without betraying them. That is the entire
                    difference between the two models.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #bug-bounty — THE PROGRAM
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark bounty-section" id="bug-bounty">
        <div class="citadel-section__inner">

            <div class="bounty-hero">
                <span class="bounty-hero__icon" aria-hidden="true">
                    <svg viewBox="0 0 64 64" width="72" height="72" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M32 6 L54 16 v18 c0 12 -9 20 -22 24 c-13 -4 -22 -12 -22 -24 v-18 z"/>
                        <path d="M22 32 l8 8 l14 -16"/>
                    </svg>
                </span>
                <h2 class="about-h2 about-h2--center" style="justify-content:center;">
                    <span class="about-h2__mark" aria-hidden="true">06</span>
                    Bug Bounty Program
                </h2>
                <p class="bounty-hero__lede">
                    We believe security researchers should be allies, not
                    adversaries. If you find a vulnerability in MyCitadel,
                    tell us first. We will treat you with respect, credit you
                    publicly, and reward you.
                </p>

                <div class="bounty-status">
                    <span class="bounty-status__dot" aria-hidden="true"></span>
                    <span class="bounty-status__text">
                        <strong>Status: Open via email.</strong>
                        HackerOne profile launching soon.
                    </span>
                </div>
            </div>

            <!-- ── Reward Tiers ─────────────────────────────────────────── -->
            <h3 class="bounty-subhead">Rewards</h3>

            <div class="bounty-tiers">

                <article class="panel bounty-tier bounty-tier--merch">
                    <div class="bounty-tier__badge">Low → Critical</div>
                    <h4>Merch + Reputation</h4>
                    <p>All valid vulnerabilities earn:</p>
                    <ul>
                        <li><strong>Recognition</strong> in our public Hall of Fame</li>
                        <li><strong>Reputation points</strong> on MyCitadel</li>
                        <li><strong>Exclusive "Bug Hunter" badge</strong> — never available any other way</li>
                        <li><strong>MyCitadel merchandise</strong> for High/Critical findings (shirt, hoodie, or mug depending on severity)</li>
                    </ul>
                </article>

                <article class="panel bounty-tier bounty-tier--cash">
                    <div class="bounty-tier__badge bounty-tier__badge--cash">Rare / Extreme</div>
                    <h4>Up to $1,000 USD</h4>
                    <p>For truly exceptional findings, a financial reward
                       <strong>may</strong> be offered — up to <strong>$1,000</strong>,
                       at the owner's discretion. This applies when:</p>
                    <ul>
                        <li>The impact is <strong>proven</strong> and severe (RCE, mass data exposure, auth bypass at scale)</li>
                        <li>Steps to reproduce are <strong>complete and verified</strong></li>
                        <li>A remediation is <strong>identified or recommended</strong></li>
                        <li>The finding is <strong>novel</strong> — not a duplicate or known issue</li>
                    </ul>
                    <p class="bounty-tier__note">
                        <em>Honest disclosure:</em> MyCitadel is built by one
                        person with a full-time job. Financial rewards are
                        possible but not guaranteed. Do not spend a week on
                        an audit expecting a payout — spend it because you
                        care about the mission, and we will reward what we
                        can.
                    </p>
                </article>
            </div>

            <!-- ── What We're Looking For ───────────────────────────────── -->
            <h3 class="bounty-subhead">What We're Looking For</h3>

            <div class="bounty-scope">
                <div class="bounty-scope__col bounty-scope__col--in">
                    <h4>In Scope</h4>
                    <ul>
                        <li><code>api.mycitadel.lol</code> — the entire API surface</li>
                        <li><code>mycitadel.lol</code> — the web frontend</li>
                        <li>Authentication, session management, 2FA flows</li>
                        <li>Authorization / IDOR vulnerabilities</li>
                        <li>Encryption weaknesses (bypass, downgrade, key leak)</li>
                        <li>SQL injection, XSS, CSRF, SSRF</li>
                        <li>Business logic flaws (reputation farming, privilege escalation)</li>
                        <li>Privacy leaks — any way to see data you should not</li>
                        <li>Rate-limit bypasses</li>
                        <li>Upload-handling vulnerabilities</li>
                    </ul>
                </div>

                <div class="bounty-scope__col bounty-scope__col--out">
                    <h4>Out of Scope</h4>
                    <ul>
                        <li>Denial of Service / volumetric attacks</li>
                        <li>Social engineering of staff or users</li>
                        <li>Physical attacks against infrastructure</li>
                        <li>Third-party services (Stripe, cPanel, LiteSpeed)</li>
                        <li>Reports generated purely by automated scanners</li>
                        <li>Missing security headers with no demonstrated impact</li>
                        <li>Self-XSS that requires pasting code into DevTools</li>
                        <li>Theoretical vulnerabilities without proof of concept</li>
                    </ul>
                </div>
            </div>

            <!-- ── Rules of Engagement ──────────────────────────────────── -->
            <div class="bounty-rules">
                <h3>Rules of Engagement</h3>
                <ol>
                    <li>
                        <strong>Do not test on real users.</strong>
                        Create your own test accounts. Never attempt to access
                        another user's data, even if you think you can.
                    </li>
                    <li>
                        <strong>Do not disrupt the service.</strong>
                        No DoS. No load testing. No aggressive fuzzing that
                        degrades performance for others.
                    </li>
                    <li>
                        <strong>Report privately first.</strong>
                        Give us time to fix before you publish. We aim to
                        acknowledge within 72 hours and remediate critical
                        findings within 7 days.
                    </li>
                    <li>
                        <strong>Do not exfiltrate data.</strong>
                        If you find a leak, prove it with minimal sample data.
                        Do not download the whole database.
                    </li>
                    <li>
                        <strong>One finding per report.</strong>
                        Do not bundle five unrelated issues into a single
                        submission. We will not be able to reward them
                        properly.
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #limits — WHAT WE DO NOT PROMISE
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section" id="limits">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">07</span>
                What We Do Not Promise
            </h2>

            <p class="about-lede">
                Honesty matters more than marketing. These are the boundaries
                of what MyCitadel can and cannot protect you from.
            </p>

            <ul class="limits-list">
                <li>
                    <strong>We are not zero-knowledge in v1.</strong>
                    <p>Email is decrypted server-side to send verification links
                       and password resets. The server holds the master key.
                       True zero-knowledge requires client-held keys — which
                       breaks account recovery. That is a v2 feature for the
                       native mobile apps.</p>
                </li>
                <li>
                    <strong>If your email account is compromised, so is your MyCitadel account.</strong>
                    <p>Email is the recovery channel. Anyone with access to your
                       inbox can trigger a password reset. Use a strong, unique
                       password on your email provider, and enable 2FA there too.</p>
                </li>
                <li>
                    <strong>We cannot protect you from a compromised device.</strong>
                    <p>If malware runs on your phone or laptop, no server-side
                       defense can help. Keep your OS and browser updated. Use
                       a password manager. Do not install random software.</p>
                </li>
                <li>
                    <strong>We will comply with valid legal requests.</strong>
                    <p>If we receive a lawful order, we cooperate within the
                       bounds of the law. What we can hand over is limited by
                       design: ciphertext, hashes, and timestamps — never
                       plaintext. We will publish a transparency report if
                       the volume of requests ever justifies one.</p>
                </li>
                <li>
                    <strong>We are one person.</strong>
                    <p>MyCitadel is built and operated by a single developer
                       with a full-time job. That is a strength for privacy
                       (no investors to satisfy, no ad network demanding data)
                       and a limit for scale. We grow carefully, not recklessly.</p>
                </li>
                <li>
                    <strong>We cannot guarantee 100% uptime.</strong>
                    <p>Shared hosting, one operator, no SRE team. We aim for
                       reliability but cannot match the SLAs of a hyperscale
                       provider. If uptime is critical to you, this may not
                       be the right platform.</p>
                </li>
            </ul>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #report — HOW TO SUBMIT A VULNERABILITY
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark" id="report">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">08</span>
                Report a Vulnerability
            </h2>

            <p class="citadel-section__lede" style="text-align:center; margin-left:auto; margin-right:auto;">
                Two ways to reach us. Both are monitored. Both are welcome.
            </p>

            <div class="report-grid">

                <article class="panel report-card report-card--primary">
                    <div class="report-card__badge">Preferred</div>
                    <h3>Email Disclosure</h3>
                    <p>Send your report directly to our security inbox. Include
                       the affected endpoint, the impact, and reproduction
                       steps. Attach screenshots or PoC code if relevant.</p>
                    <a href="mailto:security@mycitadel.lol?subject=Security%20Disclosure%20-%20MyCitadel"
                       class="report-card__email">
                        security@mycitadel.lol
                    </a>
                    <p class="report-card__note">
                        <strong>Acknowledgment target:</strong> 72 hours<br>
                        <strong>Remediation target for critical:</strong> 7 days
                    </p>
                </article>

                <article class="panel report-card report-card--soon">
                    <div class="report-card__badge report-card__badge--soon">Coming Soon</div>
                    <h3>HackerOne</h3>
                    <p>We are in the process of onboarding to HackerOne. Once
                       live, this page will link directly to our program
                       profile with full scope and reward documentation.</p>
                    <span class="report-card__email report-card__email--soon">
                        hackerone.com/mycitadel
                    </span>
                    <p class="report-card__note">
                        <strong>Until then:</strong> email works fine. We
                        will not lose your report.
                    </p>
                </article>

            </div>

            <div class="report-cta">
                <a href="/contact"
                   class="btn-cyber btn-gold">
                    Use the Contact Form Instead
                </a>
            </div>

            <p class="report-fineprint">
                Please do not test vulnerabilities against production users.
                Create a test account. If you need a specific scenario set up,
                email us first and we will help.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FINAL CTA
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--final">
        <div class="citadel-section__inner citadel-section__inner--center">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h2>Security You Can Verify</h2>
            <p>Our code is public. Our threat model is published. Audit us.</p>
            <div class="citadel-hero__cta" style="margin-top:1.5rem;">
                <a href="https://github.com/BeardedVikingTX" rel="noopener" class="btn-cyber">View Source on GitHub</a>
                <a href="mailto:security@mycitadel.lol" class="btn-cyber btn-gold">Report a Bug</a>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>