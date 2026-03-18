<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Partenaires | DevAfrica Arena</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #080808;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            /* Ajustement pour fond blanc */
            --glass-bg: rgba(0, 0, 0, 0.05);
            --glass-border: rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #ffffff; /* Fond Blanc */
            color: var(--brand-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* --- NAVBAR --- */
        .navbar { padding: 20px 0; transition: all 0.5s ease; background: transparent; z-index: 1000; }
        .navbar.scrolled { padding: 12px 0; }
        
        .nav-container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 10px 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .nav-link {
            font-weight: 600;
            color: #444 !important;
            margin: 0 10px;
            text-transform: uppercase;
            font-size: 0.8rem;
        }
        .nav-link:hover, .nav-link.active { color: var(--brand-gold) !important; }

        /* --- HERO PARTENAIRES --- */
        .hero-partners {
            height: 60vh;
            display: flex;
            align-items: center;
            position: relative;
            /* Gradient léger pour donner de la profondeur au fond blanc */
            background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f8f9fa 100%);
            overflow: hidden;
        }

        #snow-canvas {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .text-gradient {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* --- BUTTONS --- */
        .btn-gold {
            background: var(--accent-gradient);
            color: #fff !important;
            font-weight: 800;
            padding: 15px 35px;
            border-radius: 15px;
            border: none;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-gold:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(243, 156, 18, 0.2); }

        .btn-outline-custom {
            border: 2px solid var(--brand-gold);
            color: var(--brand-gold) !important;
            font-weight: 700;
            padding: 15px 35px;
            border-radius: 15px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-outline-custom:hover { background: var(--brand-gold); color: #fff !important; }

        /* --- SECTION GLASS (ADAPTÉE AU BLANC) --- */
        .section-glass {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--glass-border);
            border-radius: 30px;
            padding: 60px;
            margin-top: -80px;
            position: relative;
            z-index: 10;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <div class="nav-container d-flex align-items-center justify-content-between w-100">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="{{url('front-end/assets/arena-removebg-preview (1).png')}}" alt="Logo" height="50">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">À Propos</a></li>
                         <li class="nav-item"><a class="nav-link" href="{{route('valeurs')}}">Valeurs</a></li>
                              <li class="nav-item"><a class="nav-link" href="{{route('argument')}}">Arguments</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('partenaires')}}">Partenaires</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-gold py-2 px-4" href="{{route('contact')}}">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="hero-partners">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="text-center" data-aos="zoom-in">
            <h1 class="display-2 fw-800 mb-4" style="color: #222;">Nos <span class="text-gradient">Alliés</span></h1>
            <p class="lead text-muted mx-auto" style="max-width: 600px;">
                Ensemble, nous construisons le futur technologique de l'Afrique. Rejoignez l'écosystème.
            </p>
        </div>
    </div>
</header>

<section class="container mb-5">
    <div class="section-glass text-center" data-aos="fade-up">
        <h2 class="mb-5 fw-800" style="color: #222;">Explorez notre réseau</h2>
        
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="financier" class="btn btn-outline-custom">
                <i class="bi bi-cash-stack me-2"></i> Partenaires Financiers
            </a>

            <a href="techniques" class="btn btn-outline-custom">
                <i class="bi bi-cpu me-2"></i> Partenaires Techniques
            </a>

            <a href="sponsors" class="btn btn-gold">
                <i class="bi bi-star-fill me-2"></i> Devenir Sponsor
            </a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    window.addEventListener('scroll', () => {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 30) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
    });

    // --- EFFET DE NEIGE (Snow Animation) ---
    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];

    function init() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<100; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                size: Math.random() * 3 + 1,
                speed: Math.random() * 1 + 0.5,
                opacity: Math.random() * 0.5 + 0.2
            });
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        // Couleur des flocons : Gris très clair/Blanc
        ctx.fillStyle = 'rgba(200, 200, 200, 0.5)'; 
        
        particles.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();
            
            p.y += p.speed; // Tombe vers le bas
            if(p.y > canvas.height) p.y = -10;
        });
        requestAnimationFrame(animate);
    }

    init();
    animate();
    window.addEventListener('resize', init);
</script>
</body>
</html>