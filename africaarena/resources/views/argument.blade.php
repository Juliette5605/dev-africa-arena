<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stratégie Tech | DevAfrica Arena</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #222222;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            --glass-bg: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(0, 0, 0, 0.08);
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: var(--brand-dark);
            overflow-x: hidden;
        }

        /* --- NAVBAR HARMONISÉE --- */
        .navbar { padding: 20px 0; transition: all 0.5s ease; background: transparent; z-index: 1050; }
        .navbar.scrolled { padding: 12px 0; }

        .nav-container {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 10px 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .navbar-logo { height: 60px; transition: 0.4s; }
        .navbar.scrolled .navbar-logo { height: 45px; }

        .nav-link {
            font-weight: 600;
            color: #444 !important;
            margin: 0 10px;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }
        .nav-link:hover, .nav-link.active { color: var(--brand-gold) !important; }

        .btn-gold {
            background: var(--accent-gradient);
            color: #fff !important;
            font-weight: 800;
            padding: 10px 25px;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-gold:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(243, 156, 18, 0.2); }

        /* --- HERO --- */
        .hero {
            padding: 200px 0 100px;
            text-align: center;
            background: radial-gradient(circle at 10% 20%, rgba(243, 156, 18, 0.05) 0%, transparent 50%);
        }
        h1 { font-weight: 800; letter-spacing: -1px; }
        .text-gradient { 
            background: var(--accent-gradient); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
        }

        /* --- CONTENT CARDS --- */
        .main-card {
            background: #ffffff;
            border-radius: 40px;
            padding: 60px;
            margin-top: -60px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
            position: relative;
            z-index: 2;
        }

        .manifesto-quote {
            font-size: 1.85rem;
            font-weight: 700;
            border-left: 6px solid var(--brand-gold);
            padding-left: 30px;
            margin-bottom: 60px;
        }

        .data-item {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 20px;
            border-bottom: 3px solid var(--brand-gold);
            transition: 0.3s;
        }
        .data-value { font-size: 2.5rem; font-weight: 800; }
        .data-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--brand-gold); font-weight: 700; }

        .f-card {
            background: #fcfcfc;
            padding: 40px;
            border-radius: 25px;
            border: 1px solid #f0f0f0;
            transition: 0.4s ease;
            height: 100%;
        }
        .f-card:hover { transform: translateY(-10px); border-color: var(--brand-gold); }
        .f-icon { font-size: 2rem; color: var(--brand-gold); margin-bottom: 20px; }

        /* --- TABLE --- */
        .comparison-table { margin-top: 50px; }
        .table thead th { 
            border-bottom: 2px solid var(--brand-gold); 
            text-transform: uppercase; 
            font-size: 0.75rem; 
            letter-spacing: 1px;
            padding: 20px;
        }
        .table td { padding: 20px; vertical-align: middle; }
        .highlight-col { background: rgba(243, 156, 18, 0.03); color: var(--brand-gold); font-weight: 700; }

        footer { padding: 60px 0; text-align: center; border-top: 1px solid #eee; background: white; }

        @media (max-width: 991px) {
            .navbar-logo { height: 50px; }
            .main-card { padding: 30px; }
            .manifesto-quote { font-size: 1.4rem; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <div class="nav-container d-flex align-items-center justify-content-between w-100">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{url('front-end/assets/arena-removebg-preview (1).png')}}" alt="Logo" class="navbar-logo">
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">À Propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('valeurs')}}">Valeurs</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('argument')}}">Argument</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('partenaires')}}">Partenaires</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-gold px-4" href="{{route('contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="hero">
    <div class="container" data-aos="fade-up">
        <h1 class="display-4">Le Code est l’Actif <span class="text-gradient">Stratégique</span></h1>
        <p class="lead text-muted mx-auto mt-4" style="max-width: 850px;">
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

        <div class="comparison-table">
            <h2 class="fw-bold text-center mb-4">Vendre la Substance Technologique</h2>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Critère Stratégique</th>
                            <th>Approche Hackathon</th>
                            <th>Approche DevAfrica (Actif)</th>
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
    </div>
</main>

<footer>
    <div class="container">
        <p class="small mb-0">© 2026 DevAfrica Arena. L'excellence numérique au cœur de Lomé.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 30) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
    });
</script>

</body>
</html>