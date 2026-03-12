<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nos Valeurs | DevAfrica Arena</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #111111;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            /* CORRECTION : Couleur Blanche demandée pour la Nav */
            --glass-nav-bg: rgba(255, 255, 255, 0.85); 
            --glass-card-bg: rgba(255, 255, 255, 0.9);
            --glass-card-border: rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: #ffffff;
            color: var(--brand-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* --- CANVAS NEIGE --- */
        #snow-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .content-wrapper { position: relative; z-index: 2; }

        /* --- NAVBAR --- */
        .navbar { padding: 20px 0; transition: all 0.5s ease; background: transparent; z-index: 1000; }
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

        /* --- CARDS & TABLES --- */
        .card-glass {
            background: var(--glass-card-bg);
            border: 1px solid var(--glass-card-border);
            border-radius: 24px;
            padding: 35px;
            height: 100%;
            transition: 0.3s ease;
        }
        .card-glass:hover { transform: translateY(-10px); border-color: var(--brand-gold); }

        .icon-box {
            width: 60px; height: 60px;
            background: rgba(243, 156, 18, 0.1);
            color: var(--brand-gold);
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px; font-size: 1.5rem;
        }

        .table-custom {
            background: var(--brand-dark);
            color: white;
            border-radius: 24px;
            overflow: hidden;
            border: none;
        }
        .table-custom th { background: #1a1a1a; color: var(--brand-gold); border: none; padding: 20px; }
        .table-custom td { padding: 20px; border-top: 1px solid #333; }

        .text-gradient {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>

<canvas id="snow-canvas"></canvas>

<div class="content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <div class="nav-container d-flex align-items-center justify-content-between w-100">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{url('front-end/assets/arena-removebg-preview (1).png')}}" alt="Logo" height="50">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">À Propos</a></li>
                         <li class="nav-item"><a class="nav-link active" href="{{route('valeurs')}}">Valeurs</a></li>
                              <li class="nav-item"><a class="nav-link" href="{{route('argument')}}">Arguments</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('partenaires')}}">Partenaires</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-gold py-2 px-4" href="{{route('contact')}}">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

    <header class="text-center" style="padding: 160px 0 60px;">
        <div class="container">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">POURQUOI NOUS CHOISIR ?</span>
            <h1 class="display-4 fw-800 mb-3" data-aos="fade-up">Notre <span class="text-gradient">Valeur Ajoutée</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="100">
                DevAfrica Arena n'est pas un hackathon de plus. C'est une révolution dans la manière d'évaluer, de célébrer et de recruter les talents technologiques en Afrique.
            </p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-cpu"></i></div>
                        <h5 class="fw-bold">Talent Pur</h5>
                        <p class="small text-muted">Nous isolons la compétence technique brute. Pas de "pitch" commercial, juste du code pur et de l'algorithmie.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-broadcast"></i></div>
                        <h5 class="fw-bold">Le Show Direct</h5>
                        <p class="small text-muted">Inspiré de l'e-sport, la finale est un spectacle de live-coding commenté devant un public passionné.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-arrow-repeat"></i></div>
                        <h5 class="fw-bold">Récurrence</h5>
                        <p class="small text-muted">Un cycle bimestriel qui permet aux développeurs de s'améliorer et de revenir plus forts tous les deux mois.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                        <h5 class="fw-bold">Label Elite</h5>
                        <p class="small text-muted">Nos finalistes reçoivent un label de compétence certifié, facilitant leur embauche immédiate.</p>
                    </div>
                </div>
            </div>

            <div class="mt-5" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold">Une différence <span class="text-gradient">Radicale</span></h2>
                </div>
                
                <div class="table-responsive shadow-lg rounded-4">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th>Critère</th>
                                <th>Hackathon Classique</th>
                                <th class="text-warning text-uppercase">DevAfrica Arena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Objectif Final</td>
                                <td class="opacity-75">Prototype / Idée de Startup</td>
                                <td class="text-warning fw-bold">Démonstration de Maîtrise Code</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Durée de l'effort</td>
                                <td class="opacity-75">Longue (48h à 72h)</td>
                                <td class="text-warning fw-bold">Intense (Quiz + Finale 3h)</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Public ciblé</td>
                                <td class="opacity-75">Porteurs de projets</td>
                                <td class="text-warning fw-bold">Développeurs d'Élite</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Évaluation</td>
                                <td class="opacity-75">Subjective (Jury de business)</td>
                                <td class="text-warning fw-bold">Technique (Code & Performance)</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Fréquence</td>
                                <td class="opacity-75">Annuelle / Ponctuelle</td>
                                <td class="text-warning fw-bold">Bimestrielle (Saisonnière)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-white border-top">
        <div class="container text-center">
            <p class="small text-muted mb-0">© 2026 DevAfrica Arena. L'Arène où naissent les légendes du code.</p>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });

    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function init() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<60; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                size: Math.random() * 2.5 + 1,
                speed: Math.random() * 0.6 + 0.2,
                opacity: Math.random() * 0.4
            });
        }
    }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            ctx.fillStyle = `rgba(200, 200, 200, ${p.opacity})`;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();
            p.y += p.speed;
            if(p.y > canvas.height) p.y = -10;
        });
        requestAnimationFrame(animate);
    }
    window.addEventListener('resize', init);
    init(); animate();
</script>
</body>
</html>