<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DevAfrica Arena - L'écosystème leader pour la formation et l'innovation numérique en Afrique.">
    <title>DevAfrica Arena | Home</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #222222;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(0, 0, 0, 0.08);
        }

        body {
            background-color: #ffffff;
            color: var(--brand-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* --- NAVBAR --- */
        .navbar { padding: 20px 0; transition: all 0.5s ease; background: transparent; z-index: 1000; }
        .navbar.scrolled { padding: 12px 0; }
        .nav-container {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 10px 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            backdrop-filter: blur(10px);
        }
        .navbar-logo { height: 60px; transition: 0.4s; }
        .navbar.scrolled .navbar-logo { height: 45px; }
        .nav-link {
            font-weight: 600; color: #444 !important; margin: 0 10px;
            text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;
        }
        .nav-link:hover, .nav-link.active { color: var(--brand-gold) !important; }

        /* --- HERO --- */
        .hero {
            height: 100vh; display: flex; align-items: center; position: relative;
            background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f8f9fa 100%);
            overflow: hidden;
        }
        #snow-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; }
        .header-img-wrapper { position: relative; animation: float 6s ease-in-out infinite; }
        .header-square-img {
            width: 100%; aspect-ratio: 1 / 1; object-fit: cover;
            border-radius: 30px; border: 1px solid var(--glass-border);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .img-decoration {
            position: absolute; top: 15px; right: -15px; width: 100%; height: 100%;
            border: 2px solid var(--brand-gold); border-radius: 30px; z-index: -1; opacity: 0.3;
        }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        .text-gradient { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .btn-gold {
            background: var(--accent-gradient); color: #fff !important; font-weight: 800;
            padding: 15px 35px; border-radius: 15px; border: none; transition: 0.3s;
        }
        .btn-gold:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(243, 156, 18, 0.2); }

        /* --- JOBS SECTION (FOND BLANC) --- */
        .jobs-section { 
            padding: 80px 0; 
            background: #ffffff; /* Changé de gris à blanc */
            position: relative; 
            z-index: 2; 
        }

        #jobs-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .job-card {
            background: #fdfdfd; /* Très léger gris pour détacher la carte du fond blanc */
            padding: 15px;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.04);
            transition: 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .job-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.08); background: #ffffff; }

        .job-card img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .job-card h3 { 
            font-size: 1.05rem; 
            font-weight: 700; 
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .job-info { font-size: 0.85rem; color: #666; margin-bottom: 4px; display: flex; align-items: center; }
        .job-info i { color: var(--brand-gold); width: 20px; }

        .job-card a {
            display: block;
            margin-top: auto;
            background: var(--brand-dark);
            color: white;
            padding: 10px;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.3s;
            margin-top: 15px;
        }
        .job-card a:hover { background: var(--brand-gold); color: white; }

        /* --- PARTNERS (SECTION BLANCHE CONTINUE) --- */
        .partners-bar { 
            background: #ffffff; 
            padding: 60px 0 100px 0; /* Plus d'espace en bas */
            border-top: 1px solid #f0f0f0; 
            position: relative; 
            z-index: 2; 
        }
        .partner-label { font-size: 0.7rem; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px; display: block; }
        .partner-logo-single { max-height: 70px; width: auto; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.08)); }
         /* --- SECTION MIXTE : MÉTIERS & QUIZ --- */
    .orientation-hub { padding: 100px 0; background: #fdfdfd; position: relative; }
    
    /* Cartes des métiers */
    .field-card {
        background: #fff; border-radius: 20px; padding: 25px; height: 100%;
        border: 1px solid #eee; transition: 0.3s; position: relative;
    }
    .field-card:hover { transform: translateY(-10px); border-color: var(--brand-gold); box-shadow: 0 15px 30px rgba(0,0,0,0.05); }
    .field-icon {
        width: 50px; height: 50px; background: var(--accent-gradient); color: white;
        border-radius: 12px; display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; margin-bottom: 20px;
    }
    .field-card h5 { font-weight: 800; font-size: 1.1rem; }
    .field-tag { font-size: 0.7rem; font-weight: 700; color: var(--brand-gold); text-transform: uppercase; letter-spacing: 1px; }

    /* Style du Quiz */
    .quiz-box {
        background: #ffffff; border-radius: 30px; padding: 40px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.07); border: 1px solid #f0f0f0;
        margin-top: 60px; position: relative;
    }
    .q-progress-bg { height: 6px; background: #eee; border-radius: 10px; margin-bottom: 30px; overflow: hidden; }
    .q-progress-fill { height: 100%; background: var(--accent-gradient); width: 0%; transition: 0.4s; }
    
    .answer-option {
        display: block; width: 100%; padding: 16px 22px; margin-bottom: 12px;
        border: 2px solid #f8f8f8; border-radius: 15px; background: #fff;
        text-align: left; font-weight: 600; transition: 0.2s;
    }
    .answer-option:hover { border-color: var(--brand-gold); background: #fffaf0; color: var(--brand-dark); }
    
    #quiz-result { display: none; }
    .roadmap-badge { display: inline-block; padding: 5px 15px; background: #fff3e0; border-radius: 8px; font-weight: 700; font-size: 0.8rem; margin-bottom: 15px; }
        
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
                    <li class="nav-item"><a class="nav-link active" href="{{route('home')}}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about')}}">À Propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('valeurs')}}">Valeurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('argument')}}">Argument</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('partenaires')}}">Partenaires</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-gold py-2 px-4" href="{{route('contact')}}" style="padding: 8px 25px !important;">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="hero">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-800 mb-4" style="color: #111;">Propulser l'<span class="text-gradient">Afrique</span> par le numérique</h1>
                <p class="lead text-muted mb-5">DevAfrica Arena est le catalyseur de talents qui façonne les architectes technologiques de demain.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{route('criteres')}}" class="btn btn-gold">Critères de Participation</a>
                    <a href="{{route('about')}}" class="btn btn-outline-dark" style="border-radius:15px; padding:15px 35px; font-weight:700;">Découvrir</a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-none d-lg-block" data-aos="fade-left">
                <div class="header-img-wrapper">
                    <img src="{{url('https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800')}}" alt="Innovation" class="header-square-img">
                    <div class="img-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="orientation-hub" id="orientation" style="padding: 100px 0; background: #fdfdfd; position: relative; overflow: hidden;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-3 rounded-pill mb-2">ORIENTATION LIVE</span>
            <h2 class="fw-800 display-6">L'Arène des Talents</h2>
            <p class="text-muted">Réponds vite ! Le système analyse tes réflexes numériques.</p>
        </div>

        <div class="row g-4 mb-5" id="fields-grid">
            <div class="col-6 col-md-4 col-lg-2 field-wrapper" id="field-dev">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-code-slash d-block h3 mb-2"></i>
                    <span class="small fw-bold">Web/Mobile</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper" id="field-ia">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-cpu d-block h3 mb-2"></i>
                    <span class="small fw-bold">IA & Data</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper" id="field-design">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-palette d-block h3 mb-2"></i>
                    <span class="small fw-bold">Design UX</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper" id="field-com">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-megaphone d-block h3 mb-2"></i>
                    <span class="small fw-bold">Marketing</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper" id="field-cyber">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-shield-lock d-block h3 mb-2"></i>
                    <span class="small fw-bold">Cyber</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper" id="field-fab">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-tools d-block h3 mb-2"></i>
                    <span class="small fw-bold">IoT/Maker</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="quiz-box shadow-lg rounded-5 bg-white border-0" style="position:relative;">
                    <div id="timer-bar" style="position:absolute; top:0; left:0; height:5px; width:0%; background:var(--brand-gold); transition: width 0.1s linear;"></div>
                    
                    <div class="p-4 p-md-5">
                        <div id="quiz-ui">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="fw-bold mb-0 text-uppercase letter-spacing-1" id="q-counter">Question 1/7</h6>
                                <div class="spinner-grow spinner-grow-sm text-warning" role="status"></div>
                            </div>
                            <h3 id="q-text" class="fw-800 mb-4" style="min-height: 80px;">Préparation de l'analyse...</h3>
                            <div id="q-answers" class="d-grid gap-2"></div>
                        </div>

                        <div id="quiz-result" class="text-center py-4" style="display:none;">
                            <div class="roadmap-badge text-warning mb-3">RÉSULTAT ANALYSÉ</div>
                            <h2 id="res-profile" class="fw-800 text-gradient mb-3"></h2>
                            <p id="res-desc" class="text-muted mb-4"></p>
                            <button onclick="resetQuiz()" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">Redémarrer l'analyse</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .transition-all { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .field-card-mini { border: 1px solid #eee; cursor: pointer; }
    .field-wrapper.dimmed { opacity: 0.2; transform: scale(0.85); filter: blur(1px); }
    .field-wrapper.highlight { border: 2px solid var(--brand-gold); background: #fffdf5; transform: scale(1.1); box-shadow: 0 10px 20px rgba(243,156,18,0.2); }
    .field-wrapper.highlight i { color: var(--brand-gold); }
    
    .answer-option { 
        border: 2px solid #f8f9fa; background: #fff; padding: 18px; 
        border-radius: 16px; text-align: left; font-weight: 600; transition: 0.3s;
    }
    .answer-option:hover { transform: translateX(10px); border-color: var(--brand-gold); color: var(--brand-gold); }
    .answer-option.selected { background: var(--brand-gold); color: white; border-color: var(--brand-gold); }
</style>

<script>
    const quizData = [
        { q: "Face à une page blanche, tu as envie de...", a: [{t:"Taper des lignes de commandes", v:"dev"}, {t:"Tracer des courbes et des couleurs", v:"design"}, {t:"Analyser des colonnes de chiffres", v:"ia"}]},
        { q: "Quel super-pouvoir numérique préfères-tu ?", a: [{t:"Rendre un site ultra rapide", v:"dev"}, {t:"Prédire l'avenir avec les données", v:"ia"}, {t:"Convaincre des milliers de gens", v:"com"}]},
        { q: "Ton objet fétiche sur ton bureau ?", a: [{t:"Un clavier mécanique", v:"dev"}, {t:"Une tablette graphique", v:"design"}, {t:"Un routeur ou un fer à souder", v:"fab"}]},
        { q: "Le danger qui te fait le plus peur ?", a: [{t:"Une panne logicielle totale", v:"dev"}, {t:"Une fuite de données massive", v:"cyber"}, {t:"Une IA incontrôlable", v:"ia"}]},
        { q: "En équipe, tu es celui qui...", a: [{t:"Structure le projet", v:"dev"}, {t:"Vend le concept aux clients", v:"com"}, {t:"Protège les accès", v:"cyber"}]},
        { q: "Quelle technologie t'excite le plus ?", a: [{t:"Le Cloud et les API", v:"dev"}, {t:"La Robotique connectée", v:"fab"}, {t:"La Réalité Augmentée", v:"design"}]},
        { q: "Dernière chance : Ton instinct te dit ?", a: [{t:"Créer", v:"dev"}, {t:"Sécuriser", v:"cyber"}, {t:"Connecter", v:"fab"}]}
    ];

    let currentQ = 0;
    let scores = { dev: 0, ia: 0, design: 0, com: 0, cyber: 0, fab: 0 };
    let timerWidth = 0;
    let timerInterval;
    const TIME_LIMIT = 80; // 8 secondes (80 * 100ms)

    function startTimer() {
        clearInterval(timerInterval);
        timerWidth = 0;
        timerInterval = setInterval(() => {
            timerWidth++;
            document.getElementById("timer-bar").style.width = (timerWidth / TIME_LIMIT * 100) + "%";
            if (timerWidth >= TIME_LIMIT) {
                // AUTO-PASS : Choisit une réponse aléatoire si l'utilisateur ne clique pas
                const options = quizData[currentQ].a;
                const randomChoice = options[Math.floor(Math.random() * options.length)].v;
                processAnswer(randomChoice);
            }
        }, 100);
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
            if(w.id === `field-${val}`) {
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
            dev:"Architecte Web & Mobile", ia:"Ingénieur IA", design:"Creative Designer", 
            com:"Growth Marketer", cyber:"Gardien Cybersécurité", fab:"Ingénieur IoT"
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
        document.querySelectorAll('.field-wrapper').forEach(w => w.classList.remove('dimmed', 'highlight'));
        loadQuestion();
    }

    loadQuestion();
</script>
<section class="jobs-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
            <div>
                <span class="badge bg-warning text-dark mb-2 px-3 rounded-pill">OPPORTUNITÉS</span>
                <h2 class="fw-bold mb-0">Offres d'emploi</h2>
            </div>
            <p class="text-muted small mb-0 d-none d-md-block">Mis à jour automatiques</p>
        </div>
        <div id="jobs-container"></div>
    </div>
</section>

<section class="partners-bar text-center">
    <div class="container" data-aos="fade-up">
        <span class="partner-label">Notre Partenaire Officiel</span>
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{url('front-end/assets/logo saei.png')}}" alt="Logo Partenaire" class="partner-logo-single">
        </div>
    </div>
</section>

<footer>
    <div class="container text-center">
        <div class="footer-content" data-aos="fade-up">
            <div class="footer-brand">DevAfrica Arena</div>
            <div class="footer-sep"></div>
            <p class="footer-credit mb-0">
                © 2026 DevAfrica Arena — <span class="text-gold">Lomé, Togo</span>
            </p>
        </div>
    </div>
</footer>
<script>
fetch("https://sheetdb.io/api/v1/qg4gis5u4esa6")
.then(response => response.json())
.then(data => {
    let container = document.getElementById("jobs-container");
    let html = "";
    data.forEach(job => {
        if(job.Titre){ 
            html += `
            <div class="job-card" data-aos="zoom-in">
                <img src="${job.Image}" alt="${job.Titre}">
                <h3>${job.Titre}</h3>
                <div class="job-info"><i class="bi bi-building"></i> ${job.Entreprise}</div>
                <div class="job-info"><i class="bi bi-geo-alt"></i> ${job.Ville}</div>
                <div class="job-info"><i class="bi bi-clock"></i> ${job.Type}</div>
                <a href="${job.Lien}" target="_blank">Postuler</a>
            </div>
            `;
        }
    });
    container.innerHTML = html;
})
.catch(error => { console.error("Erreur API :", error); });

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 30) nav.classList.add('scrolled');
        else nav.classList.remove('scrolled');
    });

    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function init() {
        canvas.width = window.innerWidth; canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<60; i++) {
            particles.push({
                x: Math.random() * canvas.width, y: Math.random() * canvas.height,
                size: Math.random() * 2 + 1, speed: Math.random() * 0.5 + 0.2,
                opacity: Math.random() * 0.3 + 0.1
            });
        }
    }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            ctx.fillStyle = `rgba(180, 180, 180, ${p.opacity})`;
            ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2); ctx.fill();
            p.y += p.speed; if(p.y > canvas.height) p.y = -10;
        });
        requestAnimationFrame(animate);
    }
    init(); animate();
    window.addEventListener('resize', init);
</script>
</body>
</html>