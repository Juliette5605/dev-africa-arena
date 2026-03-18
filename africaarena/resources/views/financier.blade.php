<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Partenariat Financier | DevAfrica Arena</title>

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

        /* --- HEADER --- */
        .page-header { 
            padding: 200px 0 80px; 
            position: relative; 
            background: radial-gradient(circle at center, rgba(243, 156, 18, 0.05) 0%, #ffffff 100%); 
        }
        #snow-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; }
        .text-gradient { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* --- PACK CARDS --- */
        .pack-card { 
            background: #fff; 
            border: 1px solid var(--glass-border); 
            border-radius: 30px; 
            padding: 40px; 
            transition: 0.4s; 
            height: 100%; 
            display: flex; 
            flex-direction: column; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }
        .pack-card:hover { transform: translateY(-10px); border-color: var(--brand-gold); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }
        
        .pack-diamond { background: var(--brand-dark); color: white; border: 2px solid var(--brand-gold); }
        .pack-diamond .text-muted { color: rgba(255,255,255,0.6) !important; }

        .price-tag { font-size: 2rem; font-weight: 800; margin-bottom: 15px; }
        .price-currency { font-size: 1rem; font-weight: 400; opacity: 0.8; }

        .benefit-icon { 
            width: 60px; height: 60px; 
            background: #fff8eb; color: var(--brand-gold); 
            border-radius: 18px; 
            display: flex; align-items: center; justify-content: center; 
            margin-bottom: 25px; font-size: 1.8rem; 
        }
        .pack-diamond .benefit-icon { background: rgba(255,255,255,0.1); }

        /* FORM MODAL */
        .form-control:focus { box-shadow: none; border-color: var(--brand-gold); }

        footer { padding: 60px 0; border-top: 1px solid #eee; background: white; }

        @media (max-width: 991px) {
            .navbar-logo { height: 50px; }
            .nav-container { padding: 10px 15px; }
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
                    <li class="nav-item"><a class="nav-link" href="{{route('argument')}}">Argument</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{route('partenaires')}}">Partenaires</a></li>
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
        <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">OPPORTUNITÉ 2026</span>
        <h1 class="display-3 fw-800" data-aos="fade-up">Partenariat <span class="text-gradient">Financier</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="100">
            Associez votre image à l'élite technologique africaine et soutenez l'émergence des talents de demain.
        </p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-4" data-aos="fade-up">
                <div class="pack-card">
                    <div class="benefit-icon"><i class="bi bi-shield-check"></i></div>
                    <h3 class="fw-800">Pack SILVER</h3>
                    <div class="price-tag text-warning">100.000 <span class="price-currency">FCFA</span></div>
                    <hr>
                    <ul class="list-unstyled mb-auto">
                        <li class="mb-3"><i class="bi bi-check2-circle text-warning me-2"></i>Logo sur site web & écrans</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-warning me-2"></i>Mention Réseaux Sociaux</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-warning me-2"></i>2 Pass VIP pour la Finale</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="pack-card pack-diamond shadow-lg">
                    <div class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold">LE PLUS PRISÉ</div>
                    <div class="benefit-icon"><i class="bi bi-gem"></i></div>
                    <h3 class="fw-800 text-gradient">Pack DIAMOND</h3>
                    <div class="price-tag text-gradient">250.000 <span class="price-currency">FCFA</span></div>
                    <hr class="border-secondary">
                    <ul class="list-unstyled mb-auto">
                        <li class="mb-3"><i class="bi bi-star-fill text-warning me-2"></i><strong>Naming d'un prix officiel</strong></li>
                        <li class="mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Stand Premium dédié</li>
                        <li class="mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Accès CV-thèque talents</li>
                        <li class="mb-3"><i class="bi bi-star-fill text-warning me-2"></i>Logo sur trophées</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="pack-card">
                    <div class="benefit-icon"><i class="bi bi-trophy"></i></div>
                    <h3 class="fw-800">Pack GOLD</h3>
                    <div class="price-tag text-warning">150.000 <span class="price-currency">FCFA</span></div>
                    <hr>
                    <ul class="list-unstyled mb-auto">
                        <li class="mb-3"><i class="bi bi-check2-circle text-warning me-2"></i>Prise de parole à la Finale</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-warning me-2"></i>Logo sur tous les Kakemonos</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-warning me-2"></i>Distribution goodies marque</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center" data-aos="zoom-in">
            <button class="btn btn-gold btn-lg px-5 py-3 shadow" data-bs-toggle="modal" data-bs-target="#financeModal">REJOINDRE L'AVENTURE</button>
        </div>
    </div>
</section>

<div class="modal fade" id="financeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header p-4 border-0 text-center">
                <h4 class="fw-800 mb-0 w-100">Devenir Partenaire</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <form id="fs-form" action="https://formspree.io/f/mvzgyzog" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Responsable</label>
                        <input type="text" name="Responsable" class="form-control py-3 bg-light border-0" placeholder="Nom & Prénom" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Entreprise</label>
                            <input type="text" name="Entreprise" class="form-control py-3 bg-light border-0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Téléphone</label>
                            <input type="tel" name="Telephone" class="form-control py-3 bg-light border-0" placeholder="+228..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Pack souhaité</label>
                        <select name="Pack" class="form-select py-3 bg-light border-0">
                            <option value="DIAMOND">Pack DIAMOND - 250.000 FCFA</option>
                            <option value="GOLD">Pack GOLD - 150.000 FCFA</option>
                            <option value="SILVER">Pack SILVER - 100.000 FCFA</option>
                        </select>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" id="fs-btn" class="btn btn-dark py-3 fw-bold rounded-3">ENVOYER LA DEMANDE</button>
                    </div>
                    <div id="fs-status" class="text-center mt-3 p-2 rounded-3" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container">
        <p class="text-muted small mb-0">© 2026 DevAfrica Arena | Alex WILSON | +228 71 15 50 55</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    // Navbar Scroll Effect
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 30) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
    });

    // Form handling
    var form = document.getElementById("fs-form");
    async function handleSubmit(event) {
      event.preventDefault();
      var status = document.getElementById("fs-status");
      var btn = document.getElementById("fs-btn");
      var data = new FormData(event.target);
      btn.disabled = true; btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Envoi...';
      
      fetch(event.target.action, {
        method: form.method,
        body: data,
        headers: { 'Accept': 'application/json' }
      }).then(response => {
        status.style.display = "block";
        if (response.ok) {
          status.innerHTML = "✅ Dossier envoyé avec succès !";
          status.style.backgroundColor = "#d1e7dd"; status.style.color = "#0f5132";
          form.reset(); btn.innerHTML = "DEMANDE ENVOYÉE";
          setTimeout(() => { bootstrap.Modal.getInstance(document.getElementById('financeModal')).hide(); }, 3000);
        } else {
          status.innerHTML = "❌ Erreur lors de l'envoi.";
          status.style.backgroundColor = "#f8d7da"; status.style.color = "#842029";
          btn.disabled = false; btn.innerHTML = "RÉESSAYER";
        }
      });
    }
    form.addEventListener("submit", handleSubmit);

    // Canvas Background
    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function init() {
        canvas.width = window.innerWidth; canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<60; i++) {
            particles.push({ x: Math.random()*canvas.width, y: Math.random()*canvas.height, size: Math.random()*3, speed: Math.random()*0.5+0.1 });
        }
    }
    function animate() {
        ctx.clearRect(0,0,canvas.width,canvas.height); ctx.fillStyle = 'rgba(243, 156, 18, 0.1)';
        particles.forEach(p => {
            ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI*2); ctx.fill();
            p.y += p.speed; if(p.y > canvas.height) p.y = -5;
        });
        requestAnimationFrame(animate);
    }
    init(); animate(); window.onresize = init;
</script>
</body>
</html>