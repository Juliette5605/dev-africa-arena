@extends('layouts.app')
@section('title', 'Éditions | DevAfrica Arena')

@push('styles')
<style>
    .page-header { padding:180px 0 80px; position:relative; background:radial-gradient(circle at top right,rgba(243,156,18,0.08),transparent); }
    #snow-canvas { position:absolute;top:0;left:0;width:100%;height:100%;z-index:1;pointer-events:none; }
    .edition-card { background:#fff; border:1px solid #eee; border-radius:24px; padding:32px; transition:0.3s; position:relative; overflow:hidden; }
    .edition-card:hover { border-color:#f39c12; box-shadow:0 15px 40px rgba(0,0,0,0.06); transform:translateY(-5px); }
    .edition-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(135deg,#f39c12,#e67e22); }
    .edition-active::before { height:6px; }
    .timeline-dot { width:14px;height:14px;border-radius:50%;background:#f39c12;flex-shrink:0;margin-top:6px; }
    .timeline-line { width:2px;background:#eee;flex-grow:1;margin:4px auto; }
</style>
@endpush

@section('content')
<header class="page-header text-center">
    <canvas id="snow-canvas"></canvas>
    <div class="container" style="position:relative;z-index:2;">
        <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold" data-aos="fade-down">HISTORIQUE</span>
        <h1 class="display-3 fw-bold" data-aos="fade-up" style="font-weight:800;">
            Toutes les <span class="text-gradient">Éditions</span>
        </h1>
        <p class="lead text-muted mx-auto" style="max-width:600px;" data-aos="fade-up" data-aos-delay="100">
            Retracez l'histoire du premier championnat technologique de Lomé.
        </p>
    </div>
</header>

<section class="py-5">
    <div class="container">
        @if($editions->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:4rem;"></div>
            <h4 class="fw-bold mt-3">La première édition arrive bientôt</h4>
            <p class="text-muted">Soyez parmi les premiers à postuler.</p>
            <a href="{{ route('criteres') }}" class="btn btn-gold mt-3"
               style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;padding:14px 36px;border-radius:15px;font-weight:800;text-decoration:none;">
                Postuler maintenant
            </a>
        </div>
        @else
        <div class="row g-4">
            @foreach($editions as $edition)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="edition-card {{ $edition->active ? 'edition-active' : '' }}">
                    @if($edition->active)
                    <span class="badge mb-3 px-3 py-2 rounded-pill fw-bold"
                          style="background:rgba(243,156,18,0.1);color:#f39c12;font-size:0.72rem;">
                         ÉDITION EN COURS
                    </span>
                    @endif
                    <h4 class="fw-bold mb-2">{{ $edition->nom }}</h4>
                    <div class="d-flex gap-4 mb-3 flex-wrap">
                        <div>
                            <p class="text-muted small mb-0"> Lieu</p>
                            <p class="fw-bold mb-0 small">{{ $edition->lieu }}</p>
                        </div>
                        <div>
                            <p class="text-muted small mb-0"> Sélection</p>
                            <p class="fw-bold mb-0 small">{{ $edition->date_selection?->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-muted small mb-0"> Finale</p>
                            <p class="fw-bold mb-0 small">{{ $edition->date_finale?->format('d M Y') }}</p>
                        </div>
                    </div>
                    @if($edition->active)
                    <a href="{{ route('criteres') }}"
                       style="display:inline-block;background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;padding:10px 24px;border-radius:50px;font-weight:800;text-decoration:none;font-size:0.88rem;">
                        Postuler →
                    </a>
                    @else
                    <span class="badge px-3 py-2 rounded-pill fw-bold"
                          style="background:#f8f9fa;color:#888;font-size:0.72rem;">Édition terminée</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
const canvas=document.getElementById('snow-canvas'),ctx=canvas.getContext('2d');let p=[];
function init(){canvas.width=innerWidth;canvas.height=innerHeight;p=[];for(let i=0;i<60;i++)p.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,s:Math.random()*2+1,v:Math.random()*0.5+0.2,o:Math.random()*0.2+0.05});}
function draw(){ctx.clearRect(0,0,canvas.width,canvas.height);p.forEach(q=>{ctx.fillStyle=`rgba(243,156,18,${q.o})`;ctx.beginPath();ctx.arc(q.x,q.y,q.s,0,Math.PI*2);ctx.fill();q.y+=q.v;if(q.y>canvas.height)q.y=-5;});requestAnimationFrame(draw);}
init();draw();onresize=init;
</script>
@endpush
