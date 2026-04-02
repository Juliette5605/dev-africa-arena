@extends('layouts.app')

@section('title', 'Partenariat Technique | DevAfrica Arena')

@push('styles')
<style>
    .page-header{padding:200px 0 80px;position:relative;background:radial-gradient(circle at center,rgba(243,156,18,0.05) 0%,#ffffff 100%);}
    #snow-canvas{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none;}
    .section-title{font-weight:800;margin-bottom:30px;position:relative;}
    .section-title::after{content:'';position:absolute;bottom:-10px;left:0;width:60px;height:5px;background:var(--brand-gold);border-radius:2px;}
    .benefit-card{border:1px solid var(--glass-border);border-radius:25px;padding:35px;transition:0.3s;height:100%;background:#fff;text-align:center;}
    .benefit-card:hover{transform:translateY(-10px);border-color:var(--brand-gold);box-shadow:0 15px 30px rgba(0,0,0,0.05);}
    .benefit-card i{font-size:2.5rem;margin-bottom:20px;display:block;color:var(--brand-gold);}
    .tech-box{background:#f8f9fa;border-radius:30px;padding:40px;border-left:8px solid var(--brand-gold);box-shadow:0 10px 20px rgba(0,0,0,0.02);}
    .contact-card{background:var(--brand-dark);color:white;border-radius:40px;padding:60px;position:relative;overflow:hidden;}
</style>
@endpush

@section('content')
<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position:relative;z-index:2;">
        <span class="badge bg-dark text-white mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">EXPERTISE & INNOVATION</span>
        <h1 class="display-3 fw-bold" data-aos="fade-up">Partenariat <span class="text-gradient">Technique</span></h1>
        <p class="lead text-muted mx-auto" style="max-width:700px;" data-aos="fade-up" data-aos-delay="100">
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
                    DevAfrica Arena est bien plus qu'une compétition, c'est un <strong>laboratoire technologique</strong> grandeur nature. En tant que partenaire technique, vous devenez un acteur du changement numérique en Afrique.
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
            <h2 class="fw-bold mb-4">Prêt à co-construire l'Arena ?</h2>
            <p class="lead opacity-75 mb-5 mx-auto" style="max-width:700px;">
                Mettez à disposition vos ressources (Infrastructure, Expertise, Coaching) et devenez un pilier stratégique de cette édition 2026.
            </p>
            <button class="btn btn-warning btn-lg fw-bold rounded-pill px-5" data-bs-toggle="modal" data-bs-target="#techModal">PROPOSER UNE EXPERTISE</button>
        </div>
    </div>
</section>

{{-- MODAL --}}
<div class="modal fade" id="techModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header p-4 border-0">
                <h4 class="fw-bold mb-0">Partenariat Technique</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <form action="{{ route('partenaires.techniques.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Responsable Technique</label>
                        <input type="text" name="responsable" class="form-control py-3 bg-light border-0 shadow-none" placeholder="Nom complet" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Entreprise</label>
                            <input type="text" name="entreprise" class="form-control py-3 bg-light border-0 shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Téléphone</label>
                            <input type="tel" name="telephone" class="form-control py-3 bg-light border-0 shadow-none" placeholder="+228..." required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Type d'apport technique</label>
                        <select name="type_apport" class="form-select py-3 bg-light border-0 shadow-none">
                            <option value="Connectivité">Connectivité (Internet / WiFi)</option>
                            <option value="Cloud/Software">Cloud / SaaS / Licences</option>
                            <option value="Matériel">Hardware (Laptops / Écrans)</option>
                            <option value="Expertise">Mentoring / Jury d'experts</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Votre proposition</label>
                        <textarea name="message" class="form-control py-3 bg-light border-0 shadow-none" rows="3" placeholder="Comment souhaitez-vous contribuer ?"></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark py-3 fw-bold rounded-3">ENVOYER LA PROPOSITION</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const canvas=document.getElementById('snow-canvas'),ctx=canvas.getContext('2d');let p=[];
function i(){canvas.width=innerWidth;canvas.height=innerHeight;p=[];for(let j=0;j<50;j++)p.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,s:Math.random()*3,v:Math.random()*0.5+0.1});}
function a(){ctx.clearRect(0,0,canvas.width,canvas.height);ctx.fillStyle='rgba(243,156,18,0.1)';p.forEach(q=>{ctx.beginPath();ctx.arc(q.x,q.y,q.s,0,Math.PI*2);ctx.fill();q.y+=q.v;if(q.y>canvas.height)q.y=-5;});requestAnimationFrame(a);}
i();a();onresize=i;
</script>
@endpush
