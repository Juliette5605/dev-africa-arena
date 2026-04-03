@extends('layouts.app')

@section('title', 'Contact | DevAfrica Arena')

@push('styles')
<style>
    #snow-canvas{position:fixed;top:0;left:0;width:100%;height:100%;z-index:0;pointer-events:none;}
    .content-wrapper{position:relative;z-index:2;}
    .contact-card{background:#222222;color:white;border-radius:40px;padding:50px;box-shadow:0 30px 60px rgba(0,0,0,0.15);margin-top:50px;}
    .contact-info-item{display:flex;align-items:center;margin-bottom:30px;}
    .icon-box{width:60px;height:60px;background:rgba(255,255,255,0.1);border-radius:15px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-right:20px;color:#f39c12;transition:0.3s;}
    .contact-info-item:hover .icon-box{background:#f39c12;color:white;transform:rotate(-10deg);}
    .btn-whatsapp{background-color:#25D366;color:white;border:none;padding:18px 35px;border-radius:50px;font-weight:800;display:inline-flex;align-items:center;text-decoration:none;transition:0.3s;box-shadow:0 10px 20px rgba(37,211,102,0.3);}
    .btn-whatsapp:hover{background-color:#1eb954;color:white;transform:scale(1.05);}
    .btn-whatsapp i{font-size:1.4rem;margin-right:10px;}
    .form-control-contact{background:#f8f9fa;border:1px solid #eee;color:#111!important;padding:15px;border-radius:12px;width:100%;margin-bottom:1rem;}
    .form-control-contact:focus{border-color:#f39c12;box-shadow:none;outline:none;}
    label.form-label{font-weight:700;font-size:0.85rem;text-transform:uppercase;color:#555;letter-spacing:0.5px;}
    .btn-send{background:linear-gradient(135deg,#f39c12,#e67e22);color:white;border:none;padding:15px 30px;border-radius:50px;font-weight:700;width:100%;font-size:1rem;cursor:pointer;transition:0.3s;}
    .btn-send:hover{transform:translateY(-2px);box-shadow:0 10px 20px rgba(243,156,18,0.2);}
</style>
@endpush

@section('content')
<canvas id="snow-canvas"></canvas>
<div class="content-wrapper">
    <div class="container py-5" style="padding-top:120px!important;">
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="display-3 fw-bold" style="font-weight:800;">Parlons de votre <span class="text-gradient">Futur</span></h1>
            <p class="text-muted lead">Une question ? Un projet ? Contactez-nous directement.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-4 py-3 fw-bold text-center mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="contact-card h-100">
                    <h3 class="mb-5 fw-bold">Contact Rapide</h3>

                    <div class="contact-info-item">
                        <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="small text-muted text-uppercase">Email</div>
                            <div class="fw-bold">wilsoncodemosaic@gmail.com</div>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="icon-box"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="small text-muted text-uppercase">Téléphone</div>
                            <div class="fw-bold">+228 71 15 50 55</div>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="small text-muted text-uppercase">Localisation</div>
                            <div class="fw-bold">Lomé, Togo</div>
                        </div>
                    </div>

                    <hr class="my-5 opacity-10">

                    <div class="text-center">
                        <p class="mb-4 text-muted">Pour une réponse immédiate :</p>
                        <a href="https://wa.me/22871155055" target="_blank" class="btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> Discuter sur WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="p-4 p-md-5">
                    <h3 class="fw-bold mb-4">Envoyez un message</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom Complet</label>
                                <input type="text" name="nom" class="form-control-contact" value="{{ old('nom') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control-contact" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Sujet</label>
                                <input type="text" name="sujet" class="form-control-contact" value="{{ old('sujet') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message</label>
                                <textarea name="message" rows="5" class="form-control-contact" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-send">Envoyer le message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const canvas=document.getElementById('snow-canvas'),ctx=canvas.getContext('2d');let p=[];
function i(){canvas.width=innerWidth;canvas.height=innerHeight;p=[];for(let j=0;j<40;j++)p.push({x:Math.random()*canvas.width,y:Math.random()*canvas.height,s:Math.random()*2+1,v:Math.random()*0.4+0.1,o:Math.random()*0.2});}
function a(){ctx.clearRect(0,0,canvas.width,canvas.height);p.forEach(q=>{ctx.fillStyle=`rgba(180,180,180,${q.o})`;ctx.beginPath();ctx.arc(q.x,q.y,q.s,0,Math.PI*2);ctx.fill();q.y+=q.v;if(q.y>canvas.height)q.y=-5;});requestAnimationFrame(a);}
i();a();onresize=i;
</script>
@endpush
