<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/TERMS.PHP ███
 * Terms of Service — user agreement, prohibited conduct, IP protection.
 * ----------------------------------------------------------------------------
 * ⚠️  IMPORTANT — READ THIS COMMENT BLOCK BEFORE PUBLISHING
 * ----------------------------------------------------------------------------
 * This document is a professionally-structured template. It is NOT a
 * substitute for legal review. Before you launch:
 *
 *   1. Have a licensed attorney in Texas (or your operating jurisdiction)
 *      review this entire document. Expect a 2-4 hour review at typical
 *      small-business rates.
 *
 *   2. Confirm the governing-law section matches where the entity is
 *      actually registered and operating.
 *
 *   3. Confirm the minimum-age clause (currently 13) matches COPPA,
 *      your target markets, and any local age requirements.
 *
 *   4. Decide on the license for your public GitHub repo and link to
 *      it directly (the IP section below currently recommends MIT +
 *      a separate Brand Protection policy).
 *
 *   5. Update the "Effective Date" and "Last Updated" fields when you
 *      change anything.
 *
 * Anchors supported (via /terms#<fragment>):
 *   #acceptance    #eligibility   #account       #prohibited
 *   #content       #ip            #bounty        #privacy
 *   #premium       #termination   #disclaimer    #law
 *   #changes       #contact
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

citadel_set_meta([
    'title'       => 'Terms of Service — MyCitadel',
    'description' => 'The rules for using MyCitadel. Prohibited conduct, intellectual property, bug bounty protections, enforcement, and your rights as a citizen.',
    'og_title'    => 'Terms of Service — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/terms',
    'canonical'   => CITADEL_SITE_URL . '/terms',
    'body_class'  => 'page-terms',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';

/* ══════════════════════════════════════════════════════════════════════════
 * EFFECTIVE DATES
 * Update these whenever the document changes in any material way.
 * ========================================================================== */
$EFFECTIVE_DATE = '2026-09-28';
$LAST_UPDATED   = '2026-09-28';
?>

<main class="page-static page-legal">

    <header class="page-static__header">
        <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
        <h1>Terms of Service</h1>
        <p class="page-static__lede">
            Plain language. Real consequences. Read it before you click agree.
        </p>

        <div class="legal-meta">
            <span><strong>Effective:</strong> <?= e($EFFECTIVE_DATE) ?></span>
            <span class="legal-meta__sep" aria-hidden="true">·</span>
            <span><strong>Last updated:</strong> <?= e($LAST_UPDATED) ?></span>
        </div>

        <!-- Quick-jump pill nav (same pattern as security.php) -->
        <nav class="security-toc legal-toc" aria-label="Sections">
            <a href="#acceptance">Acceptance</a>
            <a href="#eligibility">Eligibility</a>
            <a href="#account">Your Account</a>
            <a href="#prohibited">Prohibited Conduct</a>
            <a href="#content">Your Content</a>
            <a href="#ip">Intellectual Property</a>
            <a href="#bounty">Bug Bounty</a>
            <a href="#privacy">Privacy</a>
            <a href="#premium">Premium</a>
            <a href="#termination">Enforcement</a>
            <a href="#disclaimer">Disclaimers</a>
            <a href="#law">Governing Law</a>
            <a href="#changes">Changes</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <!-- ═══════════════════════════════════════════════════════════════════
         #acceptance
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="acceptance">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">01</span>
                Acceptance of These Terms
            </h2>

            <p class="about-lede">
                By creating a MyCitadel account, accessing the platform, or
                using any part of our services, you agree to be bound by
                these Terms of Service and by our
                <a href="/privacy">Privacy Policy</a> and
                <a href="/security">Security &amp; Privacy Statement</a>.
                If you do not agree, do not use MyCitadel.
            </p>

            <p class="about-lede">
                These Terms form a legally binding agreement between you and
                the operator of MyCitadel ("we", "us", "our", or "the
                operator"). Your continued use of the platform constitutes
                acceptance of any future revisions.
            </p>

            <div class="legal-callout">
                <strong>Plain-language summary:</strong>
                If you use MyCitadel, you agree to play by these rules. If you
                break them, we can remove your account. If you break the law,
                we cooperate with law enforcement.
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #eligibility
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="eligibility">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">02</span>
                Eligibility
            </h2>

            <p class="about-lede">
                You must be at least <strong>13 years of age</strong> to create
                a MyCitadel account. If you are under 18, you may only use the
                platform with the involvement of a parent or legal guardian.
                If you are under 13, you may not use MyCitadel at all — do not
                attempt to register.
            </p>

            <p class="about-lede">
                You represent and warrant that:
            </p>

            <ul class="legal-list">
                <li>You have the legal capacity to enter into this agreement.</li>
                <li>You are not barred from using the platform under any applicable law.</li>
                <li>You have not previously been removed from MyCitadel for a
                    violation of these Terms.</li>
                <li>You are not located in a jurisdiction where the platform
                    would be illegal for you to access.</li>
            </ul>

            <p class="about-lede">
                We may require age verification for accounts that appear to
                have been created by minors under 13, and we will remove any
                such account promptly upon discovery in compliance with the
                Children's Online Privacy Protection Act (COPPA) and similar
                regulations.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #account
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="account">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">03</span>
                Your Account
            </h2>

            <h3 class="legal-subhead">Accurate information</h3>
            <p class="about-lede">
                You agree to provide accurate information during registration
                and to keep it current. A valid email address is required for
                account recovery and security notifications.
            </p>

            <h3 class="legal-subhead">One account per person</h3>
            <p class="about-lede">
                You may not create multiple accounts for the purpose of
                evading bans, manipulating reputation or voting, or
                impersonating others. We reserve the right to merge or
                terminate duplicate accounts.
            </p>

            <h3 class="legal-subhead">Credential security</h3>
            <p class="about-lede">
                You are responsible for maintaining the confidentiality of
                your password, recovery codes, and 2FA device. You agree to
                notify us immediately at <a href="mailto:security@mycitadel.lol">security@mycitadel.lol</a>
                if you believe your account has been compromised.
            </p>

            <h3 class="legal-subhead">You are responsible for your account</h3>
            <p class="about-lede">
                Activity conducted through your account is your responsibility.
                Sharing your credentials with another person transfers that
                responsibility to you, not us.
            </p>

            <h3 class="legal-subhead">Account deletion</h3>
            <p class="about-lede">
                You may destroy your account at any time from your account
                settings. Deletion is <strong>permanent and immediate</strong>:
                your posts, comments, reactions, connections, and personal
                data are destroyed on the server. There is no "undo." See the
                <a href="/security">Security &amp; Privacy Statement</a> for
                specifics on how deletion works.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #prohibited
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="prohibited">
        <div class="citadel-section__inner">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">04</span>
                Prohibited Conduct
            </h2>

            <p class="citadel-section__lede" style="text-align:center; margin-left:auto; margin-right:auto; max-width:720px;">
                The following activities will result in immediate account
                termination, without warning, at the sole discretion of the
                operator. Where applicable, evidence will be preserved and
                turned over to law enforcement.
            </p>

            <div class="legal-prohibitions">

                <article class="panel prohibition-card prohibition-card--severe">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Sexual Harassment &amp; Exploitation</h3>
                    <p>Any content, message, comment, or behavior that
                       constitutes sexual harassment; unsolicited sexual
                       advances; sexual coercion; the sharing of intimate
                       images without consent; sexual content involving
                       minors (which will be reported to the National Center
                       for Missing &amp; Exploited Children immediately); or
                       any conduct that degrades, objectifies, or exploits
                       another person on the basis of sex or gender.</p>
                </article>

                <article class="panel prohibition-card prohibition-card--severe">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Illegal Drug Use &amp; Solicitation</h3>
                    <p>Content that promotes, instructs, facilitates, or
                       solicits the use, purchase, sale, or manufacture of
                       illegal drugs or controlled substances. Discussion of
                       drug policy in a political or academic context is
                       permitted; content designed to enable drug activity
                       is not.</p>
                </article>

                <article class="panel prohibition-card prohibition-card--severe">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Harmful Content &amp; Violence</h3>
                    <p>Content that threatens violence against a person or
                       group; content that promotes self-harm or suicide;
                       content that depicts graphic violence for the purpose
                       of glorification; content that incites hatred or
                       violence on the basis of race, ethnicity, religion,
                       sexual orientation, gender identity, or disability;
                       or content that provides instructions for committing
                       violent acts.</p>
                </article>

                <article class="panel prohibition-card">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Harassment &amp; Stalking</h3>
                    <p>Repeated unwanted contact, doxxing (sharing someone's
                       personal information without consent), coordinated
                       harassment campaigns, or using the platform to
                       surveil, track, or intimidate another person.</p>
                </article>

                <article class="panel prohibition-card">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Fraud &amp; Deception</h3>
                    <p>Impersonating another person, organization, or
                       MyCitadel staff; phishing; financial scams; romance
                       scams; fraudulent premium subscription activity;
                       reputation farming through automation; or any scheme
                       intended to deceive other users.</p>
                </article>

                <article class="panel prohibition-card">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Illegal Activity</h3>
                    <p>Using the platform to facilitate any act that violates
                       applicable law, including but not limited to:
                       distribution of child sexual abuse material (CSAM);
                       human trafficking; terrorist activity; money
                       laundering; and the sale of stolen goods.</p>
                </article>

                <article class="panel prohibition-card">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Platform Abuse</h3>
                    <p>Attempting to access another user's account; bypassing
                       rate limits or access controls; uploading malware;
                       launching denial-of-service attacks; scraping data at
                       scale; reverse-engineering the API for the purpose of
                       building a competing service; or interfering with the
                       platform's operation.</p>
                </article>

                <article class="panel prohibition-card">
                    <div class="prohibition-card__icon" aria-hidden="true">⛔</div>
                    <h3>Spam &amp; Unauthorized Advertising</h3>
                    <p>Mass-unsolicited messaging; link farming;
                       affiliate-marketing schemes; crypto promotions sent
                       to non-consenting users; or any commercial
                       solicitation not authorized in writing by the
                       operator.</p>
                </article>

            </div>

            <div class="legal-callout legal-callout--warning" style="margin-top:2.5rem;">
                <strong>Our enforcement stance:</strong>
                MyCitadel is a small platform operated by one person. We do
                not have a moderation team, and we do not scan private
                content (we cannot — it is encrypted). Enforcement is
                <strong>report-driven</strong>. If you are the victim of
                prohibited conduct, report it to
                <a href="mailto:abuse@mycitadel.lol">abuse@mycitadel.lol</a>.
                Include the username, the nature of the conduct, and any
                evidence. We will investigate every report we receive.
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #content
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="content">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">05</span>
                Your Content
            </h2>

            <h3 class="legal-subhead">You own what you post</h3>
            <p class="about-lede">
                You retain full ownership of all content you create on
                MyCitadel — posts, comments, profile text, uploaded images,
                and any other materials. We do not claim copyright over your
                content. We never have.
            </p>

            <h3 class="legal-subhead">Limited license to operate the platform</h3>
            <p class="about-lede">
                To display your content to your connections and to the
                platform features you enable, you grant MyCitadel a
                worldwide, non-exclusive, royalty-free license to store,
                transmit, and display your content solely for the purpose
                of operating the platform as you have configured it. This
                license terminates when you delete the content or your
                account.
            </p>

            <h3 class="legal-subhead">Your responsibility</h3>
            <p class="about-lede">
                You are solely responsible for your content. You represent
                that you own or have the necessary rights to any content you
                post, and that your content does not violate the rights of
                any third party (including copyright, trademark, privacy, or
                publicity rights).
            </p>

            <h3 class="legal-subhead">Content removal</h3>
            <p class="about-lede">
                We do not pre-screen content — it is technically infeasible
                with end-to-end encryption. However, upon receiving a valid
                report or legal order, we will remove or block content that
                violates these Terms or applicable law. Where the content
                is encrypted and cannot be read by us, we may be legally
                compelled to preserve it in its encrypted form for law
                enforcement.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #ip — INTELLECTUAL PROPERTY (this is the big one)
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="ip">
        <div class="citadel-section__inner">

            <h2 class="about-h2 about-h2--center">
                <span class="about-h2__mark" aria-hidden="true">06</span>
                Intellectual Property
            </h2>

            <p class="citadel-section__lede" style="text-align:center; margin-left:auto; margin-right:auto; max-width:760px;">
                MyCitadel's source code is published publicly for the purpose
                of transparency and audit. That is not the same as abandoning
                our rights. Here is exactly what you may and may not do.
            </p>

            <div class="ip-grid">

                <article class="panel ip-card ip-card--allowed">
                    <div class="ip-card__badge">Allowed</div>
                    <h3>What You May Do</h3>
                    <ul>
                        <li><strong>View</strong> the source code on GitHub</li>
                        <li><strong>Read</strong> and <strong>audit</strong> the code for security purposes</li>
                        <li><strong>Fork</strong> the repository for personal, non-commercial learning</li>
                        <li><strong>Submit</strong> pull requests, bug reports, and improvements back to the project</li>
                        <li><strong>Cite</strong> the project in academic work, articles, or discussions</li>
                        <li><strong>Install</strong> a private instance for your own personal, non-public use</li>
                    </ul>
                </article>

                <article class="panel ip-card ip-card--forbidden">
                    <div class="ip-card__badge ip-card__badge--forbidden">Prohibited</div>
                    <h3>What You May Not Do</h3>
                    <ul>
                        <li><strong>Republish</strong> the code as your own product or under a different name</li>
                        <li><strong>Operate</strong> a public-facing, commercial, or competing service derived from the code</li>
                        <li><strong>Remove</strong> copyright notices, license headers, or author attribution</li>
                        <li><strong>Use</strong> the name "MyCitadel", the rune mark, the logo, or any related branding</li>
                        <li><strong>Sell</strong>, sublicense, or relicense the code to third parties</li>
                        <li><strong>Deploy</strong> the code at scale for the purpose of serving users other than yourself</li>
                    </ul>
                </article>
            </div>

            <div class="legal-callout legal-callout--warning" style="margin-top:2.5rem;">
                <strong>Brand and Trademark.</strong>
                The names <strong>"MyCitadel"</strong>, <strong>"mycitadel.lol"</strong>,
                the runic mark <strong>ᛗ</strong>, the shield logo, the glowing cyan
                aesthetic, and any related visual identity are trademarks of
                the operator. They are <strong>not</strong> licensed for use by
                anyone else. Using them to promote a fork, a competing service,
                or a product that implies endorsement or affiliation is
                prohibited and will result in legal action where appropriate.
            </div>

            <div class="legal-callout" style="margin-top:1.5rem; border-left-color: var(--c-gold);">
                <strong>License for the code.</strong>
                The MyCitadel source code is published under the
                <a href="https://opensource.org/license/mit" rel="noopener">MIT License</a>.
                MIT permits broad reuse — including commercial reuse — with
                minimal restriction. If you intend to prevent republishing as
                a competing service, you will need to either:
                <strong>(a)</strong> choose a source-available-but-not-fully-open license
                (e.g. Business Source License 1.1, Elastic License 2.0), or
                <strong>(b)</strong> retain MIT for the code and rely on this
                Terms of Service plus brand/trademark enforcement to prevent
                the specific outcomes listed above. Consult with an attorney
                before launch to pick the right option.
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #bounty — BUG BOUNTY PROTECTIONS
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="bounty">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">07</span>
                Bug Bounty Hunter Protections
            </h2>

            <p class="about-lede">
                We believe security researchers are allies, not adversaries.
                If you are conducting legitimate security research on
                MyCitadel, the following protections apply to you — provided
                you follow the Rules of Engagement published on the
                <a href="/security#bug-bounty">Security page</a>.
            </p>

            <h3 class="legal-subhead">Safe Harbor</h3>
            <p class="about-lede">
                If you make a good-faith effort to comply with our published
                Rules of Engagement, we will consider your research
                authorized and will not pursue legal action against you.
                We will also make this position known to any third party
                that raises a complaint about your research.
            </p>

            <h3 class="legal-subhead">What is not covered</h3>
            <p class="about-lede">
                This safe harbor does not cover: accessing, exfiltrating,
                or modifying other users' data; denial-of-service attacks;
                social engineering of staff or users; physical attacks;
                or any activity that violates criminal law independent of
                our Terms.
            </p>

            <h3 class="legal-subhead">Your report is yours</h3>
            <p class="about-lede">
                You retain full credit for any vulnerability you discover.
                We will publicly acknowledge your finding in our Hall of
                Fame (once launched) unless you request otherwise. We will
                not claim authorship of your discovery.
            </p>

            <h3 class="legal-subhead">Our obligations</h3>
            <p class="about-lede">
                When you submit a valid report, we commit to:
            </p>
            <ul class="legal-list">
                <li>Acknowledging receipt within <strong>72 hours</strong>.</li>
                <li>Providing an initial severity assessment within <strong>7 days</strong>.</li>
                <li>Keeping you informed of remediation progress.</li>
                <li>Crediting you publicly once the issue is fixed (unless you ask otherwise).</li>
                <li>Rewarding per the tiers described on the <a href="/security#bug-bounty">Security page</a>.</li>
            </ul>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #privacy — CROSS-REFERENCE
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="privacy">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">08</span>
                Privacy
            </h2>

            <p class="about-lede">
                Your privacy is governed by our
                <a href="/privacy">Privacy Policy</a>, which forms part of
                these Terms by reference. In summary:
            </p>

            <ul class="legal-list">
                <li>We do not sell your data — we cannot, because we cannot read it.</li>
                <li>PII is encrypted at rest with per-user keys.</li>
                <li>We do not use third-party tracking scripts or analytics.</li>
                <li>We retain only what is necessary to operate the platform.</li>
                <li>Account deletion is permanent and destroys your data on the server.</li>
            </ul>

            <p class="about-lede">
                The full statement of mechanisms is published on the
                <a href="/security">Security &amp; Privacy page</a>.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #premium
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="premium">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">09</span>
                Premium Subscriptions
            </h2>

            <p class="about-lede">
                MyCitadel Premium is a paid subscription priced at
                <strong>$10 USD per month</strong>, processed by Stripe. By
                subscribing, you agree to the following terms:
            </p>

            <ul class="legal-list">
                <li><strong>Billing cycle.</strong> Subscriptions renew automatically
                    each month until canceled.</li>
                <li><strong>Cancellation.</strong> You may cancel at any time through
                    the billing portal. Cancellation takes effect at the end
                    of the current billing period — you retain premium access
                    until then.</li>
                <li><strong>Refunds.</strong> We do not offer refunds for partial
                    months. If you cancel mid-month, you keep premium access
                    through the end of the period you already paid for.</li>
                <li><strong>Price changes.</strong> We may change the price of
                    Premium with at least 30 days' notice. Your subscription
                    will not be retroactively repriced.</li>
                <li><strong>Payment failure.</strong> If your payment method fails,
                    Stripe will retry for approximately three weeks. If
                    payment is not recovered, your subscription will lapse
                    and premium access will end.</li>
            </ul>

            <p class="about-lede">
                For billing and payment questions, contact
                <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #termination — ENFORCEMENT
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="termination">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">10</span>
                Enforcement &amp; Termination
            </h2>

            <h3 class="legal-subhead">Our right to terminate</h3>
            <p class="about-lede">
                We reserve the right to suspend or permanently terminate any
                account, at any time, for any reason, with or without notice.
                We will exercise this right when we have a good-faith belief
                that the account has violated these Terms, endangered other
                users, or exposed the platform to legal risk.
            </p>

            <h3 class="legal-subhead">Investigation process</h3>
            <p class="about-lede">
                When a report of prohibited conduct is received, we will:
            </p>
            <ol class="legal-list legal-list--ordered">
                <li>Preserve any evidence available to us (which is limited —
                    content is encrypted and we cannot read it, but metadata
                    and report details are retained).</li>
                <li>Notify the accused user where legally permissible.</li>
                <li>Allow the accused an opportunity to respond, unless the
                    conduct is so severe (e.g. CSAM) that immediate action
                    is required.</li>
                <li>Make a determination based on the evidence available.</li>
                <li>Take action — which may include a warning, a temporary
                    suspension, or permanent account destruction.</li>
            </ol>

            <h3 class="legal-subhead">Cooperation with law enforcement</h3>
            <p class="about-lede">
                If we determine in good faith that a user has engaged in
                illegal activity, we will preserve all available evidence
                (in encrypted form where applicable) and cooperate fully
                with law enforcement, including local police, state
                authorities, and federal agencies such as the FBI, NCMEC,
                and the DOJ. Account destruction does not precede evidence
                preservation. The order is: preserve → report → cooperate
                → destroy.
            </p>

            <div class="legal-callout legal-callout--warning">
                <strong>What we can and cannot hand over.</strong>
                Because your private content is encrypted with keys we do not
                possess in usable form for individual user accounts, what we
                can provide to law enforcement is limited: account metadata,
                timestamps, IP hashes, and encrypted blobs. We cannot decrypt
                your private messages. We can be legally compelled to
                preserve encrypted data so that other parties with the
                requisite keys — such as a user's own device, if seized —
                can be used to decrypt it.
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #disclaimer
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="disclaimer">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">11</span>
                Disclaimers &amp; Limitation of Liability
            </h2>

            <p class="about-lede legal-allcaps">
                MYCITADEL IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT
                WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
                LIMITED TO WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
                PARTICULAR PURPOSE, OR NON-INFRINGEMENT.
            </p>

            <p class="about-lede legal-allcaps">
                TO THE MAXIMUM EXTENT PERMITTED BY APPLICABLE LAW, THE
                OPERATOR OF MYCITADEL SHALL NOT BE LIABLE FOR ANY INDIRECT,
                INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES,
                OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED
                DIRECTLY OR INDIRECTLY, ARISING FROM YOUR USE OF THE
                PLATFORM.
            </p>

            <p class="about-lede legal-allcaps">
                IN NO EVENT SHALL THE OPERATOR'S TOTAL LIABILITY TO YOU FOR
                ALL CLAIMS ARISING OUT OF OR RELATING TO THESE TERMS OR YOUR
                USE OF THE PLATFORM EXCEED THE GREATER OF (A) THE AMOUNT YOU
                HAVE PAID US IN THE TWELVE MONTHS PRECEDING THE CLAIM, OR
                (B) ONE HUNDRED U.S. DOLLARS ($100).
            </p>

            <h3 class="legal-subhead">Indemnification</h3>
            <p class="about-lede">
                You agree to indemnify, defend, and hold harmless the operator
                of MyCitadel from any claim, liability, damage, loss, or
                expense (including reasonable attorneys' fees) arising out
                of: (a) your use of the platform; (b) your content; (c) your
                violation of these Terms; or (d) your violation of any third
                party's rights.
            </p>

            <h3 class="legal-subhead">No guarantee of availability</h3>
            <p class="about-lede">
                MyCitadel is operated by one person on shared infrastructure.
                We do not guarantee uptime, uninterrupted service, or
                preservation of data beyond what is described in our Privacy
                Policy. Do not use MyCitadel as your only storage location
                for anything irreplaceable.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #law
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="law">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">12</span>
                Governing Law &amp; Dispute Resolution
            </h2>

            <p class="about-lede">
                These Terms shall be governed by and construed in accordance
                with the laws of the <strong>State of Texas</strong>, United
                States, without regard to its conflict of law principles.
                Any legal action arising out of or relating to these Terms
                or the platform shall be brought exclusively in the state
                or federal courts located in <strong>Tarrant County,
                Texas</strong>, and you consent to personal jurisdiction
                in those courts.
            </p>

            <p class="about-lede">
                <em>Operational note:</em> The platform is temporarily
                operated from Sullivan, Illinois, pending relocation of the
                primary operations center to Fort Worth, Texas. Until the
                relocation completes, the operator may, at their sole
                discretion, agree to resolve disputes in an alternative
                venue. The default governing-law provision above remains
                Texas.
            </p>

            <h3 class="legal-subhead">Informal resolution first</h3>
            <p class="about-lede">
                Before filing a formal legal action, you agree to attempt to
                resolve any dispute informally by contacting
                <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>
                with a written description of the issue. We will respond
                within 30 days.
            </p>

            <h3 class="legal-subhead">Severability</h3>
            <p class="about-lede">
                If any provision of these Terms is held to be invalid or
                unenforceable, that provision shall be severed and the
                remaining provisions shall continue in full force and effect.
            </p>

            <h3 class="legal-subhead">Entire agreement</h3>
            <p class="about-lede">
                These Terms, together with the Privacy Policy and the Security
                &amp; Privacy Statement, constitute the entire agreement
                between you and the operator concerning MyCitadel.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #changes
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section legal-section" id="changes">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">13</span>
                Changes to These Terms
            </h2>

            <p class="about-lede">
                We may update these Terms from time to time. When we make
                material changes, we will:
            </p>

            <ul class="legal-list">
                <li>Update the "Last Updated" date at the top of this page.</li>
                <li>Notify all users via email and in-app notification at least
                    <strong>14 days</strong> before the change takes effect.</li>
                <li>Preserve a link to the previous version for at least
                    <strong>90 days</strong> so you can review what changed.</li>
            </ul>

            <p class="about-lede">
                Continued use of the platform after a change takes effect
                constitutes acceptance of the updated Terms. If you do not
                agree to a change, you may destroy your account at any time.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         #contact
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark legal-section" id="contact">
        <div class="citadel-section__inner citadel-section__inner--narrow">

            <h2 class="about-h2">
                <span class="about-h2__mark" aria-hidden="true">14</span>
                Contact
            </h2>

            <p class="about-lede">
                For any question about these Terms:
            </p>

            <div class="contact-departments contact-departments--compact">
                <div class="contact-dept">
                    <span class="contact-dept__label">General</span>
                    <a href="mailto:info@mycitadel.lol">info@mycitadel.lol</a>
                </div>
                <div class="contact-dept">
                    <span class="contact-dept__label">Abuse Reports</span>
                    <a href="mailto:abuse@mycitadel.lol">abuse@mycitadel.lol</a>
                </div>
                <div class="contact-dept">
                    <span class="contact-dept__label">Security</span>
                    <a href="mailto:security@mycitadel.lol">security@mycitadel.lol</a>
                </div>
                <div class="contact-dept">
                    <span class="contact-dept__label">Legal</span>
                    <a href="mailto:legal@mycitadel.lol">legal@mycitadel.lol</a>
                </div>
            </div>

            <p class="about-lede" style="margin-top:2rem;">
                Or use the <a href="/contact">contact form</a>.
            </p>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FINAL
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--final">
        <div class="citadel-section__inner citadel-section__inner--center">
            <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
            <h2>Agreement Understood</h2>
            <p>These are the rules. By using MyCitadel, you have accepted them.</p>
            <div class="citadel-hero__cta" style="margin-top:1.5rem;">
                <a href="/privacy" class="btn-cyber">Privacy Policy</a>
                <a href="/security" class="btn-cyber btn-gold">Security &amp; Privacy</a>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>