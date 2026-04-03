<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — DevAfrica Arena</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; }
        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            background: #0d0d0d; font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden; position: relative;
        }
        canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }
        .content { position: relative; z-index: 2; text-align: center; padding: 40px 20px; }
        .glitch {
            font-size: clamp(100px, 20vw, 180px); font-weight: 800; color: #f39c12;
            line-height: 1; position: relative;
            text-shadow: 0 0 60px rgba(243,156,18,0.4);
            animation: glitch 2s infinite;
        }
        @keyframes glitch {
            0%,90%,100% { text-shadow: 0 0 60px rgba(243,156,18,0.4); transform: none; }
            92% { text-shadow: -3px 0 #e74c3c, 3px 0 #3498db; transform: skew(-1deg); }
            94% { text-shadow: 3px 0 #e74c3c, -3px 0 #3498db; transform: skew(1deg); }
            96% { text-shadow: -3px 0 #e74c3c, 3px 0 #3498db; transform: skew(0deg); }
        }
        h2 { color: #fff; font-size: 1.5rem; font-weight: 700; margin: 10px 0 15px; }
        p { color: rgba(255,255,255,0.5); font-size: 1rem; margin-bottom: 35px; max-width: 400px; margin-left: auto; margin-right: auto; line-height: 1.7; }
        .btn-arena {
            display: inline-flex; align-items: center; gap: 10px;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: #fff; text-decoration: none; padding: 16px 35px;
            border-radius: 50px; font-weight: 800; font-size: 1rem;
            transition: 0.3s; box-shadow: 0 10px 30px rgba(243,156,18,0.3);
        }
        .btn-arena:hover { transform: translateY(-3px) scale(1.03); color: #fff; }
        .btn-outline {
            display: inline-flex; align-items: center; gap: 8px;
            border: 2px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.6);
            text-decoration: none; padding: 14px 30px; border-radius: 50px;
            font-weight: 700; font-size: 0.9rem; transition: 0.3s; margin-left: 15px;
        }
        .btn-outline:hover { border-color: #f39c12; color: #f39c12; }
        .code-badge {
            display: inline-block; background: rgba(243,156,18,0.1); border: 1px solid rgba(243,156,18,0.2);
            color: #f39c12; padding: 5px 18px; border-radius: 50px; font-size: 0.75rem;
            font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;
        }
    </style>
</head>
<body>
<canvas id="c"></canvas>
<div class="content">
    <div class="code-badge">Erreur 404</div>
    <div class="glitch">404</div>
    <h2>Page non trouvée</h2>
    <p>Cette page a quitté l'arène. Elle a peut-être été éliminée au premier tour du Grand Quiz…</p>
    <div>
        <a href="<?php echo e(url('/')); ?>" class="btn-arena">
            <i class="bi bi-house-fill"></i> Retour à l'Arena
        </a>
        <a href="<?php echo e(url('/criteres')); ?>" class="btn-outline">
            <i class="bi bi-trophy"></i> S'inscrire
        </a>
    </div>
</div>
<script>
const c = document.getElementById('c'), ctx = c.getContext('2d');
let p = [];
function init() {
    c.width = innerWidth; c.height = innerHeight; p = [];
    for (let i = 0; i < 80; i++) p.push({ x: Math.random()*c.width, y: Math.random()*c.height, s: Math.random()*2+0.5, v: Math.random()*0.6+0.2, o: Math.random()*0.4+0.1 });
}
function draw() {
    ctx.clearRect(0, 0, c.width, c.height);
    p.forEach(q => {
        ctx.fillStyle = `rgba(243,156,18,${q.o})`;
        ctx.beginPath(); ctx.arc(q.x, q.y, q.s, 0, Math.PI*2); ctx.fill();
        q.y += q.v; if (q.y > c.height) q.y = -10;
    });
    requestAnimationFrame(draw);
}
init(); draw(); onresize = init;
</script>
</body>
</html>
<?php /**PATH D:\dev-africa-arena-master\resources\views/errors/404.blade.php ENDPATH**/ ?>