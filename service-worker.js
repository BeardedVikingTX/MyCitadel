/* ============================================================================
 * ███ SERVICE WORKER ███
 * MyCitadel — Push Notification Receiver
 * ----------------------------------------------------------------------------
 * This runs in a background thread, independent of any open tab. It receives
 * push events from the browser's push service and shows notifications.
 *
 * Deploy path: https://mycitadel.lol/service-worker.js
 * Scope:       /  (all pages on the domain)
 * ========================================================================== */

'use strict';

/* ── INSTALL — activate immediately ────────────────────────────────────── */
self.addEventListener('install', (event) => {
    self.skipWaiting();
});

/* ── ACTIVATE — take control of existing tabs ──────────────────────────── */
self.addEventListener('activate', (event) => {
    event.waitUntil(self.clients.claim());
});

/* ── PUSH — the main event ─────────────────────────────────────────────── */
self.addEventListener('push', (event) => {
    if (!event.data) {
        // Some browsers allow empty pushes (just a wake-up signal)
        event.waitUntil(
            self.registration.showNotification('MyCitadel', {
                body: 'You have a new notification',
                icon: 'https://mycitadel.lol/assets/img/icon-192.png',
                badge: 'https://mycitadel.lol/assets/img/badge-72.png',
                tag: 'citadel-generic',
            })
        );
        return;
    }

    let payload;
    try {
        payload = event.data.json();
    } catch (err) {
        payload = { title: 'MyCitadel', body: event.data.text() };
    }

    const title = payload.title || 'MyCitadel';
    const options = {
        body:  payload.body || '',
        icon:  payload.icon  || 'https://mycitadel.lol/assets/img/icon-192.png',
        badge: payload.badge || 'https://mycitadel.lol/assets/img/badge-72.png',
        tag:   payload.tag   || 'citadel',
        data:  payload.data  || {},
        // requireInteraction: true keeps the notification visible until acted on
        requireInteraction: false,
        // vibrate pattern (Android only)
        vibrate: [100, 50, 100],
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

/* ── NOTIFICATION CLICK — navigate to the link ────────────────────────── */
self.addEventListener('notificationclick', (event) => {
    event.notification.close();

    const link = (event.notification.data && event.notification.data.link)
        ? event.notification.data.link
        : '/dashboard';

    // Ensure absolute URL
    const targetUrl = link.startsWith('http')
        ? link
        : 'https://mycitadel.lol' + link;

    event.waitUntil(
        self.clients.matchAll({ type: 'window', includeUncontrolled: true })
            .then((clientList) => {
                // If a MyCitadel tab is already open, focus it and navigate
                for (const client of clientList) {
                    if (client.url.startsWith('https://mycitadel.lol') && 'focus' in client) {
                        client.navigate(targetUrl);
                        return client.focus();
                    }
                }
                // Otherwise open a new tab
                if (self.clients.openWindow) {
                    return self.clients.openWindow(targetUrl);
                }
            })
    );
});

/* ── PUSH SUBSCRIPTION CHANGE — re-register with the server ───────────── */
self.addEventListener('pushsubscriptionchange', (event) => {
    // The browser has invalidated our subscription (e.g. user cleared data).
    // Re-subscribe and re-register with the server.
    event.waitUntil(
        self.registration.pushManager.subscribe(event.oldSubscription.options)
            .then((newSubscription) => {
                return fetch('https://api.mycitadel.lol/v1/push/subscribe.php', {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Citadel-Client': 'browser/1.0.0',
                    },
                    body: JSON.stringify(newSubscription.toJSON()),
                });
            })
            .catch((err) => {
                console.error('[SW] pushsubscriptionchange failed', err);
            })
    );
});