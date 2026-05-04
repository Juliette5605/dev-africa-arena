<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="DevAfricaArena — Championnat technologique bimestriel à Lomé, Togo. Transformez votre talent numérique en opportunité.">
    <meta name="author" content="Adjété Alex WILSON">
    <title>@yield('title', 'DevAfricaArena | L\'Arène des Talents Numériques')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animations -->
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
        #btn-top { bottom: 28px; background: #fff; border: 2px solid var(--gold); color: var(--gold); opacity: 0; transition: opacity 0.3s, transform 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        #btn-top.show { opacity: 1; }
        #btn-top:hover { background: var(--gold); color: #fff; transform: translateY(-3px); }

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
            font-weight: 600; color: #444 !important;
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

        /* ── BOUTON YIN-YANG NAVBAR ────────────────────────────── */
        /* ── BOUTON YIN-YANG COMPACT ───────────────────────────── */
        .btn-yinyang-inner {
            display: inline-flex;
            align-items: center;
            gap: 0;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 14px rgba(0,0,0,0.18);
            font-family: inherit;
            padding: 0;
        }
        .btn-yinyang-inner:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(243,156,18,0.28);
        }
        .yin-half {
            background: #1a1a1a;
            color: #f39c12;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 9px 14px;
        }
        .yang-half {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: #fff;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 9px 14px;
        }
        .yin-yang-sep {
            width: 2px;
            height: 36px;
            background: rgba(255,255,255,0.15);
            flex-shrink: 0;
        }

        /* ═══════════════════════════════════════════════════════════
           MODAL YIN-YANG
        ═══════════════════════════════════════════════════════════ */
        #authModal {
            display: none;
            position: fixed; inset: 0; z-index: 9998;
            align-items: center; justify-content: center;
        }
        #authModal.open { display: flex; }

        .auth-backdrop {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(8px);
            animation: fadeIn 0.25s ease;
        }

        .auth-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 460px;
            margin: 20px;
            background: #111;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 50px 100px rgba(0,0,0,0.7);
            animation: slideUp 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Bandeau yin-yang en haut */
        .auth-header {
            display: flex;
            height: 6px;
        }
        .auth-header .h-dark { flex: 1; background: #1a1a1a; }
        .auth-header .h-gold { flex: 1; background: var(--gradient); }

        .auth-body { padding: 36px 36px 28px; }

        /* Logo + titre */
        .auth-brand {
            text-align: center;
            margin-bottom: 28px;
        }
        .auth-brand-icon {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, #1a1a1a, #333);
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: #f39c12;
            margin-bottom: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }
        .auth-brand h2 {
            color: #fff; font-size: 1.3rem; font-weight: 800; margin: 0 0 4px;
        }
        .auth-brand p {
            color: rgba(255,255,255,0.45); font-size: 0.78rem; margin: 0;
        }

        /* Onglets */
        .auth-tabs {
            display: flex;
            background: rgba(255,255,255,0.05);
            border-radius: 14px;
            padding: 4px;
            margin-bottom: 26px;
            gap: 4px;
        }
        .auth-tab {
            flex: 1; text-align: center;
            padding: 10px 0;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            color: rgba(255,255,255,0.35);
            transition: 0.25s;
            border: none; background: transparent;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }
        .auth-tab.active-login {
            background: #1a1a1a;
            color: #f39c12;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }
        .auth-tab.active-register {
            background: var(--gradient);
            color: #fff;
            box-shadow: 0 4px 12px rgba(243,156,18,0.3);
        }

        /* Erreurs */
        .auth-error {
            background: rgba(220,53,69,0.12);
            border: 1px solid rgba(220,53,69,0.3);
            border-radius: 12px;
            padding: 12px 16px;
            color: #ffb8c0;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        /* Champs */
        .auth-group { margin-bottom: 14px; }
        .auth-label {
            display: block;
            font-size: 0.68rem;
            font-weight: 700;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .auth-input {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 12px 14px;
            color: #fff;
            font-family: inherit;
            font-size: 0.88rem;
            transition: 0.2s;
            outline: none;
        }
        .auth-input:focus { border-color: #f39c12; background: rgba(243,156,18,0.05); }
        .auth-input::placeholder { color: rgba(255,255,255,0.2); }

        .auth-row { display: flex; gap: 10px; }
        .auth-row .auth-group { flex: 1; }

        /* Bouton submit */
        .auth-btn {
            width: 100%;
            padding: 14px;
            border: none; border-radius: 13px;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 8px;
            transition: 0.3s;
        }
        .auth-btn-login {
            background: #1a1a1a;
            color: #f39c12;
            border: 1px solid rgba(243,156,18,0.3);
        }
        .auth-btn-login:hover { background: #222; box-shadow: 0 8px 20px rgba(0,0,0,0.4); transform: translateY(-2px); }
        .auth-btn-register {
            background: var(--gradient);
            color: #fff;
        }
        .auth-btn-register:hover { box-shadow: 0 8px 20px rgba(243,156,18,0.35); transform: translateY(-2px); }

        /* Switch bas */
        .auth-switch {
            text-align: center;
            margin-top: 18px;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.3);
        }
        .auth-switch button {
            background: none; border: none;
            color: #f39c12; font-weight: 700;
            cursor: pointer; font-family: inherit;
            font-size: inherit; padding: 0;
            text-decoration: underline;
        }

        /* Captcha */
        .captcha-box {
            background: rgba(243,156,18,0.06);
            border: 1px dashed rgba(243,156,18,0.25);
            padding: 10px 14px;
            border-radius: 10px;
            display: flex; align-items: center; gap: 10px;
        }
        .captcha-box span { font-size: 0.82rem; font-weight: 700; color: #f39c12; flex: 1; }
        .captcha-box input { width: 60px; text-align: center; flex-shrink: 0; }

        /* Fermer */
        .auth-close {
            position: absolute; top: 16px; right: 16px;
            width: 32px; height: 32px; border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: none; color: rgba(255,255,255,0.5);
            font-size: 1rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s; z-index: 2;
        }
        .auth-close:hover { background: rgba(255,255,255,0.15); color: #fff; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideUp {
            from { transform: translateY(40px) scale(0.95); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

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

    @stack('styles')
</head>
<body>

{{-- SCROLL PROGRESS --}}
<div id="scroll-bar"></div>

{{-- FLASH MESSAGES --}}
@if(session('success'))
<div class="flash-toast alert alert-success" id="flash-msg">
    {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="flash-toast alert alert-danger" id="flash-msg">
    {{ session('error') }}
</div>
@endif

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <div class="nav-glass d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
            <a class="navbar-brand p-0" href="{{ route('home') }}">
                <img src="{{ asset('assets/logoprincipal-removebg-preview.png') }}" alt="DevAfricaArena" class="navbar-logo">
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('a-propos') ? 'active' : '' }}" href="{{ route('a-propos') }}">À Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('valeurs') ? 'active' : '' }}" href="{{ route('valeurs') }}">Valeurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('argument') ? 'active' : '' }}" href="{{ route('argument') }}">Stratégie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('orientation') ? 'active' : '' }}" href="{{ route('orientation') }}">Orientation</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('partenaires*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            Partenaires
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm rounded-4 p-2">
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('partenaires.index') }}">Hub Partenaires</a></li>
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('partenaires.financier') }}">Partenariat Financier</a></li>
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('partenaires.techniques') }}">Partenariat Technique</a></li>
                            <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('partenaires.sponsors') }}">Sponsors</a></li>
                        </ul>
                    </li>

                    @auth
                        {{-- Utilisateur connecté --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('dashboard') || request()->routeIs('quiz.*') || request()->routeIs('forum.*') || request()->routeIs('vote.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                                Arena
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm rounded-4 p-2">
                                <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('dashboard') }}">
                                    <i class="bi bi-grid me-2 text-muted"></i>Mon Dashboard
                                </a></li>
                                <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('quiz.play') }}">
                                    <i class="bi bi-lightning me-2 text-muted"></i>Quiz Arena
                                </a></li>
                                <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('forum.index') }}">
                                    <i class="bi bi-chat-dots me-2 text-muted"></i>Forum Arena
                                </a></li>
                                <li><hr class="dropdown-divider mx-2 my-1"></li>
                                <li><a class="dropdown-item rounded-3 fw-semibold py-2" href="{{ route('vote.leaderboard') }}"
                                       style="color: #f39c12;">
                                    <i class="bi bi-trophy me-2"></i>Votes & Classement
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gold py-2 px-4" href="{{ route('contact') }}"
                               style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;font-weight:800;padding:8px 25px;border-radius:15px;border:none;text-decoration:none;font-size:0.85rem;">
                                Contact
                            </a>
                        </li>
                    @else
                        {{-- ── BOUTON YIN-YANG : UN SEUL BOUTON pour Connexion + Inscription ── --}}
                        <li class="nav-item ms-lg-2">
                            <button class="btn-yinyang-inner" onclick="openAuth('login')" title="Connexion / Inscription">
                                <span class="yin-half" onclick="openAuth('login')">Connex.</span>
                                <span class="yin-yang-sep"></span>
                                <span class="yang-half" onclick="openAuth('register')">Inscript.</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gold py-2 px-4" href="{{ route('contact') }}"
                               style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;font-weight:800;padding:8px 25px;border-radius:15px;border:none;text-decoration:none;font-size:0.85rem;">
                                Contact
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

{{-- ═══════════════════════════════════════════════════════════
     MODAL YIN-YANG CONNEXION / INSCRIPTION
═══════════════════════════════════════════════════════════ --}}
@guest
<div id="authModal" role="dialog" aria-modal="true" aria-label="Espace candidat">
    <div class="auth-backdrop" onclick="closeAuth()"></div>
    <div class="auth-card">

        {{-- Bandeau yin-yang --}}
        <div class="auth-header">
            <div class="h-dark"></div>
            <div class="h-gold"></div>
        </div>

        <button class="auth-close" onclick="closeAuth()" aria-label="Fermer">
            <i class="bi bi-x"></i>
        </button>

        <div class="auth-body">

            {{-- Brand --}}
            <div class="auth-brand">
                <div class="auth-brand-icon"><i class="bi bi-cpu-fill"></i></div>
                <h2>DevAfricaArena</h2>
                <p>Ton espace candidat personnel</p>
            </div>

            {{-- Erreurs Laravel --}}
            @if($errors->any())
            <div class="auth-error">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ $errors->first() }}
            </div>
            @endif

            {{-- Onglets --}}
            <div class="auth-tabs">
                <button class="auth-tab" id="tab-login" onclick="switchTab('login')">
                    <i class="bi bi-box-arrow-in-right"></i> Connexion
                </button>
                <button class="auth-tab" id="tab-register" onclick="switchTab('register')">
                    <i class="bi bi-person-plus"></i> Inscription
                </button>
            </div>

            {{-- FORMULAIRE CONNEXION --}}
            <form id="form-login" action="/login" method="POST" style="display:none;">
                @csrf
                <div class="auth-group">
                    <label class="auth-label">Email</label>
                    <input type="email" name="email" class="auth-input" placeholder="nom@exemple.com" required>
                </div>
                <div class="auth-group">
                    <label class="auth-label">Mot de passe</label>
                    <input type="password" name="password" class="auth-input" placeholder="••••••••" required>
                </div>
                <button type="submit" class="auth-btn auth-btn-login">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
                </button>
                <div class="auth-switch">
                    Pas encore de compte ?
                    <button type="button" onclick="switchTab('register')">Créer mon compte</button>
                </div>
            </form>

            {{-- FORMULAIRE INSCRIPTION --}}
            <form id="form-register" action="/register" method="POST" style="display:none;">
                @csrf
                <div class="auth-row">
                    <div class="auth-group">
                        <label class="auth-label">Prénom</label>
                        <input type="text" name="first_name" class="auth-input" placeholder="Jean" required>
                    </div>
                    <div class="auth-group">
                        <label class="auth-label">Nom</label>
                        <input type="text" name="last_name" class="auth-input" placeholder="Koffi" required>
                    </div>
                </div>
                <div class="auth-group">
                    <label class="auth-label">Date de naissance</label>
                    <input type="date" name="birthday" class="auth-input" required>
                </div>
                <div class="auth-group">
                    <label class="auth-label">Email professionnel</label>
                    <input type="email" name="email" class="auth-input" placeholder="nom@entreprise.com" required>
                </div>
                <div class="auth-group">
                    <label class="auth-label">Mot de passe</label>
                    <input type="password" id="reg-pass" name="password" class="auth-input" placeholder="8+ caractères" required>
                </div>
                <input type="hidden" name="password_confirmation" id="reg-pass-confirm">
                <div class="auth-group">
                    <label class="auth-label">Vérification humaine</label>
                    <div class="captcha-box">
                        <span>Combien font 5 + 3 ?</span>
                        <input type="text" id="captcha-answer" class="auth-input" placeholder="?" required>
                    </div>
                </div>
                <button type="submit" class="auth-btn auth-btn-register">
                    <i class="bi bi-person-check me-1"></i> Créer mon compte
                </button>
                <div class="auth-switch">
                    Déjà un compte ?
                    <button type="button" onclick="switchTab('login')">Me connecter</button>
                </div>
            </form>

        </div>{{-- /auth-body --}}
    </div>{{-- /auth-card --}}
</div>{{-- /authModal --}}
@endguest

{{-- PAGE CONTENT --}}
<main style="padding-top: 90px;">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer>
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-4 text-center text-md-start">
                <img src="{{ asset('assets/logoprincipal-removebg-preview.png') }}" alt="DevAfricaArena" height="45">
            </div>
            <div class="col-md-4 text-center">
                <p class="mb-1 small fw-bold text-muted">© {{ date('Y') }} DevAfricaArena — Lomé, Togo</p>
                <p class="mb-0" style="font-size:0.75rem;color:#aaa;">
                    Propulsé par <span class="text-gradient fw-bold">l'innovation africaine</span>
                </p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="d-flex gap-3 justify-content-center justify-content-md-end flex-wrap">
                    <a href="{{ route('home') }}" class="footer-link">Accueil</a>
                    <a href="{{ route('criteres') }}" class="footer-link">Candidater</a>
                    <a href="{{ route('contact') }}" class="footer-link">Contact</a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="footer-link">Dashboard</a>
                    @endauth
                    <a href="https://wa.me/22871155055" target="_blank" class="footer-link"><i class="bi bi-whatsapp"></i></a>
                    <a href="{{ route('admin.login') }}" class="footer-link" title="Admin"><i class="bi bi-lock"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- FLOATING BUTTONS --}}
<button class="fab-btn" id="btn-top" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="Haut de page" aria-label="Retour en haut">
    <i class="bi bi-arrow-up"></i>
</button>

{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// AOS
AOS.init({ duration: 750, once: true, offset: 60 });

// NAVBAR SCROLL
window.addEventListener('scroll', () => {
    const pct = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    document.getElementById('scroll-bar').style.width = pct + '%';
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 30);
    document.getElementById('btn-top').classList.toggle('show', window.scrollY > 400);
});

// AUTO-DISMISS FLASH
setTimeout(() => {
    const f = document.getElementById('flash-msg');
    if (f) { f.style.transition = '0.5s'; f.style.opacity = '0'; setTimeout(() => f.remove(), 500); }
}, 5000);

// ── MODAL YIN-YANG ─────────────────────────────────────────────────────
const modal = document.getElementById('authModal');

function openAuth(tab) {
    if (!modal) return;
    modal.classList.add('open');
    document.body.style.overflow = 'hidden';
    switchTab(tab || 'login');
}

function closeAuth() {
    if (!modal) return;
    modal.classList.remove('open');
    document.body.style.overflow = '';
}

// Fermer avec Echap
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeAuth(); });

function switchTab(tab) {
    const fLogin    = document.getElementById('form-login');
    const fRegister = document.getElementById('form-register');
    const tLogin    = document.getElementById('tab-login');
    const tRegister = document.getElementById('tab-register');
    if (!fLogin || !fRegister) return;

    if (tab === 'register') {
        fLogin.style.display    = 'none';
        fRegister.style.display = 'block';
        tLogin.classList.remove('active-login');
        tRegister.classList.add('active-register');
    } else {
        fLogin.style.display    = 'block';
        fRegister.style.display = 'none';
        tLogin.classList.add('active-login');
        tRegister.classList.remove('active-register');
    }
}

// Gestion formulaire inscription
const fReg = document.getElementById('form-register');
if (fReg) {
    fReg.addEventListener('submit', function(e) {
        // Sync confirmation mot de passe
        document.getElementById('reg-pass-confirm').value = document.getElementById('reg-pass').value;
        // Vérif captcha
        if (document.getElementById('captcha-answer').value !== '8') {
            e.preventDefault();
            alert('Erreur de vérification : répondez correctement à la question.');
            return false;
        }
    });
}

// CSRF refresh avant soumission
const csrfRefreshUrl = '{{ route("csrf.refresh") }}';
async function refreshCsrf() {
    const r = await fetch(csrfRefreshUrl, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
    const d = await r.json();
    document.querySelectorAll('input[name="_token"]').forEach(i => i.value = d.token);
}
['form-login','form-register'].forEach(id => {
    const f = document.getElementById(id);
    if (!f) return;
    f.addEventListener('submit', async function(e) {
        if (f.dataset.sub === '1') return;
        e.preventDefault();
        f.dataset.sub = '1';
        try { await refreshCsrf(); f.submit(); }
        catch { f.dataset.sub = '0'; window.location.reload(); }
    }, true);
});

// Ouvrir automatiquement si erreurs Laravel (retour après form invalide)
@if($errors->any())
document.addEventListener('DOMContentLoaded', () => openAuth('{{ session("authMode", "login") }}'));
@endif
</script>

@stack('scripts')
@include('partials.chatbot')
</body>
</html>