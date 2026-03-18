<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sponsors | DevAfrica Arena</title>

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

        /* --- NAVBAR (Harmonisée) --- */
        .navbar { padding: 20px 0; transition: all 0.5s ease; background: transparent; z-index: 1050; }
        .navbar.scrolled { padding: 12px 0; }
        .nav-container {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 10px 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .navbar-logo { height: 60px; transition: 0.4s; }
        .navbar.scrolled .navbar-logo { height: 45px; }
        .nav-link {
            font-weight: 600; color: #444 !important; margin: 0 10px;
            text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;
        }
        .nav-link:hover, .nav-link.active { color: var(--brand-gold) !important; }

        .btn-gold {
            background: var(--accent-gradient); color: #fff !important; 
            font-weight: 800; padding: 12px 30px; 
            border-radius: 100px; border: none; transition: 0.3s;
        }

        /* --- HEADER --- */
        .page-header { 
            padding: 200px 0 100px; 
            position: relative; 
            background: radial-gradient(circle at center, rgba(243, 156, 18, 0.05) 0%, #ffffff 100%); 
        }
        #snow-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; }
        .text-gradient { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* --- SPONSOR CARDS --- */
        .sponsor-card { 
            background: #fff; border: 1px solid var(--glass-border); 
            border-radius: 30px; padding: 40px; transition: 0.4s; 
            height: 100%; position: relative;
        }
        .sponsor-card:hover { transform: translateY(-10px); border-color: var(--brand-gold); box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

        .sponsor-platinum { 
            background: var(--brand-dark); color: white; 
            border: 2px solid var(--brand-gold); 
            transform: scale(1.05);
        }
        .sponsor-platinum .text-muted { color: rgba(255,255,255,0.6) !important; }

        .feature-icon { 
            width: 70px; height: 70px; 
            background: rgba(243, 156, 18, 0.1); 
            color: var(--brand-gold); border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; 
            margin: 0 auto 25px auto; font-size: 2rem; 
        }
        .sponsor-platinum .feature-icon { background: var(--accent-gradient); color: white; }

        .list-group-item { border: none; background: transparent; padding: 12px 0; font-weight: 500; color: inherit; font-size: 0.95rem; }
        .list-group-item i { color: var(--brand-gold); margin-right: 12px; font-size: 1.1rem; }

        .cta-box { 
            background: #fdfaf3; border: 2px dashed rgba(243, 156, 18, 0.3); 
            border-radius: 40px; padding: 60px;
        }

        footer { padding: 50px 0; border-top: 1px solid #eee; background: #fff; }

        @media (max-width: 991px) {
            .sponsor-platinum { transform: scale(1); margin: 20px 0; }
            .navbar-logo { height: 50px; }
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
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">A propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('valeurs')}}">Valeurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('argument')}}">Arguments</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('partenaires')}}">Partenaires</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-gold px-4 fw-bold" href="{{route('contact')}}">CONTACT</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <span class="badge bg-danger text-white mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">VISIBILITÉ MAXIMALE</span>
        <h1 class="display-3 fw-800" data-aos="fade-up">Nos <span class="text-gradient">Sponsors</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 800px;" data-aos="fade-up" data-aos-delay="100">
            Investissez dans l'innovation et associez votre image au plus grand catalyseur de talents tech de la région.
        </p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-4 justify-content-center align-items-stretch mb-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="sponsor-card text-center">
                    <div class="feature-icon"><i class="bi bi-star"></i></div>
                    <h3 class="fw-800">BRONZE</h3>
                    <p class="text-muted small">Soutien & Engagement</p>
                    <hr class="my-4 opacity-10">
                    <ul class="list-group text-start">
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>Logo sur le site officiel</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>Mention sur les réseaux</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>Visibilité écrans (Pauses)</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>2 Pass "Guest"</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up">
                <div class="sponsor-card sponsor-platinum text-center shadow-lg">
                    <div class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold shadow">OFFRE ELITE</div>
                    <div class="feature-icon"><i class="bi bi-gem"></i></div>
                    <h3 class="fw-800 text-gradient">SPONSOR OR</h3>
                    <p class="text-muted small">Impact & Leadership</p>
                    <hr class="my-4 border-secondary">
                    <ul class="list-group text-start">
                        <li class="list-group-item"><i class="bi bi-patch-check-fill text-warning"></i>Tout le pack Argent</li>
                        <li class="list-group-item"><i class="bi bi-patch-check-fill text-warning"></i>Stand de recrutement dédié</li>
                        <li class="list-group-item"><i class="bi bi-patch-check-fill text-warning"></i>Spot vidéo (Cérémonies)</li>
                        <li class="list-group-item"><i class="bi bi-patch-check-fill text-warning"></i>Interview & PR dédié</li>
                        <li class="list-group-item"><i class="bi bi-patch-check-fill text-warning"></i>Logo sur T-shirts officiels</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="sponsor-card text-center">
                    <div class="feature-icon"><i class="bi bi-award"></i></div>
                    <h3 class="fw-800">ARGENT</h3>
                    <p class="text-muted small">Notoriété & Réseau</p>
                    <hr class="my-4 opacity-10">
                    <ul class="list-group text-start">
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>Tout le pack Bronze</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>Logo sur supports imprimés</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>Roll-up zone VIP</li>
                        <li class="list-group-item"><i class="bi bi-check-circle-fill"></i>5 Pass VIP Arena</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="cta-box text-center" data-aos="zoom-in">
            <h2 class="fw-800 mb-3">Prêt à devenir un partenaire clé ?</h2>
            <p class="text-muted mb-4 mx-auto" style="max-width: 600px;">
                Téléchargez notre dossier de sponsoring complet ou demandez un rendez-vous personnalisé.
            </p>
            <button class="btn btn-gold btn-lg px-5 fw-bold shadow" data-bs-toggle="modal" data-bs-target="#sponsorModal">DEMANDER LE DOSSIER</button>
        </div>
    </div>
</section>

<div class="modal fade" id="sponsorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
            <div class="modal-header p-4 border-0">
                <h4 class="fw-800 mb-0">Devenir Sponsor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <form id="fs-sponsor-form" action="https://formspree.io/f/mvzgyzog" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nom du responsable</label>
                        <input type="text" name="Responsable" class="form-control py-3 bg-light border-0 shadow-none" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Entreprise</label>
                            <input type="text" name="Entreprise" class="form-control py-3 bg-light border-0 shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">WhatsApp / Tel</label>
                            <input type="tel" name="Telephone" class="form-control py-3 bg-light border-0 shadow-none" placeholder="+228..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Niveau envisagé</label>
                        <select name="Niveau_Sponsor" class="form-select py-3 bg-light border-0 shadow-none">
                            <option value="Sponsor OR">Sponsor OR (Élite)</option>
                            <option value="Sponsor ARGENT">Sponsor ARGENT</option>
                            <option value="Sponsor BRONZE">Sponsor BRONZE</option>
                            <option value="Sur mesure">Pack sur mesure</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Message ou question</label>
                        <textarea name="Message" class="form-control py-3 bg-light border-0 shadow-none" rows="3"></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="fs-sponsor-btn" class="btn btn-dark py-3 fw-bold rounded-3">ENVOYER LA DEMANDE</button>
                    </div>
                    <div id="fs-sponsor-status" class="text-center mt-3 p-2 rounded-3" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container">
        <p class="text-muted small mb-1">Responsable Sponsoring : <strong>Adjété Alex WILSON</strong></p>
        <p class="text-muted small">© 2026 DevAfrica Arena | Lomé, Togo</p>
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
    var form = document.getElementById("fs-sponsor-form");
    async function handleSubmit(event) {
      event.preventDefault();
      var status = document.getElementById("fs-sponsor-status");
      var btn = document.getElementById("fs-sponsor-btn");
      var data = new FormData(event.target);
      btn.disabled = true; btn.innerHTML = "Envoi...";
      
      fetch(event.target.action, {
        method: form.method,
        body: data,
        headers: { 'Accept': 'application/json' }
      }).then(response => {
        status.style.display = "block";
        if (response.ok) {
          status.innerHTML = "✅ Demande reçue ! Nous vous contacterons rapidement.";
          status.style.backgroundColor = "#d1e7dd"; status.style.color = "#0f5132";
          form.reset(); btn.innerHTML = "ENVOYÉ";
          setTimeout(() => { bootstrap.Modal.getInstance(document.getElementById('sponsorModal')).hide(); }, 3000);
        } else {
          status.innerHTML = "❌ Erreur lors de l'envoi.";
          status.style.backgroundColor = "#f8d7da"; status.style.color = "#842029";
          btn.disabled = false; btn.innerHTML = "RÉESSAYER";
        }
      });
    }
    form.addEventListener("submit", handleSubmit);

    // Particles Effect
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
        ctx.clearRect(0,0,canvas.width,canvas.height); ctx.fillStyle = 'rgba(243, 156, 18, 0.15)';
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