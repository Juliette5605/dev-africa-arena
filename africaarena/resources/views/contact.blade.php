<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact | DevAfrica Arena</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #f39c12;
            --brand-dark: #111111;
            --accent-gradient: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            --whatsapp-green: #25D366;
        }

        body { 
            background-color: #ffffff; 
            color: var(--brand-dark); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        #snow-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0; pointer-events: none;
        }

        .content-wrapper { position: relative; z-index: 2; }
        .text-gradient { background: var(--accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        .contact-card {
            background: var(--brand-dark);
            color: white;
            border-radius: 40px;
            padding: 50px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            margin-top: 50px;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            color: var(--brand-gold);
            transition: 0.3s;
        }

        .contact-info-item:hover .icon-box {
            background: var(--brand-gold);
            color: white;
            transform: rotate(-10deg);
        }

        /* Bouton WhatsApp Spécifique */
        .btn-whatsapp {
            background-color: var(--whatsapp-green);
            color: white;
            border: none;
            padding: 18px 35px;
            border-radius: 50px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:hover {
            background-color: #1eb954;
            color: white;
            transform: scale(1.05);
        }

        .btn-whatsapp i { font-size: 1.4rem; margin-right: 10px; }

        .form-control {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white !important;
            padding: 15px;
            border-radius: 12px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.08);
            border-color: var(--brand-gold);
            box-shadow: none;
        }

        .btn-send {
            background: var(--accent-gradient);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 700;
            width: 100%;
        }

    </style>
</head>
<body>

<canvas id="snow-canvas"></canvas>

<div class="content-wrapper">
    <nav class="container py-4">
        <a href="{{route('home')}}" class="text-decoration-none fw-bold text-dark">
            <i class="bi bi-arrow-left me-2"></i> Retour à l'Arène
        </a>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="display-3 fw-800">Parlons de votre <span class="text-gradient">Futur</span></h1>
            <p class="text-muted lead">Une question ? Un projet ? Contactez-nous directement.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="contact-card h-100">
                    <h3 class="mb-5 fw-bold">Contact Rapide</h3>
                    
                    <div class="contact-info-item">
                        <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="small text-muted text-uppercase">Email</div>
                            <div class="fw-bold">contact@devafrica.arena</div>
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
                        <a href="https://wa.me/228XXXXXXXX" target="_blank" class="btn-whatsapp">
                            <i class="bi bi-whatsapp"></i> Discuter sur WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="p-4 p-md-5">
                    <h3 class="fw-bold mb-4">Envoyez un message</h3>
                    <form action="https://formspree.io/f/maqnreqk" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-bold small">Nom Complet</label>
                                <input type="text" name="nom" class="form-control bg-light text-dark border-secondary-subtle" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark fw-bold small">Email</label>
                                <input type="email" name="email" class="form-control bg-light text-dark border-secondary-subtle" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-bold small">Sujet</label>
                                <input type="text" name="sujet" class="form-control bg-light text-dark border-secondary-subtle" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-bold small">Message</label>
                                <textarea name="message" rows="5" class="form-control bg-light text-dark border-secondary-subtle" required></textarea>
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800 });

    // Script Neige
    const canvas = document.getElementById('snow-canvas');
    const ctx = canvas.getContext('2d');
    let particles = [];
    function initSnow() {
        canvas.width = window.innerWidth; canvas.height = window.innerHeight;
        particles = [];
        for(let i=0; i<40; i++) {
            particles.push({
                x: Math.random() * canvas.width, y: Math.random() * canvas.height,
                size: Math.random() * 2 + 1, speed: Math.random() * 0.4 + 0.1, opacity: Math.random() * 0.2
            });
        }
    }
    function animateSnow() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => {
            ctx.fillStyle = `rgba(180, 180, 180, ${p.opacity})`;
            ctx.beginPath(); ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2); ctx.fill();
            p.y += p.speed; if(p.y > canvas.height) p.y = -5;
        });
        requestAnimationFrame(animateSnow);
    }
    window.addEventListener('resize', initSnow);
    initSnow(); animateSnow();
</script>
</body>
</html>