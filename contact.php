<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/CONTACT.PHP ███
 * Contact page with the fortress-grade form.
 * ========================================================================== */

declare(strict_types=1);

session_start([
    'cookie_httponly' => true,
    'cookie_secure'   => true,
    'cookie_samesite' => 'Strict',
    'use_strict_mode' => true,
    'name'            => 'citadel_contact_sid',
]);

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/contact-handler.php';

/* ── Handle POST ─────────────────────────────────────────────────────────── */
$formState = ['ok' => null, 'message' => '', 'silent' => false, 'field' => null];
$posted    = [
    'name'       => '',
    'email'      => '',
    'subject'    => '',
    'message'    => '',
    'department' => 'general',
];

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    // Preserve what the human typed if it wasn't a silent bot block
    foreach (['name','email','subject','message','department'] as $f) {
        if (isset($_POST[$f]) && is_string($_POST[$f])) {
            $posted[$f] = mb_substr(trim($_POST[$f]), 0, 5000);
        }
    }

    $result = citadel_contact_handle($_POST);
    $formState = array_merge($formState, $result);

    // On success (real or silent), wipe the form so it doesn't flash data
    if ($result['ok']) {
        $posted = array_map(fn() => '', $posted);
        $posted['department'] = 'general';
    }
}

/* ── Prepare CSRF + verification phrase ──────────────────────────────────── */
$phrases = citadel_contact_phrases();
$phrase  = $phrases[random_int(0, count($phrases) - 1)];

$_SESSION['contact_phrase']    = $phrase;
$_SESSION['contact_loaded_at'] = time();
$_SESSION['contact_csrf']      = bin2hex(random_bytes(32));

$csrf = $_SESSION['contact_csrf'];

/* ── Meta + includes ─────────────────────────────────────────────────────── */
citadel_set_meta([
    'title'       => 'Contact — MyCitadel',
    'description' => 'Get in touch with MyCitadel. Support, security reports, developer contact, and bug bounty inquiries.',
    'og_title'    => 'Contact MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/contact',
    'canonical'   => CITADEL_SITE_URL . '/contact',
    'body_class'  => 'page-contact',
]);

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main class="page-static">

    <header class="page-static__header">
        <span class="rune-divider">ᚠ ᚢ ᚦ ᚨ ᚱ ᚲ</span>
        <h1>Contact</h1>
        <p class="page-static__lede">
            Choose the right channel. Every message is read by a human —
            usually the same one.
        </p>
    </header>

    <!-- ═══════════════════════════════════════════════════════════════════
         CHANNELS
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section">
        <div class="citadel-section__inner">
            <div class="contact-channels">

                <div class="panel contact-card">
                    <div class="contact-card__icon" aria-hidden="true">🛠️</div>
                    <h3>Support</h3>
                    <p>Account issues, feature questions, general help.</p>
                    <span class="contact-card__email">info@mycitadel.lol</span>
                </div>

                <div class="panel contact-card">
                    <div class="contact-card__icon" aria-hidden="true">🛡️</div>
                    <h3>Security</h3>
                    <p>Vulnerability reports, privacy concerns, coordinated disclosure.</p>
                    <span class="contact-card__email">security@mycitadel.lol</span>
                </div>

                <div class="panel contact-card">
                    <div class="contact-card__icon" aria-hidden="true">👤</div>
                    <h3>Developer</h3>
                    <p>Direct contact with the person who built this.</p>
                    <span class="contact-card__email">beardedviking@mycitadel.lol</span>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         FORM
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner citadel-section__inner--narrow">
            <h2>Send a Message</h2>
            <p class="citadel-section__lede">
                Please allow 2–3 business days for a reply. For security
                disclosures, we aim to acknowledge within 72 hours.
            </p>

            <?php if ($formState['ok'] === true && !$formState['silent']): ?>
                <div class="citadel-msg success" role="alert">
                    <?= e($formState['message']) ?>
                </div>
            <?php elseif ($formState['ok'] === false): ?>
                <div class="citadel-msg error" role="alert">
                    <?= e($formState['message']) ?>
                </div>
            <?php endif; ?>

            <form class="contact-form" id="contact-form" method="post" action="/contact" novalidate>

                <input type="hidden" name="_csrf" value="<?= e($csrf) ?>">

                <!-- ═══════════════════════════════════════════════════════════════════════
                     TRIPLE HONEYPOT — must remain empty
                
                     Trap 1: absolutely positioned off-screen (bots that don't render CSS)
                     Trap 2: display:none inline (bots that render CSS)
                     Trap 3: nested inside a "Fax number" field (bots that scrape field names)
                
                     Inline styles are used as a FALLBACK so the traps hide even if
                     citadel.css fails to load or is cached incorrectly.
                     ═══════════════════════════════════════════════════════════════════════ -->
                
                <!-- Trap 1 — off-screen -->
                <div class="hp-trap hp-trap--offscreen"
                     aria-hidden="true"
                     style="position:absolute!important;left:-9999px!important;top:auto!important;width:1px!important;height:1px!important;overflow:hidden!important;">
                    <label for="hp-website">Website (leave blank)</label>
                    <input type="text" id="hp-website" name="website" tabindex="-1" autocomplete="off">
                </div>
                
                <!-- Trap 2 — display:none -->
                <div class="hp-trap hp-trap--display"
                     aria-hidden="true"
                     style="display:none!important;">
                    <label for="hp-company">Company (leave blank)</label>
                    <input type="text" id="hp-company" name="company" tabindex="-1" autocomplete="off">
                </div>
                
                <!-- Trap 3 — invisible but present in DOM -->
                <div class="hp-trap hp-trap--fax"
                     aria-hidden="true"
                     style="position:absolute!important;width:1px!important;height:1px!important;opacity:0!important;pointer-events:none!important;top:0;left:0;">
                    <label for="hp-fax">Fax number</label>
                    <input type="text" id="hp-fax" name="fax" tabindex="-1" autocomplete="off">
                </div>

                <!-- ═══ Real fields ═══ -->
                <div class="form-group">
                    <label for="department">Route To</label>
                    <select id="department" name="department" required>
                        <?php foreach (citadel_contact_departments() as $key => $d): ?>
                            <option value="<?= e($key) ?>" <?= $posted['department'] === $key ? 'selected' : '' ?>>
                                <?= e($d['label']) ?> — <?= e($d['email']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required maxlength="120" autocomplete="name"
                               value="<?= e($posted['name']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" required maxlength="254" autocomplete="email"
                               value="<?= e($posted['email']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required maxlength="200"
                           value="<?= e($posted['subject']) ?>">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required maxlength="5000" rows="8"><?= e($posted['message']) ?></textarea>
                    <div class="form-hint">20–5000 characters</div>
                </div>

                <!-- ═══ Rotating verification phrase ═══ -->
                <div class="form-group verify-group">
                    <label for="phrase">Verification — Type The Phrase Below Exactly</label>
                    <div class="verify-phrase">
                        <span class="verify-phrase__label">Phrase:</span>
                        <span class="verify-phrase__value" id="verify-target"><?= e($phrase) ?></span>
                    </div>
                    <input type="text"
                           id="phrase"
                           name="phrase"
                           required
                           autocomplete="off"
                           autocapitalize="off"
                           autocorrect="off"
                           spellcheck="false"
                           placeholder="Type the phrase above"
                           data-verify="<?= e($phrase) ?>">
                    <div class="form-hint">
                        Manual typing only — paste is disabled on this field.
                    </div>
                </div>

                <button type="submit" class="btn-cyber btn-gold auth-submit">Send Message</button>
            </form>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         HQ / OFFICE INFO
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section">
        <div class="citadel-section__inner">
            <h2 class="citadel-section__title">Where We Are</h2>

            <div class="hq-grid">

                <div class="panel hq-card hq-card--hq">
                    <div class="hq-card__badge">Headquarters</div>
                    <h3>Fort Worth, Texas</h3>
                    <p class="hq-card__status">Primary operations center</p>
                    <p class="hq-card__note">Relocation planned. Details to follow.</p>
                </div>

                <div class="panel hq-card hq-card--branch">
                    <div class="hq-card__badge hq-card__badge--branch">Temporary Branch</div>
                    <h3>Sullivan, Illinois</h3>
                    <p class="hq-card__status">Current operating location</p>
                    <p class="hq-card__note">Interim facility until relocation completes.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════════════════════
         SECURITY DISCLOSURE
         ═══════════════════════════════════════════════════════════════════ -->
    <section class="citadel-section citadel-section--dark">
        <div class="citadel-section__inner citadel-section__inner--narrow">
            <h2>Security Disclosure</h2>
            <p>
                If you have found a vulnerability, choose <strong>Security / Bug Bounty</strong>
                in the form above, or email
                <a href="mailto:security@mycitadel.lol">security@mycitadel.lol</a> directly.
                Include the affected endpoint, the impact, and steps to reproduce.
            </p>
            <div class="endpoint-notes" style="margin-top:1.5rem;">
                <strong>Please do not test vulnerabilities on production users.</strong>
                Create a test account. If you need a specific scenario, contact us
                first and we will help set it up.
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>