@extends('layouts.app')

@section('title', 'Nos Sponsors | DevAfrica Arena')

@push('styles')
<style>
    .page-header{padding:200px 0 80px;position:relative;background:radial-gradient(circle at center,rgba(243,156,18,0.05) 0%,#ffffff 100%);}
    #snow-canvas{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none;}
    .sponsor-card{border:1px solid rgba(0,0,0,0.06);border-radius:30px;padding:50px 40px;background:#fff;height:100%;transition:0.4s;position:relative;}
    .sponsor-card:hover{transform:translateY(-10px);border-color:#f39c12;box-shadow:0 20px 40px rgba(0,0,0,0.05);}
    .sponsor-platinum{background:#222222;color:white;border:2px solid #f39c12;transform:scale(1.03);}
    .sponsor-platinum .list-group-item{background:rgba(255,255,255,0.05);color:white;border-color:rgba(255,255,255,0.1);}
    .feature-icon{width:70px;height:70px;background:rgba(243,156,18,0.1);color:#f39c12;border-radius:20px;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 25px;}
    .sponsor-platinum .feature-icon{background:rgba(255,255,255,0.1);color:white;}
    .list-group-item{border:none;padding:12px 0;display:flex;align-items:center;gap:10px;font-weight:600;font-size:0.9rem;background:transparent;}
    .list-group-item i{color:#f39c12;}
    .sponsor-platinum .list-group-item i{color:#f39c12;}
    .cta-box{background:#f8f9fa;border-radius:40px;padding:60px;}
    /* Forcer le texte en noir dans les inputs et selects du modal */
#sponsorModal .form-control,
#sponsorModal .form-select {
    color: #000 !important;   /* texte saisi en noir */
    background-color: #ededed !important;   /* fond blanc pour contraste */
}

</style>
@endpush

@section('content')
<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position:relative;z-index:2;">
        <span class="badge bg-danger text-white mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">VISIBILITÉ MAXIMALE</span>
        <h1 class="display-3 fw-bold" data-aos="fade-up">Nos <span class="text-gradient">Sponsors</span></h1>
        <p class="lead text-muted mx-auto" style="max-width:800px;" data-aos="fade-up" data-aos-delay="100">
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
                    <h3 class="fw-bold" style="color: rgb(0, 0, 0) !important;">BRONZE</h3>
                    <p class="text-muted small" style="color: rgb(101, 101, 101) !important;">Soutien & Engagement</p>
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
                <div class="sponsor-card sponsor-platinum text-center shadow-lg position-relative">
                    <div class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold shadow">OFFRE ELITE</div>
                    <div class="feature-icon"><i class="bi bi-gem"></i></div>
                    <h3 class="fw-bold text-gradient">SPONSOR OR</h3>
                    <p class="text-muted small"style="color: rgb(101, 101, 101) !important;">Impact & Leadership</p>
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
                    <h3 class="fw-bold" style="color: rgb(7, 7, 7) !important;">ARGENT</h3>
                    <p class="text-muted small" style="color: rgb(101, 101, 101) !important;">Notoriété & Réseau</p>
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
            <h2 class="fw-bold mb-3" style="color: rgb(5, 5, 5) !important;">Prêt à devenir un partenaire clé ?</h2>
            <p class="text-muted mb-4 mx-auto" style="max-width:600px; color:#656565 !important;">
                Téléchargez notre dossier de sponsoring complet ou demandez un rendez-vous personnalisé.
            </p>
            <button class="btn btn-warning btn-lg px-5 fw-bold shadow rounded-pill" data-bs-toggle="modal" data-bs-target="#sponsorModal">
                DEMANDER LE DOSSIER
            </button>
        </div>
    </div>
</section>

{{-- MODAL --}}
<div class="modal fade" id="sponsorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
            <div class="modal-header p-4 border-0">
                <h4 class="fw-bold mb-0">Devenir Sponsor</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <form action="{{ route('partenaires.sponsors.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nom du responsable</label>
                        <input type="text" name="responsable" class="form-control py-3 bg-light border-0 shadow-none" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Entreprise</label>
                            <input type="text" name="entreprise" class="form-control py-3 bg-light border-0 shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">WhatsApp / Tel</label>
                            <input type="tel" name="telephone" class="form-control py-3 bg-light border-0 shadow-none" placeholder="+228..." required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Niveau envisagé</label>
                        <select name="niveau_sponsor" class="form-select py-3 bg-light border-0 shadow-none">
                            <option value="Sponsor OR">Sponsor OR (Élite)</option>
                            <option value="Sponsor ARGENT">Sponsor ARGENT</option>
                            <option value="Sponsor BRONZE">Sponsor BRONZE</option>
                            <option value="Sur mesure">Pack sur mesure</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Message ou question</label>
                        <textarea name="message" class="form-control py-3 bg-light border-0 shadow-none" rows="3"></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark py-3 fw-bold rounded-3">ENVOYER LA DEMANDE</button>
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
function i(){canvas.width=innerWidth;canvas.height=innerHeight;p=[];for(let j=0;j<70;j++)p.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,s:Math.random()*3+1,v:Math.random()*0.8+0.3});}
function a(){ctx.clearRect(0,0,canvas.width,canvas.height);ctx.fillStyle='rgba(243,156,18,0.08)';p.forEach(q=>{ctx.beginPath();ctx.arc(q.x,q.y,q.s,0,Math.PI*2);ctx.fill();q.y+=q.v;if(q.y>canvas.height)q.y=-10;});requestAnimationFrame(a);}
i();a();onresize=i;
</script>
@endpush
