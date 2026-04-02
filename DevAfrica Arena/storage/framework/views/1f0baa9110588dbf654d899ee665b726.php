<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> — DevAfrica Arena</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root { --gold:#f39c12; --sidebar-w:260px; }
        * { box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:#f5f5f7; margin:0; overflow-x:hidden; }

        /* SIDEBAR (Structure du 2ème avec style du 1er) */
        .sidebar { position:fixed;left:0;top:0;height:100vh;width:var(--sidebar-w);background:#111;overflow-y:auto;z-index:200;display:flex;flex-direction:column; }
        .sidebar::-webkit-scrollbar{width:4px;} .sidebar::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:4px;}
        
        .sidebar-brand { padding:24px 20px 16px;border-bottom:1px solid rgba(255,255,255,0.05); }
        .sidebar-brand h2 { color:#fff;font-size:1.1rem;font-weight:800;margin:0; }
        .sidebar-brand p { color:rgba(255,255,255,0.3);font-size:0.65rem;text-transform:uppercase;letter-spacing:2px;margin:4px 0 0; }
        
        .sidebar-search { padding:12px 15px; }
        .sidebar-search input { 
            width:100%;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 8px 12px;
            color: #fff;
            font-size: 0.8rem;
            outline: none;
        }

        .sidebar-section { padding:12px 15px 4px; }
        .sidebar-label { font-size:0.62rem;font-weight:800;color:rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:2px;padding:0 8px 8px; }
        .sidebar-link { display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;color:rgba(255,255,255,0.55);font-size:0.82rem;font-weight:600;text-decoration:none;transition:0.2s;width:100%; }
        .sidebar-link i { font-size:0.95rem;width:18px;text-align:center;flex-shrink:0; }
        .sidebar-link:hover { background:rgba(255,255,255,0.06);color:#fff; }
        .sidebar-link.active { background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff; }
        
        .sidebar-badge { margin-left:auto;background:rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);padding:2px 8px;border-radius:20px;font-size:0.65rem;font-weight:800; }
        .sidebar-footer { margin-top:auto;padding:12px 15px 20px;border-top:1px solid rgba(255,255,255,0.05); }

        /* MAIN CONTENT */
        .main-content { margin-left:var(--sidebar-w);min-height:100vh; }
        .topbar { background:#fff;border-bottom:1px solid #eee;padding:16px 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:0 2px 10px rgba(0,0,0,0.04); }
        .topbar-title { font-weight:800;font-size:1.1rem; }
        .page-body { padding:28px; }

        @media(max-width:991px){
            .sidebar{transform:translateX(-100%);}
            .main-content{margin-left:0;}
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<?php
    $maintenanceOn       = \App\Models\Setting::get('maintenance_mode') === '1';
    $unread_candidatures = \App\Models\Candidature::unread()->count();
    $unread_messages     = \App\Models\ContactMessage::unread()->count();
    $total_alerts        = $unread_candidatures + $unread_messages;
?>

<?php if($maintenanceOn): ?>
<div style="background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;text-align:center;padding:8px;font-weight:700;font-size:0.82rem;position:fixed;top:0;left:0;right:0;z-index:999;">
    🚧 MODE MAINTENANCE ACTIF — DevAfrica Arena est en pause.
    <a href="<?php echo e(route('admin.settings')); ?>" style="color:#fff;margin-left:8px;text-decoration:underline;">Gérer →</a>
</div>
<div style="height:34px;"></div>
<?php endif; ?>

<aside class="sidebar">
    <div class="sidebar-brand">
        <h2>DevAfrica Arena</h2>
        <p>Talent Matching Platform</p>
    </div>

    <div class="sidebar-search">
        <form action="<?php echo e(route('admin.search')); ?>" method="GET">
            <input type="text" name="q" placeholder="Recherche globale..." value="<?php echo e(request('q')); ?>">
        </form>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Principal</div>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
        <a href="<?php echo e(route('admin.candidatures')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.candidatures*') ? 'active' : ''); ?>">
            <i class="bi bi-people-fill"></i> Candidatures
            <span class="sidebar-badge <?php echo e($unread_candidatures > 0 ? 'bg-danger text-white' : ''); ?>">
                <?php echo e($unread_candidatures > 0 ? $unread_candidatures . ' new' : \App\Models\Candidature::count()); ?>

            </span>
        </a>
        <a href="<?php echo e(route('admin.finalistes')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.finalistes') ? 'active' : ''); ?>">
            <i class="bi bi-trophy-fill"></i> Finalistes
            <span class="sidebar-badge"><?php echo e(\App\Models\Candidature::where('finaliste',true)->count()); ?>/<?php echo e(\App\Models\Setting::get('nb_finalistes',6)); ?></span>
        </a>
        <a href="<?php echo e(route('admin.partenaires')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.partenaires*') ? 'active' : ''); ?>">
            <i class="bi bi-building"></i> Partenaires
        </a>
        <a href="<?php echo e(route('admin.messages')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.messages*') ? 'active' : ''); ?>">
            <i class="bi bi-chat-dots-fill"></i> Messages
            <?php if($unread_messages > 0): ?>
                <span class="sidebar-badge bg-danger text-white"><?php echo e($unread_messages); ?></span>
            <?php endif; ?>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Événement</div>
        <a href="<?php echo e(route('admin.editions')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.editions*') ? 'active' : ''); ?>">
            <i class="bi bi-calendar-event-fill"></i> Éditions
        </a>
        <a href="<?php echo e(route('admin.newsletters')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.newsletters*') ? 'active' : ''); ?>">
            <i class="bi bi-envelope-fill"></i> Newsletter
        </a>
        <?php if(auth('admin')->user()?->isSuperAdmin()): ?>
        <a href="<?php echo e(route('admin.newsletter.broadcast')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.newsletter.broadcast*') ? 'active' : ''); ?>">
            <i class="bi bi-send-fill"></i> Envoyer newsletter
        </a>
        <?php endif; ?>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Outils & Système</div>
        <?php if(auth('admin')->user()?->canManage()): ?>
        <a href="<?php echo e(route('admin.export.candidatures')); ?>" class="sidebar-link">
            <i class="bi bi-download"></i> Export CSV
        </a>
        <a href="<?php echo e(route('admin.backup.database')); ?>" class="sidebar-link">
            <i class="bi bi-database-fill-down"></i> Backup BDD
        </a>
        <a href="<?php echo e(route('admin.media.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.media*') ? 'active' : ''); ?>">
            <i class="bi bi-images"></i> Médiathèque
        </a>
        <?php endif; ?>
        <a href="<?php echo e(route('admin.logs')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.logs') ? 'active' : ''); ?>">
            <i class="bi bi-clock-history"></i> Logs d'activité
        </a>
        <a href="<?php echo e(route('home')); ?>" target="_blank" class="sidebar-link">
            <i class="bi bi-box-arrow-up-right"></i> Voir le site
        </a>
    </div>

    <?php if(auth('admin')->user()?->isSuperAdmin()): ?>
    <div class="sidebar-section">
        <div class="sidebar-label">Configuration</div>
        <a href="<?php echo e(route('admin.admins.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.admins*') ? 'active' : ''); ?>">
            <i class="bi bi-shield-lock-fill"></i> Gérer les admins
        </a>
        <a href="<?php echo e(route('admin.settings')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.settings*') ? 'active' : ''); ?>">
            <i class="bi bi-gear-fill"></i> Paramètres
        </a>
    </div>
    <?php endif; ?>

    <div class="sidebar-footer">
        <a href="<?php echo e(route('admin.profile')); ?>" class="sidebar-link mb-2">
            <i class="bi bi-person-circle"></i> Mon profil
        </a>
        <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="sidebar-link w-100 border-0" style="background:rgba(239,68,68,0.1);color:#ef4444;cursor:pointer;">
                <i class="bi bi-power"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>

<div class="main-content">
    <div class="topbar">
        <span class="topbar-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></span>
        <div class="d-flex align-items-center gap-3">
            <?php if($total_alerts > 0): ?>
            <a href="<?php echo e(route('admin.candidatures', ['lu'=>'non'])); ?>" class="text-decoration-none">
                <span class="badge rounded-pill fw-bold px-3 py-2" style="background:rgba(239,68,68,0.1);color:#ef4444;">
                    <i class="bi bi-bell-fill me-1"></i><?php echo e($total_alerts); ?> alertes
                </span>
            </a>
            <?php endif; ?>
            <span class="small text-muted d-none d-md-block"><?php echo e(auth('admin')->user()?->name); ?></span>
        </div>
    </div>

    <div class="page-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-admin mb-4">
                <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-admin mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:600,once:true});</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/admin/layout.blade.php ENDPATH**/ ?>