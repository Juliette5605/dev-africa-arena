<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="DevAfrica Arena — Plateforme intelligente de matching de talents numériques à Lomé, Togo. Transformez votre talent en opportunité.">
    <meta name="author" content="DevAfrica Arena">
    <title><?php echo $__env->yieldContent('title', 'DevAfrica Arena | L\'Arène des Talents Numériques'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* ═══════════════════════════════════════════════════════════
            VARIABLES & BASE
        ═══════════════════════════════════════════════════════════ */
        :root {
            --gold: #f39c12;
            --gold2: #e67e22;
            --dark: #222222;
            --gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            --glass: rgba(255,255,255,0.78);
            --glass-border: rgba(0,0,0,0.07);
            --radius: 20px;
            --shadow: 0 10px 40px rgba(0,0,0,0.07);
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--dark);
            background: #ffffff;
            overflow-x: hidden;
            transition: background 0.4s, color 0.4s;
        }

        /* ═══════════════════════════════════════════════════════════
            DARK MODE
        ═══════════════════════════════════════════════════════════ */
        body.dark {
            background: #0d0d0d;
            color: #e8e8e8;
        }
        body.dark .nav-glass { background: rgba(13,13,13,0.92) !important; border-color: rgba(255,255,255,0.05) !important; }
        body.dark .nav-link { color: rgba(255,255,255,0.6) !important; }
        body.dark section:not(.dark-section) { background: #111 !important; }
        body.dark .card, body.dark .feature-card, body.dark .pack-card,
        body.dark .value-card, body.dark .quiz-box, body.dark .newsletter-box,
        body.dark .form-card { background: #1a1a1a !important; border-color: #2a2a2a !important; }
        body.dark .form-control, body.dark .form-select {
            background: rgba(255,255,255,0.05) !important;
            border-color: rgba(255,255,255,0.1) !important;
            color: #e8e8e8 !important;
        }
        body.dark h1, body.dark h2, body.dark h3, body.dark h4, body.dark h5 { color: #fff !important; }
        body.dark .text-muted { color: rgba(255,255,255,0.45) !important; }
        body.dark footer { background: #080808 !important; border-color: #1a1a1a !important; }
        body.dark .answer-btn { background: #1a1a1a !important; border-color: #2a2a2a !important; color: #ddd !important; }
        body.dark .answer-btn:hover { border-color: var(--gold) !important; background: #1e1a10 !important; }
        body.dark .job-card { background: #1a1a1a !important; border-color: #2a2a2a !important; }
        body.dark .table { color: #e8e8e8; }
        body.dark .table td, body.dark .table th { border-color: #2a2a2a; }

        /* ═══════════════════════════════════════════════════════════
            SCROLL PROGRESS BAR
        ═══════════════════════════════════════════════════════════ */
        #scroll-bar {
            position: fixed; top: 0; left: 0; height: 3px; width: 0;
            background: var(--gradient); z-index: 9999; pointer-events: none;
            transition: width 0.08s linear;
        }

        /* ═══════════════════════════════════════════════════════════
            FLOATING BUTTONS
        ═══════════════════════════════════════════════════════════ */
        .fab-btn {
            position: fixed; right: 22px; width: 46px; height: 46px;
            border-radius: 50%; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem; transition: 0.3s; z-index: 997;
        }
        #btn-dark { bottom: 82px; background: var(--gradient); color: #fff; box-shadow: 0 5px 20px rgba(243,156,18,0.35); }
        #btn-dark:hover { transform: scale(1.1) rotate(15deg); }
        #btn-top { bottom: 28px; background: #fff; border: 2px solid var(--gold); color: var(--gold); opacity: 0; transition: opacity 0.3s, transform 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        #btn-top.show { opacity: 1; }
        #btn-top:hover { background: var(--gold); color: #fff; transform: translateY(-3px); }
        body.dark #btn-top { background: #1a1a1a; }

        /* ═══════════════════════════════════════════════════════════
            NAVBAR
        ═══════════════════════════════════════════════════════════ */
        .navbar { padding: 18px 0; z-index: 1050; }
        .navbar.scrolled { padding: 10px 0; }
        .nav-glass {
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--radius);
            padding: 10px 25px;
            box-shadow: var(--shadow);
        }
        .navbar-logo { height: 75px; transition: 0.4s; }
        .navbar.scrolled .navbar-logo { height: 58px; }
        .nav-link {
            font-weight: 600; color: #6e6d6d !important;
            font-size: 0.78rem; text-transform: uppercase;
            letter-spacing: 0.8px; margin: 0 6px; padding: 6px 4px !important;
            position: relative; transition: color 0.2s;
        }
        .nav-link::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0; height: 2px; background: var(--gradient);
            border-radius: 10px; transition: width 0.3s;
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link:hover, .nav-link.active { color: var(--gold) !important; }
        .btn-nav-cta {
            background: var(--gradient); color: #fff !important;
            border-radius: 12px; padding: 10px 22px !important;
            font-weight: 800 !important; font-size: 0.8rem !important;
            text-transform: uppercase; letter-spacing: 1px;
            transition: 0.3s; margin-left: 8px;
        }
        .btn-nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(243,156,18,0.25); color: #fff !important; }
        .btn-nav-cta::after { display: none !important; }

        /* ═══════════════════════════════════════════════════════════
            GLOBAL UTILITIES
        ═══════════════════════════════════════════════════════════ */
        .text-gold { color: var(--gold) !important; }
        .bg-gold { background: var(--gradient) !important; }
        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-gold {
            background: var(--gradient); color: #fff; border: none;
            padding: 14px 35px; border-radius: 15px; font-weight: 800;
            font-size: 0.95rem; transition: 0.3s; cursor: pointer;
            text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-gold:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(243,156,18,0.25); color: #fff; }
        .btn-outline-gold {
            border: 2px solid var(--gold); color: var(--gold); background: transparent;
            padding: 13px 33px; border-radius: 15px; font-weight: 700;
            transition: 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-outline-gold:hover { background: var(--gradient); color: #fff; border-color: transparent; transform: translateY(-2px); }
        .section-badge {
            display: inline-block; padding: 7px 20px;
            background: rgba(243,156,18,0.1); color: var(--gold);
            border-radius: 50px; font-size: 0.72rem; font-weight: 800;
            text-transform: uppercase; letter-spacing: 2px; margin-bottom: 18px;
        }
        .section-title { font-weight: 800; letter-spacing: -0.5px; line-height: 1.2; }

        /* ═══════════════════════════════════════════════════════════
            FORMULAIRES
        ═══════════════════════════════════════════════════════════ */
        .form-control, .form-select {
            border: 2px solid #f0f0f0; border-radius: 14px;
            padding: 13px 18px; font-family: inherit;
            font-size: 0.92rem; transition: 0.25s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(243,156,18,0.08);
        }
        .form-label { font-weight: 700; font-size: 0.82rem; color: #555; margin-bottom: 8px; }
        .btn-submit {
            background: var(--gradient); color: #fff; border: none;
            padding: 16px; border-radius: 14px; font-weight: 800;
            font-size: 1rem; width: 100%; cursor: pointer;
            font-family: inherit; transition: 0.3s; letter-spacing: 0.5px;
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(243,156,18,0.25); }
        .invalid-feedback { font-weight: 600; font-size: 0.8rem; }

        /* ═══════════════════════════════════════════════════════════
            FLASH MESSAGES
        ═══════════════════════════════════════════════════════════ */
        .flash-toast {
            position: fixed; top: 100px; right: 28px; z-index: 5000;
            max-width: 400px; border-radius: 20px; padding: 20px 28px;
            font-weight: 700; font-size: 0.92rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
            animation: toastIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none; display: flex; align-items: center; gap: 14px;
        }
        .flash-toast.alert-success {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: #fff;
        }
        .flash-toast.alert-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
        }
        .flash-toast::before {
            content: ''; width: 10px; height: 10px;
            background: rgba(255,255,255,0.6); border-radius: 50%;
            flex-shrink: 0;
        }
        @keyframes toastIn {
            from { transform: translateX(120%) scale(0.8); opacity: 0; }
            to   { transform: translateX(0) scale(1); opacity: 1; }
        }

        /* ═══════════════════════════════════════════════════════════
            FOOTER
        ═══════════════════════════════════════════════════════════ */
        footer {
            background: #fafafa;
            border-top: 1px solid #f0f0f0;
            padding: 40px 0;
        }
        .footer-link { color: #888; text-decoration: none; font-size: 0.85rem; font-weight: 600; transition: 0.2s; }
        .footer-link:hover { color: var(--gold); }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>


<div id="scroll-bar"></div>


<?php if(session('success')): ?>
<div class="flash-toast alert alert-success" id="flash-msg">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="flash-toast alert alert-danger" id="flash-msg">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>


<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <div class="nav-glass d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
            <a class="navbar-brand p-0" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('assets/logo.png')); ?>" alt="TalentSync AI" class="navbar-logo">
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('a-propos') ? 'active' : ''); ?>" href="<?php echo e(route('a-propos')); ?>">À Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('valeurs') ? 'active' : ''); ?>" href="<?php echo e(route('valeurs')); ?>">Valeurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('argument') ? 'active' : ''); ?>" href="<?php echo e(route('argument')); ?>">Stratégie</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo e(request()->routeIs('partenaires*') ? 'active' : ''); ?>" href="#" data-bs-toggle="dropdown">
                            Partenaires
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm rounded-4 p-2">
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="<?php echo e(route('partenaires.index')); ?>">Hub Partenaires</a></li>
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="<?php echo e(route('partenaires.financier')); ?>">Partenariat Financier</a></li>
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="<?php echo e(route('partenaires.techniques')); ?>">Partenariat Technique</a></li>
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="<?php echo e(route('partenaires.sponsors')); ?>">Sponsors</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-gold py-2 px-4 <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>"
                           href="<?php echo e(route('contact')); ?>"
                           style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;font-weight:800;padding:8px 25px;border-radius:15px;border:none;text-decoration:none;font-size:0.85rem;">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<main style="padding-top: 90px;">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<footer>
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-4 text-center text-md-start">
                <img src="<?php echo e(asset('assets/logo.png')); ?>" alt="DevAfrica Arena" height="45">
            </div>
            <div class="col-md-4 text-center">
                <p class="mb-1 small fw-bold text-muted">© <?php echo e(date('Y')); ?> DevAfrica Arena — Lomé, Togo</p>
                <p class="mb-0" style="font-size:0.75rem;color:#aaa;">
                    Propulsé par <span class="text-gradient fw-bold">l'intelligence collective</span>
                </p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="d-flex gap-3 justify-content-center justify-content-md-end flex-wrap">
                    <a href="<?php echo e(route('home')); ?>" class="footer-link">Accueil</a>
                    <a href="<?php echo e(route('criteres')); ?>" class="footer-link">Candidater</a>
                    <a href="<?php echo e(route('contact')); ?>" class="footer-link">Contact</a>
                    <a href="https://wa.me/22871155055" target="_blank" class="footer-link"><i class="bi bi-whatsapp"></i></a>
                    <a href="<?php echo e(route('admin.login')); ?>" class="footer-link" title="Admin"><i class="bi bi-lock"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>


<button class="fab-btn" id="btn-dark" title="Mode sombre/clair" aria-label="Basculer le mode sombre">🌙</button>
<button class="fab-btn" id="btn-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Haut de page" aria-label="Retour en haut">
    <i class="bi bi-arrow-up"></i>
</button>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// AOS
AOS.init({ duration: 750, once: true, offset: 60 });

// NAVBAR SCROLL
window.addEventListener('scroll', () => {
    // Scroll bar
    const pct = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    document.getElementById('scroll-bar').style.width = pct + '%';
    // Navbar shrink
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 30);
    // Back-to-top
    document.getElementById('btn-top').classList.toggle('show', window.scrollY > 400);
});

// DARK MODE
const darkBtn = document.getElementById('btn-dark');
if (localStorage.getItem('tsync-dark') === '1') {
    document.body.classList.add('dark');
    if (darkBtn) darkBtn.textContent = '☀️';
}
if (darkBtn) darkBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    const on = document.body.classList.contains('dark');
    darkBtn.textContent = on ? '☀️' : '🌙';
    localStorage.setItem('tsync-dark', on ? '1' : '0');
});

// AUTO-DISMISS FLASH
setTimeout(() => {
    const f = document.getElementById('flash-msg');
    if (f) { f.style.transition = '0.5s'; f.style.opacity = '0'; setTimeout(() => f.remove(), 500); }
}, 5000);
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/layouts/app.blade.php ENDPATH**/ ?>