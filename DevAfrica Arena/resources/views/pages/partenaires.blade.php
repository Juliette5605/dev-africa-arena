@extends('layouts.app')

@section('title', 'Partenaires | DevAfrica Arena')

@push('styles')
<style>
    .hero-partners {
        padding: 180px 0 100px;
        position: relative;
        background: radial-gradient(circle at top right, rgba(243,156,18,0.08), transparent);
    }
    #snow-canvas { position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none; }
    .section-glass {
        background:rgba(255, 255, 255, 0.731);border:1px solid rgba(0,0,0,0.1);border-radius:30px;
        padding:60px;margin-top:-80px;position:relative;z-index:10;
        box-shadow:0 20px 40px rgba(0,0,0,0.05);
    }
    .btn-outline-custom {
        background:#ffffff;color:#000000!important;font-weight:800;
        padding:15px 35px;border-radius:15px;border-bottom-color: #eab509;transition:0.3s;text-decoration:none;display:inline-block;
    }
    .btn-outline-custom:hover { background:#ffffff;color:#050505!important; }
    .btn-gold-lg {
        background:#eab509;color:#ffffff!important;font-weight:800;
        padding:15px 35px;border-radius:15px;border:none;transition:0.3s;text-decoration:none;display:inline-block;
    }
    .btn-gold-lg:hover { transform:translateY(-3px);box-shadow:0 10px 20px rgba(243,156,18,0.2); }
</style>
@endpush

@section('content')
<header class="hero-partners">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position:relative;z-index:2;">
        <div class="text-center" data-aos="zoom-in">
            <h1 class="display-2 fw-bold mb-4" style="color:#222;font-weight:800;">Nos <span class="text-gradient">Alliés</span></h1>
            <p class="lead text-muted mx-auto" style="max-width:600px;">
                Ensemble, nous construisons le futur technologique de l'Afrique. Rejoignez l'écosystème.
            </p>
        </div>
    </div>
</header>

<section class="container mb-5">
    <div class="section-glass text-center" data-aos="fade-up">
        <h2 class="mb-5 fw-bold" style="color:#222;">Explorez notre réseau</h2>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ route('partenaires.financier') }}" class="btn-outline-custom">
                <i class="bi bi-cash-stack me-2"></i> Partenaires Financiers
            </a>
            <a href="{{ route('partenaires.techniques') }}" class="btn-outline-custom">
                <i class="bi bi-cpu me-2"></i> Partenaires Techniques
            </a>
            <a href="{{ route('partenaires.sponsors') }}" class="btn-gold-lg">
                <i class="bi bi-star-fill me-2"></i> Devenir Sponsor
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
const canvas=document.getElementById('snow-canvas'),ctx=canvas.getContext('2d');let particles=[];
function init(){canvas.width=window.innerWidth;canvas.height=window.innerHeight;particles=[];for(let i=0;i<100;i++)particles.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,size:Math.random()*3+1,speed:Math.random()*1+0.5,opacity:Math.random()*0.5+0.2});}
function animate(){ctx.clearRect(0,0,canvas.width,canvas.height);ctx.fillStyle='rgba(200,200,200,0.5)';particles.forEach(p=>{ctx.beginPath();ctx.arc(p.x,p.y,p.size,0,Math.PI*2);ctx.fill();p.y+=p.speed;if(p.y>canvas.height)p.y=-10;});requestAnimationFrame(animate);}
init();animate();window.addEventListener('resize',init);
</script>
@endpush
