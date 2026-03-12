<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Critères & Inscription | DevAfrica Arena</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #111111;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        }

        body { 
            background-color: #ffffff; 
            color: var(--brand-dark); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            margin: 0;
        }

        #snow-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0; pointer-events: none;
        }

        .content-wrapper { position: relative; z-index: 2; }
        .text-gradient { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        .tech-badge {
            display: inline-block; padding: 8px 20px; margin: 5px;
            background: #f8f9fa; border: 1px solid #eee; border-radius: 50px;
            font-size: 0.85rem; font-weight: 600; color: #555;
            transition: 0.3s;
        }
        .tech-badge:hover { border-color: var(--brand-gold); color: var(--brand-gold); }

        .category-title { border-left: 4px solid var(--brand-gold); padding-left: 15px; margin-bottom: 25px; font-weight: 800; }

        .registration-box {
            background: var(--brand-dark);
            color: white;
            border-radius: 40px;
            padding: 60px;
            margin-bottom: 80px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
        }

        .form-label { font-weight: 600; font-size: 0.85rem; color: #aaa; text-transform: uppercase; margin-bottom: 8px; }
        
        .form-control, .form-select {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 15px;
            color: white !important;
        }

        .form-control:focus, .form-select:focus { 
            background: rgba(255,255,255,0.08); 
            border-color: var(--brand-gold); 
            box-shadow: none; 
        }

        .btn-register {
            background: var(--accent-gradient);
            border: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 800;
            color: white;
            width: 100%;
            transition: 0.3s transform ease;
            cursor: pointer;
        }

        .btn-register:hover { transform: translateY(-3px); }

        #my-form-status { margin-top: 20px; font-weight: 600; text-align: center; }
        .success { color: #2ecc71; }
        .error { color: #e74c3c; }

        @media (max-width: 768px) { .registration-box { padding: 30px; } }
    </style>
</head>
<body>

<canvas id="snow-canvas"></canvas>

<div class="content-wrapper">
    <header class="py-5 mt-5 text-center">
        <div class="container">
            <span class="badge bg-dark rounded-pill px-3 py-2 mb-3">DEVAFRICA ARENA 2026</span>
            <h1 class="display-4 fw-800 mb-3" data-aos="fade-up">Critères de <span class="text-gradient">Sélection</span></h1>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="category-title text-uppercase">Frontend</h3>
                    <div class="mb-4">
                        <span class="tech-badge">HTML5 / CSS3</span>
                        <span class="tech-badge">JavaScript (ES6+)</span>
                        <span class="tech-badge">React / Next.js</span>
                        <span class="tech-badge">TypeScript</span>
                        <span class="tech-badge">Tailwind CSS</span>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="category-title text-uppercase">Backend & Ops</h3>
                    <div class="mb-4">
                        <span class="tech-badge">Node.js / NestJS</span>
                        <span class="tech-badge">Python / FastAPI</span>
                        <span class="tech-badge">Docker / Redis</span>
                        <span class="tech-badge">PostgreSQL</span>
                        <span class="tech-badge">MongoDB</span>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="category-title text-uppercase">Mobile Development</h3>
                    <div class="mb-4">
                        <span class="tech-badge">Dart</span>
                        <span class="tech-badge">Flutter</span>
                        <span class="tech-badge">Firebase</span>
                        <span class="tech-badge">Sqflite</span>
                        <span class="tech-badge">Kotlin</span>
                        <span class="tech-badge">Swift</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="registration-box" data-aos="zoom-in">
            <form id="my-form" action="https://formspree.io/f/maqnreqk" method="POST">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Âge</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Niveau</label>
                        <select name="niveau" class="form-select">
                            <option value="Junior">Junior</option>
                            <option value="Intermédiaire">Intermédiaire</option>
                            <option value="Senior">Senior</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pays</label>
                        <input type="text" name="pays" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Expertise Principale</label>
                        <input type="text" name="expertise" class="form-control" placeholder="Ex: Flutter / Web" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Diplôme</label>
                        <input type="text" name="diplome" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Motivation</label>
                        <textarea name="motivation" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Vision Tech</label>
                        <textarea name="vision" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-12 text-center mt-5">
                        <button id="my-form-button" type="submit" class="btn-register">Soumettre ma candidature</button>
                        <p id="my-form-status"></p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <footer class="text-center py-4 text-muted">
        <small>© 2026 DevAfrica Arena - Propulsé par l'Excellence.</small>
    </footer>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });

    // Gestion AJAX Formspree
    const form = document.getElementById("my-form");
    const status = document.getElementById("my-form-status");
    const button = document.getElementById("my-form-button");

    form.addEventListener("submit", async function(event) {
        event.preventDefault();
        button.disabled = true;
        status.innerHTML = "Traitement en cours...";
        
        const data = new FormData(event.target);
        fetch(event.target.action, {
            method: 'POST',
            body: data,
            headers: { 'Accept': 'application/json' }
        }).then(response => {
            button.disabled = false;
            if (response.ok) {
                status.innerHTML = "Félicitations ! Votre candidature a été reçue.";
                status.className = "success";
                form.reset();
            } else {
                status.innerHTML = "Erreur lors de l'envoi. Réessayez.";
                status.className = "error";
            }
        }).catch(() => {
            button.disabled = false;
            status.innerHTML = "Erreur réseau.";
            status.className = "error";
        });
    });

    // Animation de neige
    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function initSnow() {
        canvas.width = window.innerWidth; canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<50; i++) {
            particles.push({
                x: Math.random() * canvas.width, y: Math.random() * canvas.height,
                size: Math.random() * 2 + 1, speed: Math.random() * 0.5 + 0.1, opacity: Math.random() * 0.3
            });
        }
    }
    function animateSnow() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            ctx.fillStyle = `rgba(180, 180, 180, ${p.opacity})`;
            ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2); ctx.fill();
            p.y += p.speed; if(p.y > canvas.height) p.y = -5;
        });
        requestAnimationFrame(animateSnow);
    }
    window.addEventListener('resize', initSnow);
    initSnow(); animateSnow();
</script>
</body>
</html>