@extends('layouts.app')

@section('title', 'Partenariat Financier | DevAfrica Arena')

@push('styles')
<style>
    .page-header{padding:200px 0 80px;position:relative;background:radial-gradient(circle at center,rgba(243,156,18,0.05) 0%,#ffffff 100%);}
    #snow-canvas{position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none;}
    .pack-card{background:#fff;border:1px solid var(--glass-border);border-radius:30px;padding:40px;transition:0.4s;height:100%;display:flex;flex-direction:column;box-shadow:0 10px 30px rgba(0,0,0,0.02);}
    .pack-card:hover{transform:translateY(-10px);border-color:#f39c12;box-shadow:0 20px 40px rgba(0,0,0,0.05);}
    .pack-card{background:#fff;border:1px solid rgba(0,0,0,0.08);border-radius:30px;padding:40px;transition:0.4s;height:100%;display:flex;flex-direction:column;box-shadow:0 10px 30px rgba(0,0,0,0.02);}
    .pack-diamond{background:#222222;color:white;border:2px solid #f39c12;}
    .pack-diamond .text-muted{color:rgba(255,255,255,0.6)!important;}
    .price-tag{font-size:2rem;font-weight:800;margin-bottom:15px;}
    .price-currency{font-size:1rem;font-weight:400;opacity:0.8;}
    .benefit-icon{width:60px;height:60px;background:#fff8eb;color:#f39c12;border-radius:18px;display:flex;align-items:center;justify-content:center;margin-bottom:25px;font-size:1.8rem;}
    .pack-diamond .benefit-icon{background:rgba(255,255,255,0.1);}
    .form-control:focus{box-shadow:none;border-color:var(--brand-gold);}
</style>
@endpush

@section('content')
<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position:relative;z-index:2;">
        <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">OPPORTUNITÉ 2026</span>
        <h1 class="display-3 fw-bold" data-aos="fade-up">Partenariat <span class="text-gradient">Financier</span></h1>
        <p class="lead text-muted mx-auto" style="max-width:800px;" data-aos="fade-up" data-aos-delay="100">
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
                    <h3 class="fw-bold">Pack SILVER</h3>
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
                <div class="pack-card pack-diamond shadow-lg position-relative">
                    <div class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark px-4 py-2 rounded-pill fw-bold">LE PLUS PRISÉ</div>
                    <div class="benefit-icon"><i class="bi bi-gem"></i></div>
                    <h3 class="fw-bold text-gradient">Pack DIAMOND</h3>
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
                    <h3 class="fw-bold">Pack GOLD</h3>
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
            <button class="btn btn-warning btn-lg px-5 py-3 shadow fw-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#financeModal">
                REJOINDRE L'AVENTURE
            </button>
        </div>
    </div>
</section>

{{-- MODAL Formulaire --}}
<div class="modal fade" id="financeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header p-4 border-0 text-center">
                <h4 class="fw-bold mb-0 w-100">Devenir Partenaire</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 pt-0">
                <form action="{{ route('partenaires.financier.store') }}" method="POST" id="finance-form">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Responsable</label>
                        <input type="text" name="responsable" class="form-control py-3 bg-light border-0" placeholder="Nom & Prénom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Email professionnel</label>
                        <input type="email" name="email" class="form-control py-3 bg-light border-0" placeholder="contact@entreprise.com" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Entreprise</label>
                            <input type="text" name="entreprise" class="form-control py-3 bg-light border-0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Téléphone</label>
                            <input type="tel" name="telephone" class="form-control py-3 bg-light border-0" placeholder="+228..." required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Pack souhaité</label>
                        <select name="pack" class="form-select py-3 bg-light border-0">
                            <option value="DIAMOND">Pack DIAMOND - 250.000 FCFA</option>
                            <option value="GOLD">Pack GOLD - 150.000 FCFA</option>
                            <option value="SILVER">Pack SILVER - 100.000 FCFA</option>
                        </select>
                    </div>
                    <div class="d-grid mt-4">
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
function i(){canvas.width=innerWidth;canvas.height=innerHeight;p=[];for(let j=0;j<60;j++)p.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,s:Math.random()*3,v:Math.random()*0.5+0.1});}
function a(){ctx.clearRect(0,0,canvas.width,canvas.height);ctx.fillStyle='rgba(243,156,18,0.1)';p.forEach(q=>{ctx.beginPath();ctx.arc(q.x,q.y,q.s,0,Math.PI*2);ctx.fill();q.y+=q.v;if(q.y>canvas.height)q.y=-5;});requestAnimationFrame(a);}
i();a();onresize=i;
</script>
@endpush
