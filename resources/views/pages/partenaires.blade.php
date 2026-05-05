@extends('layouts.app')

@section('title', 'Partenaires | DevAfricaArena')

@push('styles')
<style>
    .hero-partners {
        height:60vh;display:flex;align-items:center;position:relative;
        background:radial-gradient(circle at 50% 50%,#ffffff 0%,#f8f9fa 100%);overflow:hidden;
    }
    #snow-canvas { position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none; }
    .section-glass {
        background:rgba(255,255,255,0.9);border:1px solid rgba(0,0,0,0.1);border-radius:30px;
        padding:60px;margin-top:-80px;position:relative;z-index:10;
        box-shadow:0 20px 40px rgba(0,0,0,0.05);
    }
    
    /* Boutons corrigés */
    .explore-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
    }
    
    .btn-explore {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
    }
    
    /* Bouton Partenaires Financiers */
    .btn-financier {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .btn-financier:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #5a67d8 0%, #6b46a0 100%);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    /* Bouton Partenaires Techniques */
    .btn-technique {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
    }
    
    .btn-technique:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #e8799a 0%, #e94560 100%);
        box-shadow: 0 8px 25px rgba(245, 87, 108, 0.4);
        color: white;
    }
    
    /* Bouton Devenir Sponsor - Version Gold */
    .btn-sponsor {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        color: #2d3748;
        box-shadow: 0 4px 15px rgba(246, 211, 101, 0.3);
    }
    
    .btn-sponsor:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #ffd700 0%, #ff8c00 100%);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        color: #1a202c;
    }
    
    /* Style alternatif avec les couleurs du site (si var(--brand-gold) est défini) */
    .btn-outline-custom {
        background: transparent;
        border: 2px solid var(--brand-gold, #f39c12);
        color: var(--brand-gold, #f39c12) !important;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-outline-custom:hover {
        background: var(--brand-gold, #f39c12);
        color: white !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(243, 156, 18, 0.3);
        border-color: var(--brand-gold, #f39c12);
    }
    
    .btn-gold-lg {
        background: linear-gradient(135deg, var(--brand-gold, #f39c12) 0%, var(--brand-orange, #e67e22) 100%);
        color: white !important;
        font-weight: 800;
        padding: 1rem 2rem;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-gold-lg:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(243, 156, 18, 0.3);
        background: linear-gradient(135deg, var(--brand-orange, #e67e22) 0%, var(--brand-gold, #f39c12) 100%);
        color: white;
    }
    
    /* Améliorations responsives */
    @media (max-width: 768px) {
        .btn-explore, .btn-outline-custom, .btn-gold-lg {
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            width: 100%;
            justify-content: center;
        }
        
        .explore-buttons {
            gap: 1rem;
        }
        
        .section-glass {
            padding: 30px 20px;
        }
    }
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
        <div class="explore-buttons">
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