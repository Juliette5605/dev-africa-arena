#  DevAfrica Arena — Laravel 11

> Premier Championnat Technologique Bimestriel d'Afrique de l'Ouest  
> Lomé, Togo — Propulsé par l'innovation africaine

**Contact :** Adjété Alex WILSON — wilsoncodemosaic@gmail.com — +228 71 15 50 55

---

##  Installation complète (5 commandes)

```bash
# 1. Installer les dépendances PHP
composer install

# 2. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 3. Créer la base de données SQLite et migrer
touch database/database.sqlite
php artisan migrate

# 4. Seeder — crée le compte admin + 1 édition de démo
php artisan db:seed

# 5. Lancer le serveur
php artisan serve
```

>  **Site :** http://localhost:8000  
>  **Admin :** http://localhost:8000/admin  
>  **Login :** admin@devafrica.arena  
>  **Mot de passe :** Arena2026@Admin

---

##  Base de données

### MySQL (production recommandée)
```bash
# 1. Créer la base dans MySQL/MariaDB
mysql -u root -p
CREATE DATABASE devafrica_arena CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# 2. Modifier .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=devafrica_arena
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe

# 3. Migrer
php artisan migrate
php artisan db:seed
```

### SQLite (développement — zéro config)
```bash
touch database/database.sqlite
# DB_CONNECTION=sqlite dans .env (déjà par défaut)
php artisan migrate && php artisan db:seed
```

---

##  Structure du projet

```
arena-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AuthController.php       ← Login/logout admin sécurisé
│   │   │   │   └── DashboardController.php  ← Panel admin complet
│   │   │   ├── FormController.php           ← 5 formulaires + validation + emails
│   │   │   ├── NewsletterController.php     ← Abonnement newsletter
│   │   │   └── PageController.php          ← 10 pages publiques
│   │   └── Middleware/
│   │       └── AdminMiddleware.php          ← Protection routes admin
│   ├── Mail/
│   │   ├── CandidatureConfirmation.php     ← Email HTML premium au candidat
│   │   └── NewsletterWelcome.php           ← Email bienvenue abonné
│   ├── Models/
│   │   ├── Admin.php                        ← Guard admin séparé
│   │   ├── Candidature.php
│   │   ├── ContactMessage.php
│   │   ├── Edition.php
│   │   ├── Newsletter.php
│   │   ├── Partenaire.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
├── bootstrap/
│   ├── app.php                              ← Middleware alias 'admin'
│   └── cache/
├── config/
│   ├── app.php, auth.php, cache.php
│   ├── database.php, filesystems.php
│   ├── logging.php, mail.php, session.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_01_01_100000_create_admins_table.php
│   │   ├── 2026_01_01_100001_create_editions_table.php
│   │   ├── 2026_01_01_100002_create_candidatures_table.php
│   │   ├── 2026_01_01_100003_create_partenaires_table.php
│   │   ├── 2026_01_01_100004_create_contact_messages_table.php
│   │   └── 2026_01_01_100005_create_newsletters_table.php
│   └── seeders/
│       └── DatabaseSeeder.php               ← Admin + Édition de démo
├── public/
│   ├── .htaccess                            ← Réécriture URL Apache
│   ├── index.php                            ← Point d'entrée Laravel
│   ├── robots.txt
│   └── assets/
│       ├── logo.png
│       ├── logo_saei.png
│       └── dda.jpg
├── resources/
│   ├── css/app.css
│   ├── js/app.js, bootstrap.js
│   └── views/
│       ├── admin/                           ← Panel admin (10 vues)
│       ├── emails/                          ← 2 templates email HTML
│       ├── errors/404.blade.php             ← Page 404 custom Arena
│       ├── layouts/app.blade.php            ← Layout principal
│       └── pages/                           ← 10 pages publiques
├── routes/
│   ├── web.php                              ← Toutes les routes
│   └── console.php
├── storage/                                  ← Logs, sessions, cache
├── tests/
│   ├── Feature/PageTest.php                 ← Tests HTTP des routes
│   └── Unit/CandidatureTest.php
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
└── vite.config.js
```

---

##  Fonctionnalités complètes

###  Front-End Premium
| Feature | Description |
|---|---|
| **Scroll Progress Bar** | Barre dorée `#f39c12` en haut qui avance avec le scroll |
| **Dark Mode** | Toggle 🌙/☀️ avec `localStorage` persistant |
| **Back-to-top** | Bouton flottant visible après 400px |
| **Countdown Timer** | J/H/M/S live vers la finale de l'édition active |
| **Compteurs animés** | Intersection Observer — 100+, 350K, 6, 2 |
| **Snow Canvas** | Particules dorées animées sur le Hero |
| **AOS Animations** | Entrées fluides sur tous les éléments |
| **Quiz ADN** | 7 questions, timer 8s, 6 profils, partage Web Share API |
| **Page 404** | Animation glitch "404" + particules, thème Arena |
| **Navbar Active** | Onglet actif automatique selon `request()->routeIs()` |

###  Back-End Laravel 11
| Feature | Description |
|---|---|
| **Panel Admin** | `/admin` protégé par guard + middleware |
| **Auth Admin** | Guard `admin` séparé du guard `web` |
| **Dashboard** | Stats temps réel + countdown + barres progression |
| **Candidatures** | Liste paginée, filtres, recherche, détail, suppression |
| **Export CSV** | Stream UTF-8 BOM compatible Excel |
| **Partenaires** | Filtrage par type, suppression |
| **Messages** | Lecture complète + bouton Répondre par email |
| **Éditions** | CRUD + activation unique du countdown |
| **Newsletter** | Inscription avec anti-doublon |
| **Emails auto** | Laravel Mailable — templates HTML premium |
| **Validation** | Messages d'erreur FR côté serveur + `old()` |
| **CSRF** | Tous formulaires protégés par `@csrf` |
| **Flash messages** | Toast animé auto-dismiss en 5s |
| **Pagination** | Bootstrap 5 via `Paginator::useBootstrapFive()` |

###  Base de données (9 tables)
| Table | Usage |
|---|---|
| `users` | Standard Laravel |
| `admins` | Compte(s) administrateur |
| `editions` | Gestion des éditions et countdown |
| `candidatures` | Dossiers de candidature |
| `partenaires` | Partenaires financiers/techniques/sponsors |
| `contact_messages` | Messages de contact |
| `newsletters` | Abonnés newsletter |
| `sessions` | Sessions utilisateur |
| `cache` | Cache Laravel |

---

##  Configuration Email (Production)

### Gmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre@gmail.com
MAIL_PASSWORD=abcd_efgh_ijkl_mnop  # Mot de passe d'application (16 chars)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="arena@devafrica.tg"
MAIL_FROM_NAME="DevAfrica Arena"
```
> Générer un mot de passe d'application : myaccount.google.com/apppasswords

### Mailtrap (Tests)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_username
MAIL_PASSWORD=votre_password
MAIL_ENCRYPTION=tls
```

---

##  Lancer les tests

```bash
php artisan test
# ou
./vendor/bin/phpunit
```

---

##  Sécurité

- ✅ CSRF sur tous les formulaires (`@csrf`)
- ✅ Validation serveur stricte sur chaque champ
- ✅ Guard admin séparé (`config/auth.php`)
- ✅ Middleware de protection sur `/admin/*`
- ✅ Mots de passe hashés (`bcrypt` via `HasFactory`)
- ✅ Session régénérée après login (`$request->session()->regenerate()`)
- ✅ `robots.txt` excluant `/admin/`

---

##  Déploiement (cPanel / Shared Hosting)

```bash
# 1. Upload des fichiers (sans vendor/)
# 2. Pointer DocumentRoot vers /public
# 3. Sur le serveur :
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan db:seed --force
```
