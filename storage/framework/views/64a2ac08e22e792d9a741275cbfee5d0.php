

<?php $__env->startSection('title', 'Nos Valeurs | TalentSync AI'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    #snow-canvas { position:fixed;top:0;left:0;width:100%;height:100%;z-index:0;pointer-events:none; }
    .content-wrapper { position:relative;z-index:2; }
    .card-glass {
        background: rgba(255,255,255,0.9); border: 1px solid rgba(0,0,0,0.08);
        border-radius: 24px; padding: 35px; height: 100%; transition: 0.3s ease;
    }
    .card-glass:hover { transform: translateY(-10px); border-color: var(--gold); }
    .icon-box {
        width:60px;height:60px; background:rgba(243,156,18,0.1); color:var(--gold);
        border-radius:15px; display:flex;align-items:center;justify-content:center;
        margin-bottom:20px; font-size:1.5rem;
    }
    .table-custom { background: #222222; color:white; border-radius:24px; overflow:hidden; border:none; }
    .table-custom th { background:#1a1a1a; color:var(--gold); border:none; padding:20px; }
    .table-custom td { padding:20px; border-top:1px solid #333; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<canvas id="snow-canvas"></canvas>
<div class="content-wrapper">
    <header class="text-center" style="padding:160px 0 60px;">
        <div class="container">
            <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">POURQUOI NOUS CHOISIR ?</span>
            <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">Notre <span class="text-gradient">Valeur Ajoutée</span></h1>
            <p class="lead text-muted mx-auto" style="max-width:800px;" data-aos="fade-up" data-aos-delay="100">
                DevAfricaArena n'est pas qu'une plateforme de plus. C'est une révolution dans la manière d'évaluer, de connecter et de propulser les talents technologiques en Afrique grâce à l'intelligence de données.
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
                        <p class="small text-muted">Nous isolons la compétence technique brute. Pas de faux-semblants, juste une évaluation réelle de vos capacités.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-lightning-charge"></i></div>
                        <h5 class="fw-bold">Matching IA</h5>
                        <p class="small text-muted">Nos algorithmes connectent les profils aux opportunités les plus pertinentes en un temps record.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-arrow-repeat"></i></div>
                        <h5 class="fw-bold">Récurrence</h5>
                        <p class="small text-muted">Un cycle continu qui permet aux développeurs d'évoluer et de mettre à jour leur score de compétence régulièrement.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="card-glass">
                        <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                        <h5 class="fw-bold">Label Elite</h5>
                        <p class="small text-muted">Obtenez un badge de compétence certifié par TalentSync, reconnu par les recruteurs du secteur numérique.</p>
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
                                <th>Approche Classique</th>
                                <th class="text-warning text-uppercase">DevAfricaArena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Objectif Final</td>
                                <td class="opacity-75">CV statique / Simple profil</td>
                                <td class="text-warning fw-bold">Démonstration dynamique de Maîtrise</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Vitesse de Matching</td>
                                <td class="opacity-75">Lente (semaines)</td>
                                <td class="text-warning fw-bold">Instantanée (Algorithmique)</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Public ciblé</td>
                                <td class="opacity-75">Candidats génériques</td>
                                <td class="text-warning fw-bold">Développeurs d'Élite & Spécialisés</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Évaluation</td>
                                <td class="opacity-75">Subjective (lecture de CV)</td>
                                <td class="text-warning fw-bold">Technique (Code & Data)</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Fréquence</td>
                                <td class="opacity-75">Ponctuelle</td>
                                <td class="text-warning fw-bold">Flux Continu (Saisonnier)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const canvas=document.getElementById('snow-canvas'),ctx=canvas.getContext('2d');let particles=[];
function init(){canvas.width=window.innerWidth;canvas.height=window.innerHeight;particles=[];for(let i=0;i<60;i++)particles.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,size:Math.random()*2.5+1,speed:Math.random()*0.6+0.2,opacity:Math.random()*0.4});}
function animate(){ctx.clearRect(0,0,canvas.width,canvas.height);particles.forEach(p=>{ctx.fillStyle=`rgba(200,200,200,${p.opacity})`;ctx.beginPath();ctx.arc(p.x,p.y,p.size,0,Math.PI*2);ctx.fill();p.y+=p.speed;if(p.y>canvas.height)p.y=-10;});requestAnimationFrame(animate);}
window.addEventListener('resize',init);init();animate();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\dev-africa-arena-master\resources\views/pages/valeurs.blade.php ENDPATH**/ ?>