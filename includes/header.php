<?php
/* ============================================================================
 * ███ INCLUDES/HEADER.PHP ███
 * Opens the HTML document. Emits all meta tags, links CSS, sets the
 * initial theme color, and opens the <body>.
 *
 * Pages include this AFTER citadel_set_meta() and BEFORE nav.php.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/config.php';

$meta = citadel_meta();
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="color-scheme" content="dark">

    <!-- ── Primary meta ───────────────────────────────────────────── -->
    <title><?= e($meta['title']) ?></title>
    <meta name="description" content="<?= e($meta['description']) ?>">
    <?php if (!empty($meta['keywords'])): ?>
    <meta name="keywords" content="<?= e($meta['keywords']) ?>">
    <?php endif; ?>
    <meta name="author" content="<?= e($meta['author']) ?>">
    <meta name="robots" content="<?= e($meta['robots']) ?>">

    <!-- ── Canonical ──────────────────────────────────────────────── -->
    <link rel="canonical" href="<?= e($meta['canonical']) ?>">

    <!-- ── Open Graph ─────────────────────────────────────────────── -->
    <meta property="og:type"        content="<?= e($meta['og_type']) ?>">
    <meta property="og:title"       content="<?= e($meta['og_title']) ?>">
    <meta property="og:description" content="<?= e($meta['og_description']) ?>">
    <meta property="og:url"         content="<?= e($meta['og_url']) ?>">
    <meta property="og:image"       content="<?= e($meta['og_image']) ?>">
    <meta property="og:site_name"   content="<?= e(CITADEL_SITE_NAME) ?>">
    <meta property="og:locale"      content="en_US">

    <!-- ── Twitter / X Card ───────────────────────────────────────── -->
    <meta name="twitter:card"        content="<?= e($meta['twitter_card']) ?>">
    <meta name="twitter:site"        content="<?= e($meta['twitter_site']) ?>">
    <meta name="twitter:title"       content="<?= e($meta['og_title']) ?>">
    <meta name="twitter:description" content="<?= e($meta['og_description']) ?>">
    <meta name="twitter:image"       content="<?= e($meta['og_image']) ?>">

    <!-- ── Favicons ───────────────────────────────────────────────── -->
    <link rel="icon"             type="image/svg+xml" href="<?= e(CITADEL_VENDORS_URL) ?>/img/favicon.svg">
    <link rel="icon"             type="image/png"     href="<?= e(CITADEL_VENDORS_URL) ?>/img/favicon-32.png" sizes="32x32">
    <link rel="icon"             type="image/png"     href="<?= e(CITADEL_VENDORS_URL) ?>/img/favicon-16.png" sizes="16x16">
    <link rel="apple-touch-icon"                      href="<?= e(CITADEL_VENDORS_URL) ?>/img/apple-touch-icon.png" sizes="180x180">
    <link rel="mask-icon"                             href="<?= e(CITADEL_VENDORS_URL) ?>/img/safari-pinned-tab.svg" color="#00e5ff">
    <meta name="msapplication-TileColor" content="#05070a">
    <meta name="theme-color"             content="#05070a">

    <!-- ── PWA Manifest (future mobile) ───────────────────────────── -->
    <link rel="manifest" href="/manifest.webmanifest">

    <!-- ── Preconnect: save 100-200ms on first API call ───────────── -->
    <link rel="preconnect" href="<?= e(CITADEL_API_URL) ?>" crossorigin>
    <link rel="preconnect" href="<?= e(CITADEL_VENDORS_URL) ?>" crossorigin>
    <link rel="dns-prefetch" href="https://js.stripe.com">

    <!-- ── Stylesheets (all from vendors.mycitadel.lol) ───────────── -->
    <link rel="stylesheet" href="<?= e(CITADEL_VENDORS_URL) ?>/css/citadel.css">
    <link rel="stylesheet" href="<?= e(CITADEL_VENDORS_URL) ?>/css/auth.css">

    <!-- ── Structured Data (JSON-LD) ──────────────────────────────── -->
    <?php if (!empty($meta['json_ld'])): ?>
    <script type="application/ld+json"><?= $meta['json_ld'] /* intentional raw */ ?></script>
    <?php else: ?>
    <script type="application/ld+json">
    <?= json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'WebSite',
        'name'        => CITADEL_SITE_NAME,
        'url'         => CITADEL_SITE_URL,
        'description' => $meta['description'],
        'potentialAction' => [
            '@type'       => 'SearchAction',
            'target'      => CITADEL_SITE_URL . '/users?q={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <?php endif; ?>
</head>
<body class="citadel-body <?= e($meta['body_class']) ?>">