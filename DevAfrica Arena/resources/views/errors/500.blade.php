<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Erreur serveur | DevAfrica Arena</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#0a0a0a;color:#fff;min-height:100vh;display:flex;align-items:center;justify-content:center;overflow:hidden;}
        canvas{position:fixed;top:0;left:0;width:100%;height:100%;z-index:0;pointer-events:none;}
        .container{position:relative;z-index:1;text-align:center;padding:40px 20px;}
        .code{font-size:clamp(6rem,20vw,12rem);font-weight:800;line-height:1;background:linear-gradient(135deg,#ef4444,#dc2626);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
        .title{font-size:clamp(1.2rem,4vw,2rem);font-weight:800;margin:16px 0 12px;}
        .desc{color:rgba(255,255,255,0.5);font-size:1rem;max-width:420px;margin:0 auto 36px;}
        .btn{display:inline-block;background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;text-decoration:none;padding:14px 36px;border-radius:50px;font-weight:800;font-size:0.95rem;transition:0.3s;}
        .btn:hover{transform:scale(1.05);box-shadow:0 10px 30px rgba(243,156,18,0.3);}
    </style>
</head>
<body>
<canvas id="c"></canvas>
<div class="container">
    <div class="code">500</div>
    <h1 class="title">Erreur serveur</h1>
    <p class="desc">Une erreur inattendue s'est produite. Notre équipe technique a été notifiée. Réessayez dans quelques instants.</p>
    <a href="{{ route('home') }}" class="btn">Retour à l'accueil</a>
</div>
<script>
const c=document.getElementById('c'),x=c.getContext('2d');let p=[];
function init(){c.width=innerWidth;c.height=innerHeight;p=[];for(let i=0;i<50;i++)p.push({x:Math.random()*c.width,y:Math.random()*c.height,s:Math.random()*2+1,v:Math.random()*0.4+0.1,o:Math.random()*0.15+0.05});}
function draw(){x.clearRect(0,0,c.width,c.height);p.forEach(q=>{x.fillStyle=`rgba(239,68,68,${q.o})`;x.beginPath();x.arc(q.x,q.y,q.s,0,Math.PI*2);x.fill();q.y+=q.v;if(q.y>c.height)q.y=-5;});requestAnimationFrame(draw);}
init();draw();onresize=init;
</script>
</body>
</html>
