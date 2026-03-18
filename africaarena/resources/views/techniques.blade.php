<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Partenariat Technique | DevAfrica Arena</title>

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

        /* --- NAVBAR --- */
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

        /* --- HEADER --- */
        .page-header { 
            padding: 200px 0 80px; 
            position: relative; 
            background: radial-gradient(circle at center, rgba(243, 156, 18, 0.05) 0%, #ffffff 100%); 
        }
        #snow-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; }
        .text-gradient { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* --- SECTIONS --- */
        .section-title { font-weight: 800; margin-bottom: 30px; position: relative; }
        .section-title::after { content: ''; position: absolute; bottom: -10px; left: 0; width: 60px; height: 5px; background: var(--brand-gold); border-radius: 2px; }

        .benefit-card { 
            border: 1px solid var(--glass-border); 
            border-radius: 25px; padding: 35px; 
            transition: 0.3s; height: 100%; 
            background: #fff; text-align: center; 
        }
        .benefit-card:hover { transform: translateY(-10px); border-color: var(--brand-gold); box-shadow: 0 15px 30px rgba(0,0,0,0.05); }
        .benefit-card i { font-size: 2.5rem; margin-bottom: 20px; display: block; color: var(--brand-gold); }

        .tech-box { 
            background: #f8f9fa; border-radius: 30px; 
            padding: 40px; border-left: 8px solid var(--brand-gold); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
        }

        .contact-card { 
            background: var(--brand-dark); color: white; 
            border-radius: 40px; padding: 60px; 
            position: relative; overflow: hidden;
        }
        .btn-gold {
            background: var(--accent-gradient); color: #fff !important; 
            font-weight: 800; padding: 15px 40px; 
            border-radius: 15px; border: none; transition: 0.3s;
        }
        .btn-gold:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(243, 156, 18, 0.3); }

        footer { padding: 50px 0; border-top: 1px solid #eee; background: #fff; }

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
                    <li class="nav-item ms-lg-3"><a class="btn btn-gold px-4" href="{{route('contact')}}">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <span class="badge bg-dark text-white mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">EXPERTISE & INNOVATION</span>
        <h1 class="display-3 fw-800" data-aos="fade-up">Partenariat <span class="text-gradient">Technique</span></h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            Propulsez l'innovation en devenant le socle technologique du plus grand hackathon de la région.
        </p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5 g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="section-title">Pourquoi nous rejoindre ?</h2>
                <p class="fs-5 text-muted">
                    DevAfrica Arena est bien plus qu'une compétition, c'est un <strong>laboratoire technologique</strong> grandeur nature. En tant que partenaire technique, vous ne faites pas que soutenir l'événement, vous devenez un acteur du changement numérique en Afrique.
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="tech-box">
                    <h4 class="fw-bold mb-3"><i class="bi bi-shield-lock text-warning me-2"></i>Immersion Totale</h4>
                    <p class="mb-0 text-muted">Intégrez vos solutions (Cloud, DevTools, Réseaux) au cœur des projets développés par les candidats et testez leur robustesse en temps réel.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="benefit-card">
                    <i class="bi bi-cpu"></i>
                    <h5 class="fw-bold">Benchmark</h5>
                    <p class="small text-muted mb-0">Prouvez la performance de vos outils face aux défis les plus complexes.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="benefit-card">
                    <i class="bi bi-rocket-takeoff"></i>
                    <h5 class="fw-bold">Early Adopters</h5>
                    <p class="small text-muted mb-0">Faites adopter vos technologies par les futurs leaders de la tech.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="benefit-card">
                    <i class="bi bi-search"></i>
                    <h5 class="fw-bold">Sourcing VIP</h5>
                    <p class="small text-muted mb-0">Repérez et recrutez les talents qui maîtrisent déjà votre stack.</p>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="benefit-card">
                    <i class="bi bi-broadcast-pin"></i>
                    <h5 class="fw-bold">Branding Tech</h5>
                    <p class="small text-muted mb-0">Renforcez votre image d'expert et d'innovateur engagé.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="contact-card text-center" data-aos="zoom-in">
            <h2 class="fw-800 mb-4">Prêt à co-construire l'Arena ?</h2>
            <p class="lead opacity-75 mb-5 mx-auto" style="max-width: 700px;">
                Mettez à disposition vos ressources (Infrastructure, Expertise, Coaching) et devenez un pilier stratégique de cette édition 2026.
            </p>
            <button class="btn btn-gold btn-lg shadow-lg" data-bs-toggle="modal" data-bs-target="#techModal">PROPOSER UNE EXPERTISE</button>
        </div>
    </div>
</section>

<div class="modal fade" id="techModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header p-4 border-0">
                <h4 class="fw-800 mb-0">Partenariat Technique</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <form id="fs-tech-form" action="https://formspree.io/f/mvzgyzog" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Responsable Technique</label>
                        <input type="text" name="Responsable" class="form-control py-3 bg-light border-0 shadow-none" placeholder="Nom complet" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Entreprise</label>
                            <input type="text" name="Entreprise" class="form-control py-3 bg-light border-0 shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Téléphone</label>
                            <input type="tel" name="Telephone" class="form-control py-3 bg-light border-0 shadow-none" placeholder="+228..." required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Type d'apport technique</label>
                        <select name="Type_Apport" class="form-select py-3 bg-light border-0 shadow-none">
                            <option value="Connectivité">Connectivité (Internet / WiFi)</option>
                            <option value="Cloud/Software">Cloud / SaaS / Licences</option>
                            <option value="Matériel">Hardware (Laptops / Écrans)</option>
                            <option value="Expertise">Mentoring / Jury d'experts</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Votre proposition</label>
                        <textarea name="Message" class="form-control py-3 bg-light border-0 shadow-none" rows="3" placeholder="Comment souhaitez-vous contribuer ?"></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="fs-tech-btn" class="btn btn-dark py-3 fw-bold rounded-3">ENVOYER LA PROPOSITION</button>
                    </div>
                    <div id="fs-tech-status" class="text-center mt-3 p-2 rounded-3" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <p class="text-muted small">© 2026 DevAfrica Arena | Alex WILSON | +228 71 15 50 55</p>
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

    // Form submission
    var form = document.getElementById("fs-tech-form");
    async function handleSubmit(event) {
      event.preventDefault();
      var status = document.getElementById("fs-tech-status");
      var btn = document.getElementById("fs-tech-btn");
      var data = new FormData(event.target);
      btn.disabled = true; btn.innerHTML = "Envoi...";
      
      fetch(event.target.action, {
        method: form.method,
        body: data,
        headers: { 'Accept': 'application/json' }
      }).then(response => {
        status.style.display = "block";
        if (response.ok) {
          status.innerHTML = "✅ Merci ! Proposition envoyée avec succès.";
          status.style.backgroundColor = "#d1e7dd"; status.style.color = "#0f5132";
          form.reset(); btn.innerHTML = "ENVOYÉ";
          setTimeout(() => { bootstrap.Modal.getInstance(document.getElementById('techModal')).hide(); }, 3000);
        } else {
          status.innerHTML = "❌ Erreur lors de l'envoi.";
          status.style.backgroundColor = "#f8d7da"; status.style.color = "#842029";
          btn.disabled = false; btn.innerHTML = "RÉESSAYER";
        }
      });
    }
    form.addEventListener("submit", handleSubmit);

    // Background Canvas
    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function init() {
        canvas.width = window.innerWidth; canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<50; i++) {
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