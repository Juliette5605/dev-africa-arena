<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>À Propos | DevAfrica Arena - L'Arène des Talents</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #222222;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            --glass-bg: rgba(255, 255, 255, 0.75); /* Même que l'accueil */
            --glass-border: rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: #ffffff;
            color: var(--brand-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
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

        /* BOUTON GOLD (Structure identique à l'accueil) */
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
        .page-header {
            padding: 180px 0 100px;
            position: relative;
            background: radial-gradient(circle at top right, rgba(243, 156, 18, 0.08), transparent);
        }
        #snow-canvas {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 1; pointer-events: none;
        }
        .text-gradient {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- CARDS --- */
        .card-glass {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 30px;
            height: 100%;
            transition: 0.4s;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }
        .card-glass:hover {
            border-color: var(--brand-gold);
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        }
        .badge-step {
            background: var(--brand-gold);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            margin-bottom: 20px;
            display: inline-block;
        }
        .section-light { background-color: #fcfcfc; border-top: 1px solid #f0f0f0; }

        footer { padding: 40px 0; border-top: 1px solid #eee; background: white; }

        @media (max-width: 991px) {
            .navbar-logo { height: 50px; }
            .nav-container { padding: 10px 15px; }
            .btn-gold { margin-top: 15px; display: inline-block; }
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
                    <li class="nav-item"><a class="nav-link active" href="{{route('about')}}">À Propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('valeurs')}}">Valeurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('argument')}}">Argument</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('partenaires')}}">Partenaires</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-gold px-4" href="{{route('contact')}}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <h1 class="display-3 fw-800" data-aos="fade-up" style="font-weight: 800;">L'Arène des <span class="text-gradient">Talents Numériques</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="100">
            Le premier championnat technologique bimestriel à Lomé qui transforme le recrutement en un show e-sport de haute intensité.
        </p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="fw-bold mb-4">Pourquoi DevAfrica Arena ?</h2>
                <p class="text-muted fs-5">
                    Au Togo, le talent tech explose, mais reste souvent invisible. Les entreprises peinent à évaluer les compétences réelles tandis que les développeurs cherchent une scène pour briller.
                </p>
                <p class="text-muted fs-5">
                    <strong>DevAfrica Arena</strong> crée ce pont direct. Nous transformons l'évaluation technique en un spectacle public rigoureux et divertissant.
                </p>
                <div class="row mt-4">
                    <div class="col-6">
                        <h3 class="text-gradient fw-bold">100</h3>
                        <p class="small text-uppercase fw-bold">Candidats / Édition</p>
                    </div>
                    <div class="col-6">
                        <h3 class="text-gradient fw-bold">Bimestriel</h3>
                        <p class="small text-uppercase fw-bold">Fréquence</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card-glass">
                    <h4 class="fw-bold mb-4">Nos Objectifs</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-warning me-2"></i> Valoriser l'excellence technique (Junior à Senior).</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-warning me-2"></i> Offrir une plateforme de recrutement dynamique.</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-warning me-2"></i> Dynamiser l'écosystème tech de Lomé.</li>
                        <li><i class="bi bi-check-circle-fill text-warning me-2"></i> Créer un label de compétence reconnu.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 section-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Le Cycle <span class="text-gradient">Bimestriel</span></h2>
            <p class="text-muted">Un processus de sélection impitoyable.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up">
                <div class="card-glass">
                    <span class="badge-step">JOUR 1 : SÉLECTION DAY</span>
                    <h4 class="fw-bold">Phase Technique</h4>
                    <p class="text-muted small"><strong>Matin : Le Grand Quiz</strong><br>100 candidats s'affrontent sur l'algo et la culture tech. Seuls les 20 meilleurs passent.</p>
                    <p class="text-muted small"><strong>Après-midi : Code Challenge</strong><br>Défis complexes sous pression pour sélectionner les 6 finalistes.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-glass" style="background: var(--brand-dark); color: white;">
                    <span class="badge-step">JOUR 2 : LA GRANDE FINALE</span>
                    <h4 class="fw-bold text-white">Le Show Public (Gala)</h4>
                    <p class="text-light opacity-75 small"><strong>Le Duel Final (3h)</strong><br>Live Coding projeté sur écran géant avec commentaires en direct.</p>
                    <p class="text-light opacity-75 small"><strong>Récompenses</strong><br>Cash Prize immédiat et mise en relation prioritaire.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container text-center">
        <p class="small text-muted mb-0">© 2026 DevAfrica Arena. L'avenir du numérique africain au Togo.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    // Gestion du scroll
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 30) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
    });
    
    // Animation de neige (Canvas)
    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    
    function init() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<80; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                size: Math.random() * 3 + 1,
                speed: Math.random() * 0.8 + 0.3
            });
        }
    }
    
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = 'rgba(200, 200, 200, 0.3)'; 
        particles.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();
            p.y += p.speed;
            if(p.y > canvas.height) p.y = -10;
        });
        requestAnimationFrame(animate);
    }
    init(); animate();
    window.addEventListener('resize', init);
</script>

</body>
</html>