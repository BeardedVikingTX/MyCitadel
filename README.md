# MyCitadel

> **Your digital fortress. Your rules.**

MyCitadel is a revolutionary privacy-first social media platform built on a zero-knowledge architecture. Unlike traditional social networks, your data is encrypted **before** it ever reaches our servers. We never see your plaintext—not your posts, messages, or personal information.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](http://makeapullrequest.com)
[![Security: Argon2id](https://img.shields.io/badge/Security-Argon2id-blue)](https://www.argon2.com/)

---

## 🔐 Core Principles

- **Zero-Knowledge Architecture** – All sensitive data is encrypted client-side. The server only stores ciphertext.
- **Argon2id Hashing** – State-of-the-art password hashing resistant to GPU/ASIC attacks.
- **End-to-End Encryption** – Messages and private data are encrypted end-to-end.
- **No Plaintext Ever** – We cannot read your data, even if compelled.
- **Open Source** – Transparency is trust. Audit our code anytime.

---

## ✨ Features

- **Secure Registration & Login** – Argon2id + client-side key derivation.
- **User Dashboard** – Manage your profile, privacy settings, and encryption keys.
- **Gamification** – Earn badges, build reputation points, and unlock achievements.
- **Premium Tier ($10/mo)** – Advanced features, higher limits, exclusive badges.
- **API-First Design** – All functionality exposed via `api.mycitadel.lol`.
- **Cross-Platform** – Web, Android (coming soon), iOS (future).

---

## 🏗️ Architecture

| Component | Domain | Description |
|-----------|--------|-------------|
| Web Frontend | `mycitadel.lol` | Bootstrap, DOMPurify, ChartJS, custom UI |
| API Backend | `api.mycitadel.lol` | PHP RESTful API, Argon2id, zero-knowledge |
| Secure Core | `secure_mycitadel.lol` | **Private** – encryption orchestration, key management (not publicly exposed) |

### Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap, DOMPurify, ChartJS, Canvas-Confetti
- **Backend:** PHP 8+, Composer, Argon2id, libsodium (planned)
- **Database:** MySQL/PostgreSQL with encrypted blobs
- **Fonts:** Self-hosted Google Fonts (WOFF2)
- **Payments:** Stripe PHP SDK

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.1+
- Composer
- MySQL 8+ or PostgreSQL 14+
- Web server (Apache/Nginx)

### Installation

1. Clone the repository:
```
git clone https://github.com/BeardedVikingTX/MyCitadel.git
cd MyCitadel
```
2. Install dependencies:
```
composer install
```
3. Configure environment:
```
cp .env.example .env
# Edit .env with your database credentials and encryption keys
```
4. Import database schema (coming soon).
5. Serve the site:
```
php -S localhost:8000
```

# 🛡️ Security & Bug Bounty
-------------------------

We take security seriously. After our initial launch (with a small group of friends & family) and the release of our Android app, we will launch a **public bug bounty program on HackerOne**.

### Rewards

-   **Reputation Points** -- Earn points on MyCitadel for valid reports.

-   **Merch** -- Exclusive MyCitadel gear (limited availability).

-   **Critical Vulnerabilities** -- Up to **$1,000 USD** for extreme, critical issues (case-by-case basis).

We do **not** have a broad financial reward structure, but we deeply value responsible disclosure. Full details will be announced on HackerOne.

**Please do not test vulnerabilities on production without permission.** Contact us first.

* * * * *

# 🤝 Contributing
---------------

We welcome contributions! Please read our [Contributing Guidelines](https://contributing.md/) (coming soon). For now:

1.  Fork the repo.

2.  Create a feature branch.

3.  Commit your changes.

4.  Push and open a Pull Request.

* * * * *

# 📜 License
----------

This project is licensed under the MIT License -- see the [LICENSE](https://license/) file for details.

* * * * *

# 🔗 Links
--------

-   **Website:**  [https://mycitadel.lol](https://mycitadel.lol/)

-   **API:**  [https://api.mycitadel.lol](https://api.mycitadel.lol/)

-   **GitHub API Repo:**  [API_MyCitadel](https://github.com/BeardedVikingTX/API_MyCitadel)

-   **HackerOne:** (coming soon)

* * * * *

# 🙏 Acknowledgements
-------------------

-   Built with ❤️ by Bearded Viking and contributors.

-   Special thanks to the open-source community.