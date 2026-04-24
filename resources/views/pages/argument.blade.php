@extends('layouts.app')

@section('title', 'Stratégie Tech | DevAfricaArena')

@push('styles')
<style>
    /* Intégration du gradient sans modifier la structure CSS existante */
    .text-gradient {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .hero { padding:200px 0 100px;text-align:center;background:radial-gradient(circle at 10% 20%,rgba(243,156,18,0.05) 0%,transparent 50%); }
    .main-card { background:#fff;border-radius:40px;padding:60px;margin-top:-60px;box-shadow:0 20px 50px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.02);position:relative;z-index:2; }
    .manifesto-quote { font-size:1.85rem;font-weight:700;border-left:6px solid #f39c12;padding-left:30px;margin-bottom:60px; }
    .data-item { text-align:center;padding:30px;background:#f8f9fa;border-radius:20px;border-bottom:3px solid #f39c12;transition:0.3s; }
    .data-value { font-size:2.5rem;font-weight:800; }
    .data-label { font-size:0.7rem;text-transform:uppercase;letter-spacing:1px;color:#f39c12;font-weight:700; }
    .f-card { background:#fcfcfc;padding:40px;border-radius:25px;border:1px solid #f0f0f0;transition:0.4s;height:100%; }
    .f-card:hover { transform:translateY(-10px);border-color:#f39c12; }
    .f-icon { font-size:2rem;color:#f39c12;margin-bottom:20px; }
    .table thead th { border-bottom:2px solid #f39c12;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;padding:20px; }
    .table td { padding:20px;vertical-align:middle; }
    .highlight-col { background:rgba(243,156,18,0.03);color:#f39c12;font-weight:700; }
    @media(max-width:991px){ .main-card{padding:30px;} .manifesto-quote{font-size:1.4rem;} }
</style>
@endpush

@section('content')
<header class="hero">
    <div class="container" data-aos="fade-up">
        <h1 class="display-4 fw-bold" style="font-weight:800;">Le Code est l'Actif <span class="text-gradient">Stratégique</span></h1>
        <p class="lead text-muted mx-auto mt-4" style="max-width:850px;">
            La valeur d'une startup ne réside pas dans sa promesse visuelle, mais dans la solidité de sa propriété intellectuelle (IP). Vendez l'actif, pas le mirage.
        </p>
    </div>
</header>

<main class="container">
    <div class="main-card" data-aos="fade-up">
        <div class="manifesto-quote">
            "Le prototype est une image éphémère. Le code source brut est un actif tangible, auditable et capitalisable au bilan de l'entreprise."
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="data-item">
                    <div class="data-value text-gradient">+35%</div>
                    <div class="data-label">Valorisation Pre-Seed</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="data-item">
                    <div class="data-value text-gradient">-60%</div>
                    <div class="data-label">Dette Technique</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="data-item">
                    <div class="data-value text-gradient">100%</div>
                    <div class="data-label">Souveraineté IP</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4">
                <div class="f-card">
                    <i class="bi bi-shield-lock f-icon"></i>
                    <h3>Souveraineté IP</h3>
                    <p class="text-muted">Garantissez la pleine propriété de votre technologie face aux investisseurs grâce à un code source auditable.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="f-card">
                    <i class="bi bi-rocket-takeoff f-icon"></i>
                    <h3>Scalabilité Réelle</h3>
                    <p class="text-muted">Évitez l'effondrement post-financement. Nous construisons des architectures capables de supporter une croissance immédiate.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="f-card">
                    <i class="bi bi-currency-exchange f-icon"></i>
                    <h3>Valorisation VC</h3>
                    <p class="text-muted">Un actif technique propre rassure les fonds d'investissement et réduit les risques lors de la Due Diligence.</p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="fw-bold text-center mb-4">Vendre la Substance Technologique</h2>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Critère Stratégique</th>
                            <th>Approche Hackathon</th>
                            <th>Approche DevAfricaArena (Actif)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Nature de l'Actif</td>
                            <td>Dépense Marketing</td>
                            <td class="highlight-col">Capital Intellectuel (Asset)</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Fiabilité Tech</td>
                            <td>Dépendance IA/No-Code</td>
                            <td class="highlight-col">Ingénierie de Production</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Due Diligence</td>
                            <td>Visuel / Émotionnel</td>
                            <td class="highlight-col">Audit de Code / Sécurité</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ═══ SECTION AUDIT ═══ --}}
        <div class="row justify-content-center mt-5 pt-4" data-aos="fade-up">
            <div class="col-lg-8">
                <div class="text-center p-5 rounded-4" style="background: linear-gradient(135deg, #111 0%, #1a1a1a 100%); border: 1px solid rgba(243,156,18,0.2);">
                    <span class="badge mb-3 px-3 py-2 rounded-pill fw-bold" style="background:rgba(243,156,18,0.15);color:#f39c12;font-size:0.75rem;letter-spacing:1px;">
                        DIAGNOSTIC GRATUIT
                    </span>
                    <h3 class="fw-bold text-white mb-3">Auditez votre projet tech</h3>
                    <p class="mb-4" style="color:rgba(255,255,255,0.55); max-width:480px; margin:0 auto 24px;">
                        Vous avez un projet en cours ? Nos experts évaluent la solidité technique, la sécurité et la valeur de votre code source.
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <a href="{{ route('contact') }}"
                           class="btn fw-bold px-5 py-3"
                           style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;border-radius:50px;font-size:1rem;text-decoration:none;transition:0.3s;"
                           onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
                             Demander un Audit
                        </a>
                        <a href="{{ route('criteres') }}"
                           class="btn fw-bold px-5 py-3"
                           style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,0.2);border-radius:50px;font-size:1rem;text-decoration:none;transition:0.3s;"
                           onmouseover="this.style.borderColor='#f39c12';this.style.color='#f39c12'" onmouseout="this.style.borderColor='rgba(255,255,255,0.2)';this.style.color='#fff'">
                            Candidater à l'Arena
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
