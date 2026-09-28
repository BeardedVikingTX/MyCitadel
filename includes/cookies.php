<?php
/* ============================================================================
 * ███ INCLUDES/COOKIES.PHP ███
 * MyCitadel — Client-Side Session Hydration Helper
 * ----------------------------------------------------------------------------
 * ⚠️  NAMING NOTE
 *   This file does NOT set the auth session cookie. That cookie lives on
 *   api.mycitadel.lol and is HttpOnly — mycitadel.lol PHP literally cannot
 *   read or write it. Which is correct.
 *
 *   What this file DOES provide:
 *     1. A cosmetic "hint" cookie on mycitadel.lol so the UI can render
 *        fast on returning visits (shows "loading" instead of "Login").
 *     2. Helper functions the nav and pages call to render the correct
 *        initial state.
 *     3. A no-op safety net: if the hint says "user" but the API says "no",
 *        JS corrects the UI within milliseconds.
 *
 *   The hint cookie is:
 *     • set by JS only, never by PHP
 *     • cosmetic only — zero authorization weight
 *     • tampered with by an attacker → shows wrong buttons → API still
 *       rejects any request → user just sees a logout flash
 *
 *   This is the "keep the promise" approach: we track UI state, not users.
 * ========================================================================== */

declare(strict_types=1);

if (!defined('CITADEL_CONFIG_LOADED')) {
    require_once __DIR__ . '/config.php';
}

/**
 * Do we have a *hint* that the user is authenticated?
 *
 * Returns true if the cosmetic `citadel_ui_hint` cookie says "1".
 * This is a UI-only signal — the API is the real authority.
 */
function citadel_ui_hint_authed(): bool
{
    return ($_COOKIE['citadel_ui_hint'] ?? '0') === '1';
}

/**
 * Render the initial auth-state marker so JS knows what to expect.
 * The nav's JS replaces this DOM as soon as /me responds.
 */
function citadel_render_auth_state(): string
{
    return citadel_ui_hint_authed() ? 'user' : 'guest';
}

/* ══════════════════════════════════════════════════════════════════════════
 * REGISTER THE HINT COOKIE META
 * --------------------------------------------------------------------------
 * The hint cookie is set by JS (via Citadel.setUiHint). PHP only reads it.
 * Here we document the contract for anyone auditing this file.
 *
 * Cookie name:  citadel_ui_hint
 * Values:       "1" (signed in last visit) | "0" (signed out)
 * Lifetime:     30 days
 * Attributes:   Secure, SameSite=Lax, HttpOnly=NO
 * Domain:       mycitadel.lol only
 * Purpose:      Cosmetic UI hint. Zero authorization weight.
 *
 * If a user clears this cookie:
 *   → Next page load shows "Login" button for ~200ms
 *   → JS calls /me, sees they're authenticated
 *   → Nav swaps to "user menu"
 *   → Hint cookie is re-set
 *
 * Worst case of tampering: user sees a logout flash before the API corrects it.
 * ========================================================================== */