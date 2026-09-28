<?php
/* ============================================================================
 * ███ INCLUDES/CONFIG.PHP ███
 * MyCitadel — Shared Configuration & Meta Helpers
 * ----------------------------------------------------------------------------
 * Every page includes this first. It defines:
 *   • Site constants (name, URLs, version)
 *   • A $GLOBALS['citadel_meta'] array that pages can override
 *   • citadel_set_meta() to override per-page
 *   • Security headers (only when not already sent)
 *
 * Pages that include header.php get all of this automatically.
 * ========================================================================== */

declare(strict_types=1);

if (defined('CITADEL_CONFIG_LOADED')) {
    return;
}
define('CITADEL_CONFIG_LOADED', true);

/* ══════════════════════════════════════════════════════════════════════════
 * SITE CONSTANTS
 * ========================================================================== */

define('CITADEL_SITE_NAME',   'MyCitadel');
define('CITADEL_SITE_TAGLINE','Your digital fortress. Your rules.');
define('CITADEL_SITE_URL',    'https://mycitadel.lol');
define('CITADEL_API_URL',     'https://api.mycitadel.lol/v1');
define('CITADEL_VENDORS_URL', 'https://vendors.mycitadel.lol');
define('CITADEL_VERSION',     '1.0.0');
define('CITADEL_YEAR',        (int) date('Y'));

/* ══════════════════════════════════════════════════════════════════════════
 * PER-PAGE META
 * --------------------------------------------------------------------------
 * Pages define their meta BEFORE including header.php:
 *   citadel_set_meta(['title' => 'Login', 'description' => '...']);
 * ========================================================================== */

$GLOBALS['citadel_meta'] = [
    'title'          => CITADEL_SITE_NAME . ' — Your Digital Fortress',
    'description'    => 'MyCitadel is a privacy-first social platform built on zero-knowledge architecture. Argon2id authentication, envelope-encrypted PII, and no third-party tracking. Your data is encrypted before it ever reaches our servers.',
    'keywords'       => 'privacy, social network, encrypted, zero-knowledge, decentralized social',
    'author'         => 'Bearded Viking',
    'robots'         => 'index, follow',

    // Open Graph
    'og_title'       => CITADEL_SITE_NAME,
    'og_description' => 'The privacy-first social platform. Your data stays encrypted.',
    'og_type'        => 'website',
    'og_image'       => CITADEL_VENDORS_URL . '/img/og-default.png',
    'og_url'         => CITADEL_SITE_URL,

    // Twitter / X
    'twitter_card'   => 'summary_large_image',
    'twitter_site'   => '@mycitadel',

    // Canonical
    'canonical'      => CITADEL_SITE_URL,

    // Body class — pages can add one
    'body_class'     => '',

    // Structured data override (JSON string or null)
    'json_ld'        => null,
];

/**
 * Merge per-page overrides into the global meta array.
 * Call this BEFORE including header.php.
 */
function citadel_set_meta(array $overrides): void
{
    $GLOBALS['citadel_meta'] = array_merge($GLOBALS['citadel_meta'], $overrides);
}

/** Read the current meta array. */
function citadel_meta(): array
{
    return $GLOBALS['citadel_meta'];
}

/** Shorthand escape for HTML output. */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/* ══════════════════════════════════════════════════════════════════════════
 * SECURITY HEADERS
 * --------------------------------------------------------------------------
 * The .htaccess sets these too — belt & suspenders. If .htaccess is ever
 * missing (bad deploy), PHP still sends them.
 *
 * CSP notes:
 *   • vendors.mycitadel.lol    → our CSS/JS/fonts
 *   • api.mycitadel.lol        → all API calls
 *   • js.stripe.com            → Stripe.js (future embedded card flows)
 *   • hooks.stripe.com         → Stripe iframe (hosted fields)
 *   • *.stripe.com (connect)   → Stripe network calls
 *
 * We do NOT allow inline scripts (no 'unsafe-inline'). All JS lives in
 * external files or is loaded via <script src>. Inline event handlers
 * (onclick="") are forbidden. This is intentional — it's a stronger CSP.
 * ========================================================================== */

if (!headers_sent()) {

    $csp = implode('; ', [
        "default-src 'self'",
        "script-src 'self' https://" . parse_url(CITADEL_VENDORS_URL, PHP_URL_HOST) . " https://js.stripe.com",
        "style-src 'self' 'unsafe-inline' https://" . parse_url(CITADEL_VENDORS_URL, PHP_URL_HOST),
        "font-src 'self' https://" . parse_url(CITADEL_VENDORS_URL, PHP_URL_HOST),
        "img-src 'self' data: https://" . parse_url(CITADEL_VENDORS_URL, PHP_URL_HOST) . " https://" . parse_url(CITADEL_SITE_URL, PHP_URL_HOST),
        "connect-src 'self' https://" . parse_url(CITADEL_API_URL, PHP_URL_HOST) . " https://api.stripe.com https://" . parse_url(CITADEL_VENDORS_URL, PHP_URL_HOST),
        "frame-src https://js.stripe.com https://hooks.stripe.com",
        "form-action 'self' https://checkout.stripe.com",
        "frame-ancestors 'none'",
        "base-uri 'self'",
        "object-src 'none'",
        "upgrade-insecure-requests",
    ]);

    header('Content-Security-Policy: ' . $csp);
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=(self "https://js.stripe.com"), usb=(), interest-cohort=()');
    header_remove('X-Powered-By');
}