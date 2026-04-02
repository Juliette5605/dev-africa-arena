<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance | DevAfrica Arena</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#0a0a0a;color:#fff;min-height:100vh;display:flex;align-items:center;justify-content:center;}
        canvas{position:fixed;top:0;left:0;width:100%;height:100%;z-index:0;pointer-events:none;}
        .box{position:relative;z-index:1;text-align:center;padding:40px 20px;max-width:500px;}
        .icon{font-size:5rem;margin-bottom:20px;animation:spin 4s linear infinite;}
        @keyframes spin{0%,100%{transform:rotate(0deg)}50%{transform:rotate(10deg)}}
        h1{font-size:2rem;font-weight:800;margin-bottom:12px;}
        .gold{color:#f39c12;}
        p{color:rgba(255,255,255,0.5);line-height:1.7;font-size:1rem;}
        .badge{display:inline-block;background:rgba(243,156,18,0.15);color:#f39c12;padding:8px 24px;border-radius:50px;font-weight:800;font-size:0.8rem;letter-spacing:1px;margin-bottom:24px;}
    </style>
</head>
<body>
<canvas id="c"></canvas>
<div class="box">
    <div class="icon">🚧</div>
    <div class="badge">MAINTENANCE EN COURS</div>
    <h1>DevAfrica <span class="gold">Arena</span></h1>
    <p><?php echo e($message); ?></p>
</div>
<script>
const c=document.getElementById('c'),x=c.getContext('2d');let p=[];
function init(){c.width=innerWidth;c.height=innerHeight;p=[];for(let i=0;i<40;i++)p.push({x:Math.random()*c.width,y:Math.random()*c.height,s:Math.random()*2+1,v:Math.random()*0.3+0.1,o:Math.random()*0.1+0.03});}
function draw(){x.clearRect(0,0,c.width,c.height);p.forEach(q=>{x.fillStyle=`rgba(243,156,18,${q.o})`;x.beginPath();x.arc(q.x,q.y,q.s,0,Math.PI*2);x.fill();q.y+=q.v;if(q.y>c.height)q.y=-5;});requestAnimationFrame(draw);}
init();draw();onresize=init;
</script>
</body>
</html>
<?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/errors/maintenance.blade.php ENDPATH**/ ?>