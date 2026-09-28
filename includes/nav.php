<?php
/* ============================================================================
 * ███ INCLUDES/NAV.PHP ███
 * Top navigation. Renders THREE states:
 *   1. Public links (Home, About, Contact, Security) — always visible
 *   2. Guest block (Login / Register) — visible when not authenticated
 *   3. User block (Notifications + dropdown menu) — visible when authenticated
 *
 * The initial HTML renders "guest". JS hydrates to "user" after calling
 * /users/me.php during bootstrap. If JS never loads, the page still works
 * for anonymous visitors. If the user IS authenticated but JS fails, they
 * can still reach the login page and re-authenticate — no dead end.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/config.php';
?>
<nav class="citadel-nav" id="citadel-nav" aria-label="Main">
    <div class="citadel-nav__inner">

        <!-- ── Brand ─────────────────────────────────────────────── -->
        <a href="/" class="citadel-nav__brand" aria-label="MyCitadel home">
            <span class="citadel-nav__brand-mark" aria-hidden="true">ᛗ</span>
            <span class="citadel-nav__brand-text">MyCitadel</span>
        </a>

        <!-- ── Public static links (always visible) ──────────────── -->
        <ul class="citadel-nav__links" role="list">
            <li><a href="/"        <?= $_SERVER['REQUEST_URI'] === '/'         ? 'class="active" aria-current="page"' : '' ?>>Home</a></li>
            <li><a href="/about"   <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/about')   ? 'class="active" aria-current="page"' : '' ?>>About</a></li>
            <li><a href="/contact" <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/contact') ? 'class="active" aria-current="page"' : '' ?>>Contact</a></li>
            <li><a href="/security"     <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/security')     ? 'class="active" aria-current="page"' : '' ?>>Security &amp; Privacy</a></li>
        </ul>

        <!-- ── Right side — auth-aware ───────────────────────────── -->
        <div class="citadel-nav__auth" id="citadel-nav-auth">

            <!-- ═══════════════════════════════════════════════════════
                 STATE 1 — GUEST (default)
                 ═══════════════════════════════════════════════════════ -->
            <div class="auth-guest" data-auth-state="guest">
                <a href="/login"    class="btn-cyber citadel-nav__btn">Log In</a>
                <a href="/register" class="btn-cyber btn-gold citadel-nav__btn">Register</a>
            </div>

            <!-- ═══════════════════════════════════════════════════════
                 STATE 2 — AUTHENTICATED (revealed by nav.js)
                 ═══════════════════════════════════════════════════════ -->
            <div class="auth-user" data-auth-state="user" hidden>

                <!-- Notifications bell with unread badge -->
                <a href="/notifications" class="citadel-nav__icon" aria-label="Notifications">
                    <span class="citadel-nav__icon-glyph" aria-hidden="true">◈</span>
                    <span class="citadel-nav__badge" data-badge="notifications" hidden>0</span>
                </a>

                <!-- Avatar + username toggle -->
                <button type="button"
                        class="citadel-nav__user"
                        id="citadel-nav-user-toggle"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="citadel-nav-dropdown">
                    <span class="citadel-nav__avatar" data-avatar aria-hidden="true"></span>
                    <span class="citadel-nav__username" data-username>…</span>
                    <span class="citadel-nav__caret" aria-hidden="true">▾</span>
                </button>

                <!-- Dropdown menu -->
                <div class="citadel-nav__dropdown"
                     id="citadel-nav-dropdown"
                     hidden
                     role="menu"
                     aria-labelledby="citadel-nav-user-toggle">

                    <span class="citadel-nav__dropdown-heading">Citizen</span>
                    <a href="/users/dashboard" role="menuitem">🏠 Dashboard</a>
                    <a href="/feed"      role="menuitem">📡 Feed</a>
                    <a href="/users"     role="menuitem">👥 Citizens</a>
                    <a href="/connections" role="menuitem">🤝 Connections</a>

                    <hr>

                    <span class="citadel-nav__dropdown-heading">Account</span>
                    <a href="/users/edit"   role="menuitem">✎ Edit Profile</a>
                    <a href="/me"        role="menuitem">📝 My Posts</a>
                    <a href="/premium"   role="menuitem">⭐ Subscription</a>
                    <a href="/settings/2fa" role="menuitem">🛡️ Security &amp; 2FA</a>

                    <hr>

                    <a href="/logout"
                       data-action="logout"
                       role="menuitem"
                       class="text-danger">
                        ⏻ Logout
                    </a>
                </div>
            </div>

            <!-- ═══════════════════════════════════════════════════════
                 STATE 3 — LOADING (shown briefly during bootstrap)
                 ═══════════════════════════════════════════════════════ -->
            <div class="auth-loading" data-auth-state="loading" hidden>
                <span class="citadel-nav__spinner" aria-hidden="true"></span>
            </div>

        </div>

        <!-- ── Mobile menu toggle ─────────────────────────────────── -->
        <button type="button"
                class="citadel-nav__burger"
                id="citadel-nav-burger"
                aria-label="Toggle menu"
                aria-expanded="false"
                aria-controls="citadel-nav">
            <span></span><span></span><span></span>
        </button>

    </div>
</nav>