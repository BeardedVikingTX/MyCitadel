<?php
/* ============================================================================
 * ███ MYCITADEL.LOL/USERS/EDIT.PHP ███
 * Profile editor. Loads the current profile, renders 12 sections, autosaves
 * on blur, uploads images immediately.
 * ========================================================================== */

declare(strict_types=1);

require_once __DIR__ . '/../includes/config.php';

citadel_set_meta([
    'title'       => 'Edit Profile — MyCitadel',
    'description' => 'Shape your Citizen identity. Every field is encrypted and yours.',
    'og_title'    => 'Edit Profile — MyCitadel',
    'og_url'      => CITADEL_SITE_URL . '/users/edit',
    'canonical'   => CITADEL_SITE_URL . '/users/edit',
    'body_class'  => 'page-profile-edit',
]);

require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/nav.php';

$API_BASE = 'https://api.mycitadel.lol/v1';
$LOGIN_URL = '/login';
$CLIENT_HEADER = 'browser/1.0.0';
?>

<div class="edit-root"
     data-api-base="<?= htmlspecialchars($API_BASE, ENT_QUOTES, 'UTF-8') ?>"
     data-client="<?= htmlspecialchars($CLIENT_HEADER, ENT_QUOTES, 'UTF-8') ?>"
     data-login-url="<?= htmlspecialchars($LOGIN_URL, ENT_QUOTES, 'UTF-8') ?>">

    <noscript>
        <div class="edit-noscript">
            <h2>JavaScript Required</h2>
            <p>The profile editor needs JavaScript enabled. Please enable it and reload.</p>
        </div>
    </noscript>

    <!-- Toast layer for save/error feedback -->
    <div class="edit-toast-layer" id="edit-toast-layer" aria-live="polite"></div>

    <!-- Loading state -->
    <div class="edit-loading" id="edit-loading">
        <div class="edit-loading__spinner" aria-hidden="true"></div>
        <p class="edit-loading__text">Loading your profile…</p>
    </div>

    <!-- Error state -->
    <div class="edit-error" id="edit-error" hidden>
        <div class="edit-error__icon" aria-hidden="true">⚠</div>
        <h2>Could not load your profile</h2>
        <p id="edit-error-msg">Something went wrong.</p>
        <button type="button" class="btn-cyber" id="edit-retry">Retry</button>
    </div>

    <!-- Main editor -->
    <div class="edit-shell" id="edit-shell" hidden>

        <!-- Sidebar navigation -->
        <aside class="edit-nav" aria-label="Sections">
            <div class="edit-nav__inner">
                <div class="edit-nav__brand">
                    <span class="edit-nav__eyebrow">Citizen Editor</span>
                    <h1 class="edit-nav__title" id="edit-nav-title">—</h1>
                    <p class="edit-nav__handle" id="edit-nav-handle">—</p>
                </div>
                <nav class="edit-nav__list" id="edit-nav-list" role="tablist"></nav>
                <div class="edit-nav__foot">
                    <a href="/users/dashboard.php" class="edit-nav__back">← Dashboard</a>
                </div>
            </div>
        </aside>

        <!-- Section content -->
        <main class="edit-content" id="edit-content">

            <!-- Identity -->
            <section class="edit-section" data-section="identity">
                <header class="edit-section__head">
                    <h2>Identity</h2>
                    <p>How the Citadel sees you. Display name and tagline are the first things other Citizens notice.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field edit-field--full">
                        <label>Display Name</label>
                        <input type="text" data-field="display_name" maxlength="64" placeholder="Bearded Viking">
                        <p class="edit-field__hint">Shown everywhere in place of your username. 64 characters max.</p>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Tagline</label>
                        <input type="text" data-field="tagline" maxlength="120" placeholder="Self-taught builder. Father of four. Privacy absolutist.">
                        <p class="edit-field__hint">One line that captures you. 120 characters max.</p>
                    </div>
                    <div class="edit-field">
                        <label>Pronouns</label>
                        <input type="text" data-field="pronouns" maxlength="32" placeholder="he/him, she/her, they/them">
                    </div>
                    <div class="edit-field">
                        <label>Personal Motto</label>
                        <input type="text" data-field="personal_motto" maxlength="120" placeholder="Fortune favors the bold">
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Bio</label>
                        <textarea data-field="bio" rows="5" maxlength="2000" placeholder="Tell the Citadel who you are. 2000 characters max."></textarea>
                        <p class="edit-field__hint"><span data-counter="bio">0</span> / 2000</p>
                    </div>
                </div>
            </section>

            <!-- Images -->
            <section class="edit-section" data-section="images">
                <header class="edit-section__head">
                    <h2>Images</h2>
                    <p>Your avatar is cropped to a circle. Banner and wallpaper should be wide. Max 5 MB each.</p>
                </header>
                <div class="edit-images">
                    <div class="edit-image-slot" data-image="avatar">
                        <label class="edit-image-slot__label">Avatar</label>
                        <div class="edit-image-slot__preview edit-image-slot__preview--circle">
                            <img data-image-preview="avatar" alt="" hidden>
                            <span class="edit-image-slot__placeholder" data-image-placeholder="avatar">A</span>
                        </div>
                        <p class="edit-image-slot__hint">512×512 · JPG, PNG, WebP</p>
                        <label class="edit-image-slot__btn">
                            <input type="file" accept="image/jpeg,image/png,image/webp" data-image-input="avatar" hidden>
                            <span>Change Avatar</span>
                        </label>
                    </div>
                    <div class="edit-image-slot" data-image="banner">
                        <label class="edit-image-slot__label">Banner</label>
                        <div class="edit-image-slot__preview edit-image-slot__preview--wide">
                            <img data-image-preview="banner" alt="" hidden>
                            <span class="edit-image-slot__placeholder" data-image-placeholder="banner">1500×500</span>
                        </div>
                        <p class="edit-image-slot__hint">1500×500 · JPG, PNG, WebP</p>
                        <label class="edit-image-slot__btn">
                            <input type="file" accept="image/jpeg,image/png,image/webp" data-image-input="banner" hidden>
                            <span>Change Banner</span>
                        </label>
                    </div>
                    <div class="edit-image-slot" data-image="wallpaper">
                        <label class="edit-image-slot__label">Wallpaper</label>
                        <div class="edit-image-slot__preview edit-image-slot__preview--wide">
                            <img data-image-preview="wallpaper" alt="" hidden>
                            <span class="edit-image-slot__placeholder" data-image-placeholder="wallpaper">1920×1080</span>
                        </div>
                        <p class="edit-image-slot__hint">1920×1080 or larger · JPG, PNG, WebP</p>
                        <label class="edit-image-slot__btn">
                            <input type="file" accept="image/jpeg,image/png,image/webp" data-image-input="wallpaper" hidden>
                            <span>Change Wallpaper</span>
                        </label>
                    </div>
                </div>
            </section>

            <!-- Location -->
            <section class="edit-section" data-section="location">
                <header class="edit-section__head">
                    <h2>Location</h2>
                    <p>Country and state are shown on your profile. Timezone helps with availability.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field">
                        <label>Country</label>
                        <input type="text" data-field="country_code" maxlength="2" placeholder="US" style="text-transform:uppercase;">
                        <p class="edit-field__hint">2-letter code</p>
                    </div>
                    <div class="edit-field">
                        <label>State / Region</label>
                        <input type="text" data-field="state_code" maxlength="8" placeholder="TX" style="text-transform:uppercase;">
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Timezone</label>
                        <input type="text" data-field="timezone" maxlength="64" placeholder="America/Chicago">
                        <p class="edit-field__hint">IANA timezone name (e.g. America/New_York)</p>
                    </div>
                </div>
            </section>

            <!-- Personal (PII) -->
            <section class="edit-section" data-section="personal">
                <header class="edit-section__head">
                    <h2>Personal Information</h2>
                    <p>Encrypted with a key tied to your account. We literally cannot read these fields.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field"><label>First Name</label><input type="text" data-field="first_name" maxlength="64"></div>
                    <div class="edit-field"><label>Middle Name</label><input type="text" data-field="middle_name" maxlength="64"></div>
                    <div class="edit-field"><label>Last Name</label><input type="text" data-field="last_name" maxlength="64"></div>
                    <div class="edit-field"><label>Phone</label><input type="tel" data-field="phone" maxlength="32"></div>
                    <div class="edit-field"><label>Backup Email</label><input type="email" data-field="backup_email" maxlength="254"></div>
                    <div class="edit-field"><label>Recovery Phone</label><input type="tel" data-field="recovery_phone" maxlength="32"></div>
                    <div class="edit-field"><label>Birthday</label><input type="date" data-field="birthday"></div>
                    <div class="edit-field"><label>Birth Year</label><input type="number" data-field="birth_year" min="1900" max="2100" placeholder="1985"></div>
                    <div class="edit-field edit-field--full"><label>Address Line 1</label><input type="text" data-field="address_line1" maxlength="128"></div>
                    <div class="edit-field edit-field--full"><label>Address Line 2</label><input type="text" data-field="address_line2" maxlength="128"></div>
                    <div class="edit-field"><label>City</label><input type="text" data-field="city" maxlength="64"></div>
                    <div class="edit-field"><label>ZIP / Postal Code</label><input type="text" data-field="zip" maxlength="16"></div>
                </div>
            </section>

            <!-- Work -->
            <section class="edit-section" data-section="work">
                <header class="edit-section__head">
                    <h2>Work</h2>
                    <p>What you do, where you do it, and what you've learned.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field"><label>Job Title</label><input type="text" data-field="job_title" maxlength="128"></div>
                    <div class="edit-field"><label>Company</label><input type="text" data-field="company_name" maxlength="128"></div>
                    <div class="edit-field"><label>Years at Company</label><input type="number" data-field="years_at_company" min="0" max="80"></div>
                    <div class="edit-field"><label>Industry</label><input type="text" data-field="industry" maxlength="64"></div>
                    <div class="edit-field edit-field--full"><label>Education</label><input type="text" data-field="education" maxlength="128" placeholder="BS Computer Science, UT Austin"></div>
                    <div class="edit-field edit-field--full">
                        <label>Work Description</label>
                        <textarea data-field="work_description" rows="4" maxlength="1000" placeholder="What do you actually do day to day?"></textarea>
                    </div>
                </div>
            </section>

            <!-- Personal Life -->
            <section class="edit-section" data-section="life">
                <header class="edit-section__head">
                    <h2>Personal Life</h2>
                    <p>The things that make you, you. All optional.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field">
                        <label>Relationship Status</label>
                        <select data-field="relationship_status" data-options="relationship_statuses"></select>
                    </div>
                    <div class="edit-field">
                        <label>Personality Type</label>
                        <input type="text" data-field="personality_type" maxlength="16" placeholder="INTJ">
                    </div>
                    <div class="edit-field">
                        <label>Zodiac Sign</label>
                        <input type="text" data-field="zodiac_sign" maxlength="16" placeholder="Scorpio">
                    </div>
                    <div class="edit-field">
                        <label>Languages Spoken</label>
                        <input type="text" data-field="languages_spoken" maxlength="128" placeholder="English, Spanish">
                    </div>
                    <div class="edit-field edit-field--full">
                        <label class="edit-toggle">
                            <input type="checkbox" data-field="has_kids">
                            <span>I have kids</span>
                        </label>
                    </div>
                    <div class="edit-field edit-field--kids">
                        <label>Number of Kids</label>
                        <input type="number" data-field="kids_count" min="0" max="30">
                    </div>
                </div>
            </section>

            <!-- Interests -->
            <section class="edit-section" data-section="interests">
                <header class="edit-section__head">
                    <h2>Interests & Availability</h2>
                    <p>What you're looking for in the Citadel and how you want to be reached.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field edit-field--full">
                        <label>Looking For</label>
                        <div class="edit-chip-group" data-chips="looking_for"></div>
                        <p class="edit-field__hint">Pick everything that applies.</p>
                    </div>
                    <div class="edit-field">
                        <label>Availability</label>
                        <select data-field="availability" data-options="availabilities"></select>
                    </div>
                    <div class="edit-field">
                        <label>Preferred Contact</label>
                        <select data-field="contact_preference" data-options="contact_preferences"></select>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Hobbies & Interests</label>
                        <textarea data-field="hobbies_and_interests" rows="4" maxlength="1000" placeholder="Anything from blacksmithing to birdwatching."></textarea>
                    </div>
                </div>
            </section>

            <!-- Favorites -->
            <section class="edit-section" data-section="favorites">
                <header class="edit-section__head">
                    <h2>Favorites</h2>
                    <p>Movies, books, songs, shows, games — the things you'd recommend to a stranger.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field edit-field--full">
                        <label>Favorite Movies</label>
                        <div class="edit-list-editor" data-list="favorite_movies"></div>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Favorite Books</label>
                        <div class="edit-list-editor" data-list="favorite_books"></div>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Favorite Songs</label>
                        <div class="edit-list-editor" data-list="favorite_songs"></div>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Favorite TV Shows</label>
                        <div class="edit-list-editor" data-list="favorite_shows"></div>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Favorite Games</label>
                        <div class="edit-list-editor" data-list="favorite_games"></div>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Favorite Quotes</label>
                        <textarea data-field="favorite_quotes" rows="3" maxlength="1000"></textarea>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Favorite Food</label>
                        <input type="text" data-field="favorite_food" maxlength="128">
                    </div>
                </div>
            </section>

            <!-- Links -->
            <section class="edit-section" data-section="links">
                <header class="edit-section__head">
                    <h2>Links</h2>
                    <p>Everywhere else you can be found. Leave anything blank that you don't want shown.</p>
                </header>

                <div class="edit-subsection">
                    <h3 class="edit-subsection__title">Personal</h3>
                    <div class="edit-grid">
                        <div class="edit-field"><label>Website</label><input type="url" data-field="website_url" maxlength="255" placeholder="https://"></div>
                        <div class="edit-field"><label>GitHub</label><input type="url" data-field="github_url" maxlength="255" placeholder="https://github.com/"></div>
                        <div class="edit-field"><label>Stack Overflow</label><input type="url" data-field="stackoverflow_url" maxlength="255"></div>
                        <div class="edit-field"><label>Public PGP Key</label><input type="text" data-field="public_pgp_key" maxlength="4096"></div>
                        <div class="edit-field"><label>Signal Username</label><input type="text" data-field="signal_username" maxlength="64"></div>
                        <div class="edit-field"><label>Discord</label><input type="text" data-field="discord_handle" maxlength="64"></div>
                    </div>
                </div>

                <div class="edit-subsection">
                    <h3 class="edit-subsection__title">Social</h3>
                    <div class="edit-grid">
                        <div class="edit-field"><label>Facebook</label><input type="url" data-field="facebook_url" maxlength="255"></div>
                        <div class="edit-field"><label>Twitter / X</label><input type="url" data-field="twitter_url" maxlength="255"></div>
                        <div class="edit-field"><label>Instagram</label><input type="url" data-field="instagram_url" maxlength="255"></div>
                        <div class="edit-field"><label>TikTok</label><input type="url" data-field="tiktok_url" maxlength="255"></div>
                        <div class="edit-field"><label>Threads</label><input type="url" data-field="threads_url" maxlength="255"></div>
                        <div class="edit-field"><label>LinkedIn</label><input type="url" data-field="linkedin_url" maxlength="255"></div>
                        <div class="edit-field"><label>YouTube</label><input type="url" data-field="youtube_url" maxlength="255"></div>
                    </div>
                </div>

                <div class="edit-subsection">
                    <h3 class="edit-subsection__title">Federated</h3>
                    <div class="edit-grid">
                        <div class="edit-field"><label>Mastodon</label><input type="url" data-field="mastodon_url" maxlength="255"></div>
                        <div class="edit-field"><label>Bluesky</label><input type="url" data-field="bluesky_url" maxlength="255"></div>
                    </div>
                </div>

                <div class="edit-subsection">
                    <h3 class="edit-subsection__title">Gaming</h3>
                    <div class="edit-grid">
                        <div class="edit-field"><label>Steam ID</label><input type="text" data-field="steam_id" maxlength="64"></div>
                        <div class="edit-field"><label>PSN Handle</label><input type="text" data-field="psn_handle" maxlength="64"></div>
                        <div class="edit-field"><label>Xbox Gamertag</label><input type="text" data-field="xbox_gamertag" maxlength="64"></div>
                    </div>
                </div>

                <div class="edit-subsection">
                    <h3 class="edit-subsection__title">Streaming</h3>
                    <div class="edit-grid">
                        <div class="edit-field"><label>Twitch</label><input type="url" data-field="twitch_url" maxlength="255"></div>
                        <div class="edit-field"><label>Kick</label><input type="url" data-field="kick_url" maxlength="255"></div>
                        <div class="edit-field"><label>Podcast</label><input type="url" data-field="podcast_url" maxlength="255"></div>
                    </div>
                </div>

                <div class="edit-subsection">
                    <h3 class="edit-subsection__title">Security / Bug Bounty</h3>
                    <div class="edit-grid">
                        <div class="edit-field"><label>HackerOne</label><input type="url" data-field="hackerone_url" maxlength="255"></div>
                        <div class="edit-field"><label>Bugcrowd</label><input type="url" data-field="bugcrowd_url" maxlength="255"></div>
                        <div class="edit-field"><label>Intigriti</label><input type="url" data-field="intigriti_url" maxlength="255"></div>
                        <div class="edit-field"><label>YesWeHack</label><input type="url" data-field="yeswehack_url" maxlength="255"></div>
                    </div>
                </div>
            </section>

            <!-- Theme -->
            <section class="edit-section" data-section="theme">
                <header class="edit-section__head">
                    <h2>Theme</h2>
                    <p>Customize how your profile looks to connected Citizens.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field">
                        <label>Accent Color</label>
                        <input type="text" data-field="accent_color" maxlength="16" placeholder="#00e5ff">
                    </div>
                    <div class="edit-field">
                        <label>Theme Preference</label>
                        <select data-field="theme_preference">
                            <option value="dark">Dark</option>
                            <option value="light">Light</option>
                            <option value="auto">Auto</option>
                        </select>
                    </div>
                    <div class="edit-field">
                        <label>Wallpaper Opacity</label>
                        <input type="range" data-field="wallpaper_opacity" min="0" max="100" step="1">
                        <p class="edit-field__hint"><span data-counter="wallpaper_opacity">50</span>%</p>
                    </div>
                    <div class="edit-field">
                        <label>Wallpaper Blur</label>
                        <input type="range" data-field="wallpaper_blur" min="0" max="40" step="1">
                        <p class="edit-field__hint"><span data-counter="wallpaper_blur">0</span>px</p>
                    </div>
                    <div class="edit-field">
                        <label>Border Style</label>
                        <select data-field="border_style" data-options="border_styles"></select>
                    </div>
                    <div class="edit-field">
                        <label>Border Thickness</label>
                        <input type="range" data-field="border_thickness" min="0" max="8" step="1">
                        <p class="edit-field__hint"><span data-counter="border_thickness">1</span>px</p>
                    </div>
                    <div class="edit-field">
                        <label>Border Color</label>
                        <input type="text" data-field="border_color" maxlength="16" placeholder="#00e5ff">
                    </div>
                    <div class="edit-field">
                        <label>Heading Font</label>
                        <select data-field="font_heading" data-options="fonts_heading"></select>
                    </div>
                    <div class="edit-field">
                        <label>Body Font</label>
                        <select data-field="font_body" data-options="fonts_body"></select>
                    </div>
                    <div class="edit-field">
                        <label>Mono Font</label>
                        <select data-field="font_mono" data-options="fonts_mono"></select>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Background Music Video ID</label>
                        <input type="text" data-field="music_video_id" maxlength="32" placeholder="YouTube video ID">
                    </div>
                    <div class="edit-field edit-field--full">
                        <label class="edit-toggle">
                            <input type="checkbox" data-field="music_autoplay">
                            <span>Autoplay music when profile loads</span>
                        </label>
                    </div>
                </div>
            </section>

            <!-- Privacy -->
            <section class="edit-section" data-section="privacy">
                <header class="edit-section__head">
                    <h2>Privacy & Visibility</h2>
                    <p>Who can see what. You control every toggle.</p>
                </header>

                <div class="edit-grid">
                    <div class="edit-field edit-field--full">
                        <label>Profile Visibility</label>
                        <select data-field="visibility" id="edit-visibility-select">
                            <option value="public">Public — anyone can find you in the directory</option>
                            <option value="connections_only">Connections Only — hidden from search, visible to accepted connections</option>
                            <option value="hidden">Hidden — invisible to everyone except yourself</option>
                        </select>
                    </div>
                </div>

                <h3 class="edit-subsection__title">Show on Profile</h3>
                <div class="edit-toggle-list">
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_email"><span>Email address</span></label>
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_phone"><span>Phone number</span></label>
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_location"><span>Location</span></label>
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_birthday"><span>Birthday</span></label>
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_real_name"><span>Real name</span></label>
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_social_links"><span>Social links</span></label>
                    <label class="edit-toggle edit-toggle--row"><input type="checkbox" data-toggle="show_premium"><span>Premium badge</span></label>
                </div>

                <p class="edit-field__hint edit-field__hint--standalone">
                    Visibility changes take effect immediately. Toggles control what connected Citizens see on your full profile.
                </p>
            </section>

            <!-- Account -->
            <section class="edit-section" data-section="account">
                <header class="edit-section__head">
                    <h2>Account</h2>
                    <p>Change your login credentials. These changes are sensitive — you'll need your current password.</p>
                </header>
                <div class="edit-grid">
                    <div class="edit-field">
                        <label>Username</label>
                        <input type="text" id="edit-username" maxlength="32">
                        <p class="edit-field__hint">3–32 chars, letters/numbers/underscores. Changing is instant.</p>
                        <button type="button" class="edit-inline-save" id="edit-save-username" disabled>Save Username</button>
                    </div>
                    <div class="edit-field">
                        <label>Email Address</label>
                        <input type="email" id="edit-email" maxlength="254">
                        <p class="edit-field__hint">Changing email resets verification — you'll need to verify the new one.</p>
                        <button type="button" class="edit-inline-save" id="edit-save-email" disabled>Save Email</button>
                    </div>
                    <div class="edit-field edit-field--full">
                        <label>Current Password</label>
                        <input type="password" id="edit-current-password" maxlength="1024" autocomplete="current-password">
                        <p class="edit-field__hint">Required to change your email or password.</p>
                    </div>
                    <div class="edit-field">
                        <label>New Password</label>
                        <input type="password" id="edit-new-password" maxlength="1024" autocomplete="new-password">
                        <p class="edit-field__hint">Minimum 12 characters. Leave blank to keep current.</p>
                    </div>
                    <div class="edit-field">
                        <label>Confirm New Password</label>
                        <input type="password" id="edit-new-password-confirm" maxlength="1024" autocomplete="new-password">
                    </div>
                    <div class="edit-field edit-field--full">
                        <button type="button" class="edit-inline-save edit-inline-save--danger" id="edit-save-password" disabled>Change Password</button>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>


<?php require __DIR__ . '/../includes/footer.php'; ?>