@extends('layouts.app')
@section('title', 'DevAfricaArena | Home')

@push('styles')
<style>
/* ─── HERO ─────────────────────────────────────────────── */
.hero {
    height: 100vh; display: flex; align-items: center; position: relative;
    background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f8f9fa 100%);
    overflow: hidden;
}
#snow-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; }
.header-img-wrapper { position: relative; animation: float 6s ease-in-out infinite; }
.header-square-img {
    width: 100%; aspect-ratio: 1 / 1; object-fit: cover;
    border-radius: 30px; border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}
.img-decoration {
    position: absolute; top: 15px; right: -15px; width: 100%; height: 100%;
    border: 2px solid #f39c12; border-radius: 30px; z-index: -1; opacity: 0.3;
}
@keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }

/* ─── ORIENTATION HUB + QUIZ ────────────────────────────── */
.orientation-hub { padding: 100px 0; background: #fdfdfd; position: relative; overflow: hidden; }
.transition-all { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.field-card-mini { border: 1px solid #eee; cursor: pointer; }
.field-wrapper.dimmed { opacity: 0.2; transform: scale(0.85); filter: blur(1px); }
.field-wrapper.highlight { border: 2px solid var(--brand-gold, #f39c12) !important; background: #fffdf5; transform: scale(1.1); box-shadow: 0 10px 20px rgba(243,156,18,0.2); }
.field-wrapper.highlight i { color: #f39c12; }
.answer-option {
    display: block; width: 100%; padding: 16px 22px; margin-bottom: 12px;
    border: 2px solid #f8f8f8; border-radius: 15px; background: #fff;
    text-align: left; font-weight: 600; transition: 0.3s; font-family: inherit; cursor: pointer;
}
.answer-option:hover { transform: translateX(10px); border-color: #f39c12; color: #f39c12; }
.answer-option.selected { background: #f39c12; color: white; border-color: #f39c12; }
.quiz-box { background: #ffffff; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.07); border: 1px solid #f0f0f0; position: relative; }
.roadmap-badge { display: inline-block; padding: 5px 15px; background: #fff3e0; border-radius: 8px; font-weight: 700; font-size: 0.8rem; margin-bottom: 15px; }
.text-gradient { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

/* ─── COUNTDOWN ─────────────────────────────────────────── */
.countdown-section { background: linear-gradient(135deg, #111, #1a1a1a); padding: 70px 0; }
.cd-unit { min-width: 88px; text-align: center; background: rgba(255,255,255,0.04); border: 1px solid rgba(243,156,18,0.12); border-radius: 18px; padding: 18px 10px; }
.cd-num { display: block; font-size: clamp(2rem,5vw,3.2rem); font-weight: 800; color: #f39c12; line-height: 1; }
.cd-lbl { display: block; font-size: 0.62rem; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.35); margin-top: 6px; }
.cd-sep { font-size: 2.5rem; font-weight: 800; color: rgba(243,156,18,0.25); padding: 0 6px; align-self: flex-start; margin-top: 12px; }

/* ─── JOBS ──────────────────────────────────────────────── */
.jobs-section {
    padding: 90px 0;
    background: #ffffff;
    position: relative;
    z-index: 2;
}

/* Compteur d'offres */
.jobs-count-pill {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: #111;
    color: #f39c12;
    font-size: 0.75rem;
    font-weight: 800;
    padding: 6px 16px;
    border-radius: 50px;
    letter-spacing: 0.5px;
}

/* Zone de scroll : hauteur fixe, déborde en interne */
.jobs-scroll-wrapper {
    position: relative;
    border-radius: 24px;
    border: 1.5px solid rgba(243,156,18,0.15);
    background: #fafafa;
    overflow: hidden;
}

/* Fade dégradé en bas — indique qu'il y a du contenu en dessous */
.jobs-scroll-wrapper::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 70px;
    background: linear-gradient(to top, #fafafa, transparent);
    pointer-events: none;
    z-index: 4;
    border-radius: 0 0 22px 22px;
}

/* Le conteneur qui scroll réellement */
.jobs-scroll-inner {
    max-height: 540px;
    overflow-y: auto;
    padding: 22px 22px 40px 22px;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}

/* Scrollbar fine dorée */
.jobs-scroll-inner::-webkit-scrollbar        { width: 4px; }
.jobs-scroll-inner::-webkit-scrollbar-track  { background: transparent; }
.jobs-scroll-inner::-webkit-scrollbar-thumb  { background: linear-gradient(180deg, #f39c12, #e67e22); border-radius: 4px; }

/* Pastille "scroll" discrète */
.jobs-scroll-hint {
    position: absolute;
    bottom: 12px;
    right: 16px;
    z-index: 5;
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.65rem;
    font-weight: 700;
    color: #bbb;
    pointer-events: none;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.jobs-scroll-hint i { color: #f39c12; animation: bounce-down 1.4s ease infinite; }
@keyframes bounce-down {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(4px); }
}

/* Carte job */
.job-card {
    background: #fff;
    border-radius: 18px;
    border: 1.5px solid rgba(0,0,0,0.06);
    padding: 20px 22px;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
}

/* Trait doré gauche au hover */
.job-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #f39c12, #e67e22);
    border-radius: 18px 0 0 18px;
    opacity: 0;
    transition: opacity 0.25s ease;
}
.job-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(243,156,18,0.13); border-color: rgba(243,156,18,0.35); }
.job-card:hover::before { opacity: 1; }

.job-card-tag {
    display: inline-block;
    font-size: 0.65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    background: #fff3e0;
    color: #e67e22;
    padding: 3px 10px;
    border-radius: 6px;
    margin-bottom: 10px;
}

.job-card h5 {
    font-size: 0.98rem;
    font-weight: 700;
    color: #111;
    line-height: 1.35;
    margin-bottom: 6px;
}

.job-card .job-company {
    font-size: 0.8rem;
    color: #999;
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 0;
}
.job-card .job-company i { color: #f39c12; font-size: 0.75rem; }

.job-card-footer {
    margin-top: auto;
    padding-top: 14px;
    border-top: 1px solid #f3f3f3;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Point live vert */
.job-live-dot {
    width: 7px; height: 7px;
    background: #22c55e;
    border-radius: 50%;
    display: inline-block;
    animation: pulse-live 1.8s ease infinite;
}
@keyframes pulse-live {
    0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.45); }
    50%       { box-shadow: 0 0 0 5px rgba(34,197,94,0); }
}

/* Bouton "Voir" sur la carte */
.btn-job-view {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: #fff !important;
    font-size: 0.78rem;
    font-weight: 800;
    padding: 7px 16px;
    border-radius: 50px;
    text-decoration: none !important;
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
}
.btn-job-view:hover { transform: scale(1.06); box-shadow: 0 6px 18px rgba(243,156,18,0.38); color:#fff !important; }

/* Animation d'entrée sur les nouvelles cartes */
@keyframes cardSlideIn {
    from { opacity: 0; transform: translateY(18px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0)    scale(1); }
}
.job-card-enter { animation: cardSlideIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) both; }

/* Bouton Voir plus */
.btn-see-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: #fff;
    border: none;
    padding: 13px 34px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 0.9rem;
    font-family: inherit;
    cursor: pointer;
    transition: transform 0.25s, box-shadow 0.25s;
    position: relative;
    overflow: hidden;
}
.btn-see-more:hover   { transform: translateY(-3px); box-shadow: 0 14px 32px rgba(243,156,18,0.38); color:#fff; }
.btn-see-more:active  { transform: translateY(0); }
.btn-see-more:disabled { opacity: 0.55; cursor: not-allowed; transform: none; box-shadow: none; }

.btn-see-more .remaining-badge {
    background: rgba(255,255,255,0.22);
    padding: 2px 9px;
    border-radius: 50px;
    font-size: 0.78rem;
}

/* ─── NEWSLETTER ────────────────────────────────────────── */
.newsletter-section { padding: 80px 0; background: #f8f9fa; }
.nl-input { flex: 1; min-width: 0; border: 2px solid #eee; border-radius: 14px; padding: 14px 20px; font-family: inherit; font-size: 0.95rem; transition: 0.25s; }
.nl-input:focus { border-color: #f39c12; outline: none; box-shadow: 0 0 0 4px rgba(243,156,18,0.08); }
.nl-btn { background: linear-gradient(135deg,#f39c12,#e67e22); color: #fff; border: none; padding: 14px 28px; border-radius: 14px; font-weight: 800; cursor: pointer; font-family: inherit; white-space: nowrap; transition: 0.3s; }
.nl-btn:hover { transform: scale(1.03); box-shadow: 0 8px 20px rgba(243,156,18,0.25); }

/* ─── PARTNERS ──────────────────────────────────────────── */
.partners-bar { background: #ffffff; padding: 60px 0 100px 0; border-top: 1px solid #f0f0f0; position: relative; z-index: 2; }
.partner-label { font-size: 0.7rem; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px; display: block; }
.partner-logo-single { max-height: 70px; width: auto; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.08)); }
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<header class="hero">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-800 mb-4" style="color: #111; font-weight: 800;">
                    Propulser l'<span class="text-gradient">Afrique</span> par le numérique
                </h1>
                <p class="lead text-muted mb-5">
                    DevAfricaArena est le catalyseur de talents qui façonne les architectes technologiques de demain.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('criteres') }}" class="btn btn-gold" style="background: linear-gradient(135deg,#f39c12,#e67e22); color:#fff; font-weight:800; padding:15px 35px; border-radius:15px; border:none; transition:0.3s; text-decoration:none;">
                        Critères de Participation
                    </a>
                    <a href="{{ route('a-propos') }}" class="btn btn-outline-dark" style="border-radius:15px; padding:15px 35px; font-weight:700;">
                        Découvrir
                    </a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-none d-lg-block" data-aos="fade-left">
                <div class="header-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800"
                         alt="Innovation" class="header-square-img">
                    <div class="img-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</header>


{{-- ═══ ORIENTATION HUB + QUIZ ═══ --}}
<section class="orientation-hub" id="orientation">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-3 rounded-pill mb-2">ORIENTATION LIVE</span>
            <h2 class="fw-800 display-6">L'Arène des Talents</h2>
            <p class="text-muted">Réponds vite ! Le système analyse tes réflexes numériques.</p>
        </div>

        <div class="row g-4 mb-5" id="fields-grid">
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-dev">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-code-slash d-block h3 mb-2"></i>
                    <span class="small fw-bold">Web/Mobile</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-ia">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-cpu d-block h3 mb-2"></i>
                    <span class="small fw-bold">IA & Data</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-design">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-palette d-block h3 mb-2"></i>
                    <span class="small fw-bold">Design UX</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-com">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-megaphone d-block h3 mb-2"></i>
                    <span class="small fw-bold">Marketing</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-cyber">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-shield-lock d-block h3 mb-2"></i>
                    <span class="small fw-bold">Cyber</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-fab">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-tools d-block h3 mb-2"></i>
                    <span class="small fw-bold">IoT/Maker</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="quiz-box shadow-lg rounded-5 bg-white border-0">
                    <div id="timer-bar" style="display:none;"></div>
                    <div class="p-4 p-md-5">
                        <div id="quiz-ui">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="fw-bold mb-0 text-uppercase" style="letter-spacing:1px;" id="q-counter">Question 1/7</h6>
                                <div class="spinner-grow spinner-grow-sm text-warning" role="status"></div>
                            </div>
                            <h3 id="q-text" class="fw-800 mb-4" style="min-height: 80px; font-weight:800;">Préparation de l'analyse...</h3>
                            <div id="q-answers" class="d-grid gap-2"></div>
                        </div>
                        <div id="quiz-result" class="text-center py-4" style="display:none;">
                            <div class="roadmap-badge text-warning mb-3">RÉSULTAT ANALYSÉ</div>
                            <h2 id="res-profile" class="fw-800 text-gradient mb-3" style="font-weight:800;"></h2>
                            <p id="res-desc" class="text-muted mb-4"></p>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <a href="{{ route('criteres') }}" style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;padding:12px 28px;border-radius:50px;font-weight:800;text-decoration:none;">
                                    Rejoindre l'Arena →
                                </a>
                                <button onclick="resetQuiz()" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">
                                    Redémarrer l'analyse
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══ OFFRES D'EMPLOI ═══ --}}
<section class="jobs-section">
    <div class="container">

        {{-- En-tête --}}
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
            <div data-aos="fade-right">
                <span class="badge bg-warning text-dark px-3 rounded-pill mb-2">OPPORTUNITÉS</span>
                <h2 class="fw-800 mb-1" style="font-size: 2.2rem; font-weight: 800;">Postes à pourvoir</h2>
                <p class="text-muted mb-0">Découvrez les offres qui correspondent à votre profil</p>
            </div>
            <div data-aos="fade-left">
                <span class="jobs-count-pill">
                    <i class="bi bi-briefcase-fill"></i>
                    <span id="jobs-shown-count">{{ min(6, count($opportunities)) }}</span> / {{ count($opportunities) }} offres
                </span>
            </div>
        </div>

        {{-- Wrapper scroll --}}
        <div class="jobs-scroll-wrapper" data-aos="fade-up">

            {{-- Pastille "scroll" en bas à droite --}}
            <div class="jobs-scroll-hint">
                <i class="bi bi-chevron-double-down"></i> scroll
            </div>

            <div class="jobs-scroll-inner" id="jobs-scroll-inner">
                <div class="row g-3" id="jobs-grid">
                    @foreach(array_slice($opportunities, 0, 6) as $i => $opportunity)
                    <div class="col-md-6 col-lg-4" style="animation: cardSlideIn 0.4s {{ $i * 0.07 }}s both;">
                        <div class="job-card">
                            <span class="job-card-tag">Tech</span>
                            <h5>{{ $opportunity['name'] ?? $opportunity['title'] ?? 'Offre Tech' }}</h5>
                            <p class="job-company">
                                <i class="bi bi-building"></i>
                                {{ $opportunity['company']['name'] ?? $opportunity['company_name'] ?? 'Entreprise' }}
                            </p>
                            <div class="job-card-footer">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="job-live-dot"></span>
                                    <span style="font-size:0.7rem; color:#bbb; font-weight:700;">En ligne</span>
                                </div>
                                <a href="{{ $opportunity['refs']['landing_page'] ?? $opportunity['url'] ?? '#' }}"
                                   target="_blank"
                                   class="btn-job-view">
                                    Voir <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bouton voir plus --}}
        @if(count($opportunities) > 6)
        <div class="text-center mt-4" data-aos="fade-up">
            <button id="see-more-btn" class="btn-see-more">
                <i class="bi bi-plus-circle-fill"></i>
                Voir plus d'offres
                <span class="remaining-badge" id="remaining-badge">+{{ count($opportunities) - 6 }}</span>
            </button>
        </div>
        @endif

    </div>
</section>


{{-- ═══ NEWSLETTER ═══ --}}
<section class="newsletter-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4" data-aos="fade-up">
                    <span class="badge bg-warning text-dark px-3 rounded-pill mb-2">NEWSLETTER</span>
                    <h3 class="fw-800 mb-2" style="font-weight:800;">Restez dans la course Arena</h3>
                    <p class="text-muted">Dates des éditions, ouvertures d'inscriptions et résultats en avant-première.</p>
                </div>
                @if(session('newsletter_success'))
                    <div class="alert rounded-4 fw-bold border-0 p-4 text-center" style="background:rgba(22,163,74,0.08);color:#16a34a;">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('newsletter_success') }}
                    </div>
                @elseif(session('newsletter_info'))
                    <div class="alert rounded-4 fw-bold border-0 p-4 text-center" style="background:rgba(243,156,18,0.08);color:#f39c12;">
                        <i class="bi bi-info-circle-fill me-2"></i>{{ session('newsletter_info') }}
                    </div>
                @else
                <form action="{{ route('newsletter.store') }}" method="POST" data-aos="fade-up">
                    @csrf
                    <div class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                        <input type="email" name="email" class="nl-input" placeholder="Votre adresse email *" required value="{{ old('email') }}">
                        <button type="submit" class="nl-btn">S'abonner</button>
                    </div>
                    <p class="text-muted small mt-2 text-center"><i class="bi bi-shield-check me-1"></i>Zéro spam. Désinscription en 1 clic.</p>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>


{{-- ═══ PARTENAIRE OFFICIEL ═══ --}}
<section class="partners-bar text-center">
    <div class="container" data-aos="fade-up">
        <span class="partner-label">Notre Partenaire Officiel</span>
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('assets/logo_saei.png') }}" alt="SAEI CUBE" class="partner-logo-single">
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// ─── SNOW CANVAS ───────────────────────────────────────────────
const canvas = document.getElementById('snow-canvas');
const ctx = canvas.getContext('2d');
let particles = [];
function initSnow() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    particles = [];
    for (let i = 0; i < 60; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 2 + 1,
            speed: Math.random() * 0.5 + 0.2,
            opacity: Math.random() * 0.3 + 0.1
        });
    }
}
function animateSnow() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
        ctx.fillStyle = `rgba(180,180,180,${p.opacity})`;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
        ctx.fill();
        p.y += p.speed;
        if (p.y > canvas.height) p.y = -10;
    });
    requestAnimationFrame(animateSnow);
}
initSnow();
animateSnow();
window.addEventListener('resize', initSnow);


// ─── QUIZ ──────────────────────────────────────────────────────
const quizData = [
    { q: "Face à une page blanche, tu as envie de...", a: [{ t: "Taper des lignes de commandes", v: "dev" }, { t: "Tracer des courbes et des couleurs", v: "design" }, { t: "Analyser des colonnes de chiffres", v: "ia" }] },
    { q: "Quel super-pouvoir numérique préfères-tu ?", a: [{ t: "Rendre un site ultra rapide", v: "dev" }, { t: "Prédire l'avenir avec les données", v: "ia" }, { t: "Convaincre des milliers de gens", v: "com" }] },
    { q: "Ton objet fétiche sur ton bureau ?", a: [{ t: "Un clavier mécanique", v: "dev" }, { t: "Une tablette graphique", v: "design" }, { t: "Un routeur ou un fer à souder", v: "fab" }] },
    { q: "Le danger qui te fait le plus peur ?", a: [{ t: "Une panne logicielle totale", v: "dev" }, { t: "Une fuite de données massive", v: "cyber" }, { t: "Une IA incontrôlable", v: "ia" }] },
    { q: "En équipe, tu es celui qui...", a: [{ t: "Structure le projet", v: "dev" }, { t: "Vend le concept aux clients", v: "com" }, { t: "Protège les accès", v: "cyber" }] },
    { q: "Quelle technologie t'excite le plus ?", a: [{ t: "Le Cloud et les API", v: "dev" }, { t: "La Robotique connectée", v: "fab" }, { t: "La Réalité Augmentée", v: "design" }] },
    { q: "Dernière chance : Ton instinct te dit ?", a: [{ t: "Créer", v: "dev" }, { t: "Sécuriser", v: "cyber" }, { t: "Connecter", v: "fab" }] }
];

let currentQ = 0;
let scores = { dev: 0, ia: 0, design: 0, com: 0, cyber: 0, fab: 0 };
let timerInterval;

function startTimer() {
    clearInterval(timerInterval);
}

function loadQuestion() {
    const q = quizData[currentQ];
    document.getElementById("q-counter").innerText = `Analyse ${currentQ + 1}/7`;
    document.getElementById("q-text").innerText = q.q;
    let html = "";
    q.a.forEach(ans => {
        html += `<button class="answer-option" onclick="processAnswer('${ans.v}')">${ans.t}</button>`;
    });
    document.getElementById("q-answers").innerHTML = html;
    startTimer();
}

function processAnswer(val) {
    clearInterval(timerInterval);
    scores[val]++;
    highlightField(val);
    currentQ++;
    if (currentQ < quizData.length) {
        setTimeout(loadQuestion, 400);
    } else {
        setTimeout(showResult, 600);
    }
}

function highlightField(val) {
    document.querySelectorAll('.field-wrapper').forEach(w => {
        w.classList.add('dimmed');
        w.classList.remove('highlight');
        if (w.id === `field-${val}`) {
            w.classList.remove('dimmed');
            w.classList.add('highlight');
        }
    });
}

function showResult() {
    document.getElementById("timer-bar").style.display = "none";
    document.getElementById("quiz-ui").style.display = "none";
    document.getElementById("quiz-result").style.display = "block";
    let winner = Object.keys(scores).reduce((a, b) => scores[a] > scores[b] ? a : b);
    const map = {
        dev: "Architecte Web & Mobile", ia: "Ingénieur IA", design: "Creative Designer",
        com: "Growth Marketer", cyber: "Gardien Cybersécurité", fab: "Ingénieur IoT"
    };
    document.getElementById("res-profile").innerText = map[winner];
    document.getElementById("res-desc").innerText = "Le scan est terminé. Ton ADN numérique correspond à 98% au profil de " + map[winner] + ". Prêt à rejoindre l'Arena ?";
    highlightField(winner);
}

function resetQuiz() {
    currentQ = 0;
    scores = { dev: 0, ia: 0, design: 0, com: 0, cyber: 0, fab: 0 };
    document.getElementById("quiz-result").style.display = "none";
    document.getElementById("quiz-ui").style.display = "block";
    document.getElementById("timer-bar").style.display = "block";
    document.getElementById("timer-bar").style.width = "0%";
    document.querySelectorAll('.field-wrapper').forEach(w => w.classList.remove('dimmed', 'highlight'));
    loadQuestion();
}

loadQuestion();


// ─── JOBS : VOIR PLUS ──────────────────────────────────────────
(function () {
    const allJobs    = @json($opportunities);
    const totalJobs  = allJobs.length;
    let   shown      = Math.min(6, totalJobs);
    const BATCH      = 3;

    const seeMoreBtn     = document.getElementById('see-more-btn');
    const remainingBadge = document.getElementById('remaining-badge');
    const shownCount     = document.getElementById('jobs-shown-count');
    const grid           = document.getElementById('jobs-grid');
    const scrollInner    = document.getElementById('jobs-scroll-inner');

    if (!seeMoreBtn) return;

    // Masquer le bouton si tout est déjà affiché
    if (shown >= totalJobs) {
        seeMoreBtn.style.display = 'none';
    }

    seeMoreBtn.addEventListener('click', function () {

        // État chargement
        seeMoreBtn.disabled = true;
        seeMoreBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status"></span> Chargement...`;

        setTimeout(function () {

            const batch = allJobs.slice(shown, shown + BATCH);

            batch.forEach(function (job, idx) {

                const title   = job.name   || job.title          || 'Offre Tech';
                const company = (job.company && job.company.name) || job.company_name || 'Entreprise';
                const url     = (job.refs   && job.refs.landing_page) || job.url || '#';

                const col = document.createElement('div');
                col.className = 'col-md-6 col-lg-4';

                col.innerHTML = `
                    <div class="job-card job-card-enter" style="animation-delay:${idx * 0.08}s;">
                        <span class="job-card-tag">Tech</span>
                        <h5>${title}</h5>
                        <p class="job-company">
                            <i class="bi bi-building"></i> ${company}
                        </p>
                        <div class="job-card-footer">
                            <div class="d-flex align-items-center gap-2">
                                <span class="job-live-dot"></span>
                                <span style="font-size:0.7rem;color:#bbb;font-weight:700;">En ligne</span>
                            </div>
                            <a href="${url}" target="_blank" class="btn-job-view">
                                Voir <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                `;

                grid.appendChild(col);
            });

            shown += batch.length;

            // Mettre à jour le compteur
            if (shownCount) shownCount.textContent = shown;

            // Scroll fluide vers les nouvelles cartes
            setTimeout(function () {
                scrollInner.scrollTo({ top: scrollInner.scrollHeight, behavior: 'smooth' });
            }, 80);

            const remaining = totalJobs - shown;

            if (shown >= totalJobs) {
                seeMoreBtn.style.display = 'none';
            } else {
                seeMoreBtn.disabled = false;
                seeMoreBtn.innerHTML = `
                    <i class="bi bi-plus-circle-fill"></i>
                    Voir plus d'offres
                    <span class="remaining-badge">+${remaining}</span>
                `;
            }

        }, 320);
    });
})();
</script>
@endpush