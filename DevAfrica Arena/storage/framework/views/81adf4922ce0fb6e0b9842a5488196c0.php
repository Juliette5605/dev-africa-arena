<?php $__env->startSection('title', 'À Propos | TalentSync AI - L\'Intelligence des Talents'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .page-header {
        padding: 180px 0 100px;
        position: relative;
        background: radial-gradient(circle at top right, rgba(243,156,18,0.08), transparent);
    }
    #snow-canvas { position: absolute; top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none; }
    .card-glass {
        background: rgba(255, 255, 255, 0.461); border: 1px solid var(--glass-border);
        border-radius: 24px; padding: 30px; height: 100%; transition: 0.4s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    .card-glass:hover { border-color: var(--gold); transform: translateY(-10px); }
    .badge-step {
        background: var(--gold); color: white; padding: 6px 16px;
        border-radius: 50px; font-size: 0.75rem; font-weight: 800;
        margin-bottom: 20px; display: inline-block;
    }
    .section-light { background-color: #fcfcfc; border-top: 1px solid #f0f0f000; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position:relative;z-index:2;">
        <h1 class="display-3 fw-bold" style="font-weight:800;" data-aos="fade-up">
            L'Intelligence des <span class="text-gradient">Talents Numériques</span>
        </h1>
        <p class="lead text-muted mx-auto" style="max-width:800px;" data-aos="fade-up" data-aos-delay="100">
            La plateforme intelligente basée à Lomé qui connecte les meilleurs experts tech aux opportunités de demain via une évaluation de haute précision.
        </p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="fw-bold mb-4">Pourquoi DevAfrica Arena ?</h2>
                <p class="text-muted fs-5">
                    Au Togo, le potentiel technologique est immense, mais la mise en relation reste un défi. Les entreprises cherchent des compétences certifiées et les développeurs un moyen de prouver leur valeur réelle.
                </p>
                <p class="text-muted fs-5">
                    <strong>DevAfrica Arena</strong> répond à ce besoin en automatisant le matching et en certifiant les compétences techniques par des tests rigoureux et une analyse de données poussée.
                </p>
                <div class="row mt-4">
                    <div class="col-6">
                        <h3 class="text-gradient fw-bold">Expertise</h3>
                        <p class="small text-uppercase fw-bold">Vérifiée par IA</p>
                    </div>
                    <div class="col-6">
                        <h3 class="text-gradient fw-bold">Continue</h3>
                        <p class="small text-uppercase fw-bold">Disponibilité</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card-glass">
                    <h4 class="fw-bold mb-4">Nos Objectifs</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color:#e67e22"></i> Identifier l'excellence technique sur le marché.</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color:#e67e22;"></i> Optimiser le processus de recrutement tech.</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color:#e67e22;"></i> Digitaliser le suivi de carrière des développeurs.</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color:#e67e22;"></i> Propulser l'innovation locale à l'international.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 section-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Le Processus <span class="text-gradient">DevAfrica Arena</span></h2>
            <p class="text-muted">Un parcours fluide vers l'opportunité idéale.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6" data-aos="fade-up">
                <div class="card-glass" style="background:#ffffffdc">
                    <span class="badge-step">ÉTAPE 1 : ÉVALUATION</span>
                    <h4 class="fw-bold" style="color: #000000";>Audit Technique</h4>
                    <p class="text" style="color: #878787"><strong>Tests Algorithmiques</strong><br>Analyse approfondie de la logique de code et de la résolution de problèmes complexes.</p>
                    <p class="text" style="color: #828282"><strong>Profilage de Compétences</strong><br>Cartographie précise de votre stack technologique et de votre niveau d'expertise.</p>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-glass" style="background:#222222;color:white;border-color:#222222;">
                    <span class="badge-step">ÉTAPE 2 : CONNEXION</span>
                    <h4 class="fw-bold text-white">Matching Intelligent</h4>
                    <p class="text-light opacity-75 small"><strong>Algorithme de Synchronisation</strong><br>Mise en relation directe avec les projets et entreprises correspondant à votre profil.</p>
                    <p class="text-light opacity-75 small"><strong>Certification</strong><br>Délivrance d'un label de qualité TalentSync reconnu par nos partenaires.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const canvas = document.getElementById('snow-canvas');
const ctx = canvas.getContext('2d');
let particles = [];
function init() {
    canvas.width=window.innerWidth; canvas.height=window.innerHeight; particles=[];
    for(let i=0;i<80;i++) particles.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,size:Math.random()*3+1,speed:Math.random()*0.8+0.3});
}
function animate() {
    ctx.clearRect(0,0,canvas.width,canvas.height); ctx.fillStyle='rgba(200,200,200,0.3)';
    particles.forEach(p=>{ ctx.beginPath();ctx.arc(p.x,p.y,p.size,0,Math.PI*2);ctx.fill();p.y+=p.speed;if(p.y>canvas.height)p.y=-10; });
    requestAnimationFrame(animate);
}
init(); animate(); window.addEventListener('resize',init);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/pages/a-propos.blade.php ENDPATH**/ ?>