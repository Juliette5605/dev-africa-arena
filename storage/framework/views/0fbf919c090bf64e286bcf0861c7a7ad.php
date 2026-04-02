<?php $__env->startSection('title', "Logs d'activité"); ?>
<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="fw-bold mb-1">Logs d'activité</h4>
        <p class="text-muted small mb-0"><?php echo e($total); ?> entrée(s) au total — Historique des actions dans le panel.</p>
    </div>

    
    <?php if(auth('admin')->user()?->isSuperAdmin()): ?>
    <div class="dropdown">
        <button class="btn fw-bold rounded-3 px-4 py-2 dropdown-toggle"
                style="background:#f8f9fa;color:#555;font-size:0.85rem;"
                data-bs-toggle="dropdown">
            Nettoyer les logs
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2">
            <?php $__currentLoopData = ['7'=>'Supprimer les logs de + de 7 jours','30'=>'Supprimer les logs de + de 30 jours','90'=>'Supprimer les logs de + de 90 jours','all'=>'Tout supprimer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <form action="<?php echo e(route('admin.logs.clear')); ?>" method="POST"
                      onsubmit="return confirm('<?php echo e($label); ?> — Confirmer ?')">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="periode" value="<?php echo e($val); ?>">
                    <button type="submit" class="dropdown-item rounded-2 py-2 small fw-bold <?php echo e($val==='all'?'text-danger':''); ?>">
                        <?php echo e($label); ?>

                    </button>
                </form>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>
</div>


<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <select name="action" class="form-select rounded-3 border-0 bg-light">
            <option value="">Toutes les actions</option>
            <?php $__currentLoopData = ['créé','supprimé','modifié','lu','exporté','activé','connecté','déconnecté','testé','envoyé','uploadé','noté','sauvegardé']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($a); ?>" <?php echo e(request('action')===$a?'selected':''); ?>><?php echo e(ucfirst($a)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-4">
        <select name="subject" class="form-select rounded-3 border-0 bg-light">
            <option value="">Tous les sujets</option>
            <?php $__currentLoopData = ['Candidature','Message','Partenaire','Édition','Admin','Candidatures CSV','Configuration SMTP','Newsletter','Média','Base de données']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e(request('subject')===$s?'selected':''); ?>><?php echo e($s); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn w-100 fw-bold rounded-3"
                style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
            Filtrer
        </button>
    </div>
    <div class="col-md-2">
        <a href="<?php echo e(route('admin.logs')); ?>" class="btn w-100 btn-light fw-bold rounded-3">Reset</a>
    </div>
</form>

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:150px;">Date / Heure</th>
                <th>Admin</th>
                <th>Action</th>
                <th>Sujet</th>
                <th>Détail</th>
                <th>IP</th>
                <th style="width:60px;"></th>
            </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="text-muted small"><?php echo e($log->created_at->format('d/m/Y H:i:s')); ?></td>
            <td class="fw-bold small"><?php echo e($log->admin_name ?? '—'); ?></td>
            <td>
                <?php
                    $colors = [
                        'supprimé'=>'#dc2626','créé'=>'#16a34a','exporté'=>'#0284c7',
                        'activé'=>'#9333ea','lu'=>'#6b7280','connecté'=>'#f39c12',
                        'déconnecté'=>'#f97316','modifié'=>'#0891b2','testé'=>'#0284c7',
                        'envoyé'=>'#16a34a','uploadé'=>'#6366f1','noté'=>'#f59e0b',
                        'sauvegardé'=>'#059669',
                    ];
                    $c = $colors[$log->action] ?? '#888';
                ?>
                <span class="badge rounded-pill fw-bold px-3"
                      style="background:<?php echo e($c); ?>18;color:<?php echo e($c); ?>;font-size:0.72rem;">
                    <?php echo e($log->action); ?>

                </span>
            </td>
            <td class="small fw-bold"><?php echo e($log->subject); ?></td>
            <td class="text-muted small"><?php echo e($log->subject_detail ?? '—'); ?></td>
            <td class="text-muted small" style="font-family:monospace;"><?php echo e($log->ip ?? '—'); ?></td>
            <td>
                <?php if(auth('admin')->user()?->isSuperAdmin()): ?>
                <form action="<?php echo e(route('admin.logs.destroy', $log)); ?>" method="POST"
                      onsubmit="return confirm('Supprimer cette entrée ?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm rounded-2 px-2 py-1"
                            style="background:rgba(220,38,38,0.07);color:#dc2626;font-size:0.75rem;border:none;">
                        Suppr.
                    </button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="7" class="text-center text-muted py-5">Aucune activité enregistrée</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if($logs->hasPages()): ?>
<div class="mt-4"><?php echo e($logs->withQueryString()->links()); ?></div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/logs.blade.php ENDPATH**/ ?>