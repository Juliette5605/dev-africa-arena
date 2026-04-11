
<?php $__env->startSection('title', 'DevAfrica Arena | Home'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ─── HERO ─────────────────────────────────────────────── */
.hero {
    padding: 180px 0 100px;
        position: relative;
        background: radial-gradient(circle at top right, rgba(243,156,18,0.08), transparent);
}
#snow-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; pointer-events: none; }
.header-img-wrapper { position: relative; animation: float 6s ease-in-out infinite; }
.header-square-img {
    width: 100%; aspect-ratio: 1 / 1; object-fit: cover;
    border-radius: 30px; border: 1px solid rgba(0,0,0,0.08);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}
.img-decoration {
    position: absolute; top: 15px; right: -15px; width: 100%; height: 100%;
    border: 2px solid #f39c12; border-radius: 30px; z-index: -1; opacity: 0.3;
}
@keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }

/* ─── ORIENTATION HUB + QUIZ ────────────────────────────── */
.orientation-hub { padding: 100px 0; background: #fdfdfd; position: relative; overflow: hidden; }
.transition-all { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.field-card-mini { border: 1px solid #eee; cursor: pointer; }
.field-wrapper.dimmed { opacity: 0.2; transform: scale(0.85); filter: blur(1px); }
.field-wrapper.highlight { border: 2px solid var(--brand-gold, #f39c12) !important; background: #fffdf5; transform: scale(1.1); box-shadow: 0 10px 20px rgba(243,156,18,0.2); }
.field-wrapper.highlight i { color: #f39c12; }
#fields-grid{color: #000;}
.answer-option {
    display: block; width: 100%; padding: 16px 22px; margin-bottom: 12px;
    border: 2px solid #f8f8f8; border-radius: 15px; background: #fff;
    text-align: left; font-weight: 600; transition: 0.3s; font-family: inherit; cursor: pointer;
}
.answer-option:hover { transform: translateX(10px); border-color: #f39c12; color: #f39c12; }
.answer-option.selected { background: #f39c12; color: white; border-color: #f39c12; }
.quiz-box { background: #ffffff; border-radius: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.07); border: 1px solid #f0f0f0; position: relative; }
.roadmap-badge { display: inline-block; padding: 5px 15px; background: #fff3e0; border-radius: 8px; font-weight: 700; font-size: 0.8rem; margin-bottom: 15px; }
.text-gradient { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

/* ─── COUNTDOWN ─────────────────────────────────────────── */
.countdown-section { background: linear-gradient(135deg, #111, #1a1a1a); padding: 70px 0; }
.cd-unit { min-width: 88px; text-align: center; background: rgba(255,255,255,0.04); border: 1px solid rgba(243,156,18,0.12); border-radius: 18px; padding: 18px 10px; }
.cd-num { display: block; font-size: clamp(2rem,5vw,3.2rem); font-weight: 800; color: #f39c12; line-height: 1; }
.cd-lbl { display: block; font-size: 0.62rem; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.35); margin-top: 6px; }
.cd-sep { font-size: 2.5rem; font-weight: 800; color: rgba(243,156,18,0.25); padding: 0 6px; align-self: flex-start; margin-top: 12px; }

/* ─── JOBS ──────────────────────────────────────────────── */
.jobs-section { padding: 80px 0; background: #ffffff; position: relative; z-index: 2; }
#jobs-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; margin-top: 30px; }
.job-card { background: #fdfdfd; padding: 15px; border-radius: 16px; box-shadow: 0 5px 15px rgba(0,0,0,0.04); transition: 0.3s ease; border: 1px solid rgba(0,0,0,0.05); display: flex; flex-direction: column; height: 100%; }
.job-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.08); background: #ffffff; }
.job-card img { width: 100%; height: 130px; object-fit: cover; border-radius: 12px; margin-bottom: 12px; }
.job-card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 8px; line-height: 1.3; }
.job-info { font-size: 0.85rem; color: #666; margin-bottom: 4px; display: flex; align-items: center; }
.job-info i { color: #f39c12; width: 20px; }
.job-card a { display: block; margin-top: auto; background: #222; color: white; padding: 10px; border-radius: 10px; text-decoration: none; text-align: center; font-weight: 600; font-size: 0.9rem; transition: 0.3s; margin-top: 15px; }
.job-card a:hover { background: #f39c12; color: white; }

/* ─── PARTNERS ──────────────────────────────────────────── */
.partners-bar { background: #ffffff; padding: 60px 0 100px 0; border-top: 1px solid #f0f0f000; position: relative; z-index: 2; }
.partner-label { font-size: 0.7rem; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px; display: block; }
.partner-logo-single { max-height: 70px; width: auto; filter: drop-shadow(0 5px 15px rgba(0,0,0,0.08)); }

/* ─── NEWSLETTER ────────────────────────────────────────── */
.newsletter-section { padding: 80px 0; background: #f8f9fa; }
.nl-input { flex: 1; min-width: 0; border: 2px solid #eee; border-radius: 14px; padding: 14px 20px; font-family: inherit; font-size: 0.95rem; transition: 0.25s; }
.nl-input:focus { border-color: #f39c12; outline: none; box-shadow: 0 0 0 4px rgba(243,156,18,0.08); }
.nl-btn { background: linear-gradient(135deg,#f39c12,#e67e22); color: #fff; border: none; padding: 14px 28px; border-radius: 14px; font-weight: 800; cursor: pointer; font-family: inherit; white-space: nowrap; transition: 0.3s; }
.nl-btn:hover { transform: scale(1.03); box-shadow: 0 8px 20px rgba(243,156,18,0.25); }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<header class="hero">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-800 mb-4" style="color: #111; font-weight: 800;">
                    Propulser l'<span class="text-gradient">Afrique</span> par le numérique
                </h1>
                <p class="lead text-muted mb-5">
                   DevAfrica Arena est le catalyseur de talents qui façonne les architectes technologiques de demain.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="<?php echo e(route('criteres')); ?>" class="btn btn-gold" style="background: linear-gradient(135deg,#f39c12,#e67e22); color:#fff; font-weight:800; padding:15px 35px; border-radius:15px; border:none; transition:0.3s; text-decoration:none;">
                        Critères de Participation
                    </a>
                    <a href="<?php echo e(route('a-propos')); ?>" class="btn btn-outline-dark" style="border-radius:15px; padding:15px 35px; font-weight:700;background-color:white">
                        Découvrir
                    </a>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-none d-lg-block" data-aos="fade-left">
                <div class="header-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800"
                         alt="Innovation" class="header-square-img">
                    <div class="img-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</header>



<section class="orientation-hub" id="orientation">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge bg-warning text-dark px-3 rounded-pill mb-2">ORIENTATION LIVE</span>
            <h2 class="fw-800 display-6">L'Arène des Talents</h2>
            <p class="text-muted">Réponds vite ! Le système analyse tes réflexes numériques.</p>
        </div>

        
        <div class="row g-4 mb-5" id="fields-grid">
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-dev">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-code-slash d-block h3 mb-2"></i>
                    <span class="small fw-bold">Web/Mobile</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-ia">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-cpu d-block h3 mb-2"></i>
                    <span class="small fw-bold">IA & Data</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-design">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-palette d-block h3 mb-2"></i>
                    <span class="small fw-bold">Design UX</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-com">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-megaphone d-block h3 mb-2"></i>
                    <span class="small fw-bold">Marketing</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-cyber">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-shield-lock d-block h3 mb-2"></i>
                    <span class="small fw-bold">Cyber</span>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 field-wrapper transition-all" id="field-fab">
                <div class="field-card-mini text-center p-3 rounded-4 border bg-white transition-all">
                    <i class="bi bi-tools d-block h3 mb-2"></i>
                    <span class="small fw-bold">IoT/Maker</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="quiz-box shadow-lg rounded-5 bg-white border-0">
                    <div id="timer-bar" style="display:none;"></div>
                    <div class="p-4 p-md-5">
                        <div id="quiz-ui">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="fw-bold mb-0 text-uppercase" style="letter-spacing:1px;" id="q-counter">Question 1/7</h6>
                                <div class="spinner-grow spinner-grow-sm text-warning" role="status"></div>
                            </div>
                            <h3 id="q-text" class="fw-800 mb-4" style="min-height: 80px; font-weight:800;">Préparation de l'analyse...</h3>
                            <div id="q-answers" class="d-grid gap-2"></div>
                        </div>
                        <div id="quiz-result" class="text-center py-4" style="display:none;">
                            <div class="roadmap-badge text-warning mb-3">RÉSULTAT ANALYSÉ</div>
                            <h2 id="res-profile" class="fw-800 text-gradient mb-3" style="font-weight:800;"></h2>
                            <p id="res-desc" class="text-muted mb-4"></p>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                <a href="<?php echo e(route('criteres')); ?>" style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;padding:12px 28px;border-radius:50px;font-weight:800;text-decoration:none;">
                                    Rejoindre l'Arena →
                                </a>
                                <button onclick="resetQuiz()" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">
                                    Redémarrer l'analyse
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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


<section class="newsletter-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4" data-aos="fade-up">
                    <span class="badge bg-warning text-dark px-3 rounded-pill mb-2">NEWSLETTER</span>
                    <h3 class="fw-800 mb-2" style="font-weight:800;">Restez dans la course Arena</h3>
                    <p class="text-muted">Dates des éditions, ouvertures d'inscriptions et résultats en avant-première.</p>
                </div>
                <?php if(session('newsletter_success')): ?>
                    <div class="alert rounded-4 fw-bold border-0 p-4 text-center" style="background:rgba(22,163,74,0.08);color:#16a34a;">
                        <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('newsletter_success')); ?>

                    </div>
                <?php elseif(session('newsletter_info')): ?>
                    <div class="alert rounded-4 fw-bold border-0 p-4 text-center" style="background:rgba(243,156,18,0.08);color:#f39c12;">
                        <i class="bi bi-info-circle-fill me-2"></i><?php echo e(session('newsletter_info')); ?>

                    </div>
                <?php else: ?>
                <form action="<?php echo e(route('newsletter.store')); ?>" method="POST" data-aos="fade-up">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex gap-2 flex-wrap flex-sm-nowrap">
                        <input type="email" name="email" class="nl-input" placeholder="Votre adresse email *" required value="<?php echo e(old('email')); ?>">
                        <button type="submit" class="nl-btn">S'abonner </button>
                    </div>
                    <p class="text-muted small mt-2 text-center"><i class="bi bi-shield-check me-1"></i>Zéro spam. Désinscription en 1 clic.</p>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<section class="partners-bar text-center">
    <div class="container" data-aos="fade-up">
        <span class="partner-label">Notre Partenaire Officiel</span>
        <div class="d-flex justify-content-center align-items-center">
            <img src="<?php echo e(asset('assets/logo_saei.png')); ?>" alt="SAEI CUBE" class="partner-logo-single">
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// ─── SNOW CANVAS (identique original) ──────────────────────────
const canvas = document.getElementById('snow-canvas');
const ctx = canvas.getContext('2d');
let particles = [];
function initSnow() {
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
function animateSnow() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
        ctx.fillStyle = `rgba(180, 180, 180, ${p.opacity})`;
        ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2); ctx.fill();
        p.y += p.speed; if(p.y > canvas.height) p.y = -10;
    });
    requestAnimationFrame(animateSnow);
}
initSnow(); animateSnow();
window.addEventListener('resize', initSnow);

// ─── COUNTDOWN ─────────────────────────────────────────────────
(function(){
    const el = document.getElementById('cd-target');
    if(!el) return;
    const target = new Date(el.value + 'T20:00:00');
    function tick(){
        const diff = target - new Date();
        if(diff <= 0){ ['d','h','m','s'].forEach(id => document.getElementById('cd-'+id).textContent = '00'); return; }
        const d=Math.floor(diff/86400000), h=Math.floor(diff%86400000/3600000),
              m=Math.floor(diff%3600000/60000), s=Math.floor(diff%60000/1000);
        document.getElementById('cd-d').textContent = String(d).padStart(2,'0');
        document.getElementById('cd-h').textContent = String(h).padStart(2,'0');
        document.getElementById('cd-m').textContent = String(m).padStart(2,'0');
        document.getElementById('cd-s').textContent = String(s).padStart(2,'0');
    }
    tick(); setInterval(tick, 1000);
})();

// ─── QUIZ (identique original) ─────────────────────────────────
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
const TIME_LIMIT = 80;

function startTimer() {
    // Minuteur désactivé — pas d'auto-pass, le candidat répond à son rythme
    clearInterval(timerInterval);
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
    document.getElementById("timer-bar").style.width = "0%";
    document.querySelectorAll('.field-wrapper').forEach(w => w.classList.remove('dimmed', 'highlight'));
    loadQuestion();
}

loadQuestion();

// ─── JOBS API ──────────────────────────────────────────────────
fetch("https://sheetdb.io/api/v1/qg4gis5u4esa6")
.then(response => response.json())
.then(data => {
    let container = document.getElementById("jobs-container");
    let html = "";
    data.forEach(job => {
        if(job.Titre){
            html += `
            <div class="job-card" data-aos="zoom-in">
                <img src="${job.Image}" alt="${job.Titre}" onerror="this.style.display='none'">
                <h3>${job.Titre}</h3>
                <div class="job-info"><i class="bi bi-building"></i> ${job.Entreprise}</div>
                <div class="job-info"><i class="bi bi-geo-alt"></i> ${job.Ville}</div>
                <div class="job-info"><i class="bi bi-clock"></i> ${job.Type}</div>
                <a href="${job.Lien}" target="_blank" rel="noopener">Postuler</a>
            </div>`;
        }
    });
    container.innerHTML = html || '<p class="text-muted">Aucune offre disponible.</p>';
    AOS.refresh();
})
.catch(() => { document.getElementById("jobs-container").innerHTML = '<p class="text-muted">Impossible de charger les offres.</p>'; });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\dev-africa-arena\resources\views/pages/home.blade.php ENDPATH**/ ?>