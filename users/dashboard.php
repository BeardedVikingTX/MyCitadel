<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/USERS/DASHBOARD.PHP ███
 * The Citizen's dashboard — v2.
 * ----------------------------------------------------------------------------
 * Six live sections, four charts, and an onboarding path for new Citizens.
 * Auth is checked client-side (session cookie lives on api.mycitadel.lol).
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

citadel_set_meta([
    'title'       => 'Dashboard — MyCitadel',
    'description' => 'Your Citadel at a glance: reputation, badges, activity, and standing.',
    'og_title'    => 'Dashboard — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/users/dashboard',
    'canonical'   => CITADEL_SITE_URL . '/users/dashboard',
    'body_class'  => 'page-dashboard',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';

$API_BASE      = 'https://api.mycitadel.lol/v1';
$LOGIN_URL     = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
?>

<div class="dash-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>">


    <div class="dash-error" id="dash-error" hidden>
        <div class="dash-error__icon" aria-hidden="true">⚠</div>
        <h2>Could not load your dashboard</h2>
        <p id="dash-error-msg">Something went wrong.</p>
        <button type="button" class="btn-cyber" id="dash-retry">Retry</button>
    </div>

    <main class="dash-content" id="dash-content" hidden>

        <!-- ── HERO ──────────────────────────────────────────────── -->
        <header class="dash-hero" id="dash-hero"></header>

        <!-- ── ONBOARDING COACHMARK (only for new accounts) ──────── -->
        <section class="dash-onboarding" id="dash-onboarding" hidden></section>

        <!-- ── KPI STRIP (6 tiles) ───────────────────────────────── -->
        <section class="dash-kpis" id="dash-kpis" aria-label="Key stats"></section>

        <!-- ── CHART ROW (2x2 grid) ──────────────────────────────── -->
        <section class="dash-charts" aria-label="Charts">
            <article class="dash-card dash-card--chart">
                <header class="dash-card__head">
                    <h3>Reputation Standing</h3>
                    <span class="dash-card__sub" id="chart-rep-sub">You vs the platform</span>
                </header>
                <div class="dash-chart-wrap">
                    <canvas id="chart-rep"></canvas>
                </div>
            </article>

            <article class="dash-card dash-card--chart">
                <header class="dash-card__head">
                    <h3>Badge Tiers</h3>
                    <span class="dash-card__sub">How your collection is distributed</span>
                </header>
                <div class="dash-chart-wrap dash-chart-wrap--donut">
                    <canvas id="chart-badges"></canvas>
                </div>
            </article>

            <article class="dash-card dash-card--chart">
                <header class="dash-card__head">
                    <h3>Reputation Sources</h3>
                    <span class="dash-card__sub">Where your points come from</span>
                </header>
                <div class="dash-chart-wrap dash-chart-wrap--donut">
                    <canvas id="chart-sources"></canvas>
                </div>
            </article>

            <article class="dash-card dash-card--chart">
                <header class="dash-card__head">
                    <h3>Recent Trajectory</h3>
                    <span class="dash-card__sub">Your last 10 reputation events</span>
                </header>
                <div class="dash-chart-wrap">
                    <canvas id="chart-trajectory"></canvas>
                </div>
            </article>
        </section>

        <!-- ── NEXT MILESTONES ───────────────────────────────────── -->
        <section class="dash-section" aria-label="Next milestones" id="dash-milestones-section">
            <header class="dash-section__head">
                <h2>Next Milestones</h2>
                <span class="dash-section__meta">Progress toward your next badge</span>
            </header>
            <div class="milestone-grid" id="milestone-grid"></div>
        </section>

        <!-- ── SECURITY + PROFILE STATUS (split) ─────────────────── -->
        <section class="dash-split" aria-label="Security and profile">
            <article class="dash-card" id="security-card">
                <header class="dash-card__head">
                    <h3>Account Security</h3>
                    <span class="dash-card__sub">Protection status</span>
                </header>
                <ul class="status-list" id="security-list"></ul>
            </article>

            <article class="dash-card" id="completeness-card">
                <header class="dash-card__head">
                    <h3>Profile Completeness</h3>
                    <span class="dash-card__sub">Fully flesh out your Citizen identity</span>
                </header>
                <div class="completeness-block" id="completeness-block"></div>
            </article>
        </section>

        <!-- ── BADGES GALLERY ────────────────────────────────────── -->
        <section class="dash-section" aria-label="Badges">
            <header class="dash-section__head">
                <h2>Earned Badges</h2>
                <span class="dash-section__meta" id="badges-count">—</span>
            </header>
            <div class="badge-grid" id="badge-grid"></div>
        </section>

        <!-- ── ACTIVITY + REFERRAL ───────────────────────────────── -->
        <section class="dash-split" aria-label="Activity and referrals">
            <article class="dash-card">
                <header class="dash-card__head">
                    <h3>Recent Activity</h3>
                    <span class="dash-card__sub">Last 10 reputation events</span>
                </header>
                <ul class="activity-list" id="activity-list"></ul>
            </article>

            <article class="dash-card dash-card--accent">
                <header class="dash-card__head">
                    <h3>Your Referral Link</h3>
                    <span class="dash-card__sub">Share it — you both earn 500 rep</span>
                </header>
                <div class="referral-block">
                    <div class="referral-code" id="referral-code">—</div>
                    <div class="referral-link-row">
                        <input type="text" id="referral-link" readonly value="">
                        <button type="button" class="btn-cyber btn-cyber--sm" id="referral-copy">Copy</button>
                    </div>
                    <div class="referral-stats">
                        <div class="referral-stat">
                            <span class="referral-stat__value" id="referral-count">0</span>
                            <span class="referral-stat__label">Citizens Referred</span>
                        </div>
                        <div class="referral-stat">
                            <span class="referral-stat__value" id="referral-points">0</span>
                            <span class="referral-stat__label">Points Earned</span>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <!-- ── ACTION BAR ─────────────────────────────────────────── -->
        <section class="dash-actions" aria-label="Actions">
            <a href="/users/profile.php" class="dash-action">
                <span class="dash-action__icon" aria-hidden="true">✦</span>
                <span class="dash-action__label">Edit Profile</span>
            </a>
            <a href="/users/settings.php" class="dash-action">
                <span class="dash-action__icon" aria-hidden="true">⚙</span>
                <span class="dash-action__label">Settings</span>
            </a>
            <a href="/users/2fa.php" class="dash-action" id="dash-action-2fa">
                <span class="dash-action__icon" aria-hidden="true">🔐</span>
                <span class="dash-action__label">Two-Factor</span>
                <span class="dash-action__badge" id="dash-2fa-badge" hidden>Set Up</span>
            </a>
            <a href="/users/connections.php" class="dash-action">
                <span class="dash-action__icon" aria-hidden="true">⚔</span>
                <span class="dash-action__label">Connections</span>
            </a>
            <a href="/contact" class="dash-action">
                <span class="dash-action__icon" aria-hidden="true">✉</span>
                <span class="dash-action__label">Support</span>
            </a>
            <button type="button" class="dash-action dash-action--danger" id="dash-logout">
                <span class="dash-action__icon" aria-hidden="true">⏻</span>
                <span class="dash-action__label">Log Out</span>
            </button>
        </section>

    </main>
</div>

<script src="https://vendors.mycitadel.lol/js/chart.umd.min.js" defer></script>


<?php require __DIR__ . '/../includes/footer.php'; ?>