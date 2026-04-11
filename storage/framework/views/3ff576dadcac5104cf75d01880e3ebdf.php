
<?php $__env->startSection('title','Partenaires'); ?>
<?php $__env->startSection('page-title',' Partenaires & Sponsors'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Responsable</th><th>Entreprise</th><th>Téléphone</th><th>Type</th><th>Détail</th><th>Date</th><th></th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $partenaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="text-muted small"><?php echo e($p->id); ?></td>
            <td class="fw-bold"><?php echo e($p->responsable); ?></td>
            <td><?php echo e($p->entreprise); ?></td>
            <td class="small"><?php echo e($p->telephone); ?></td>
            <td>
                <?php if($p->type==='financier'): ?>
                    <span class="badge rounded-pill fw-bold px-3" style="background:#fff3e0;color:#f39c12;">Financier</span>
                <?php elseif($p->type==='technique'): ?>
                    <span class="badge rounded-pill fw-bold px-3" style="background:#e0f2fe;color:#0284c7;">Technique</span>
                <?php else: ?>
                    <span class="badge rounded-pill fw-bold px-3" style="background:#fdf4ff;color:#9333ea;">Sponsor</span>
                <?php endif; ?>
            </td>
            <td class="small text-muted">
                <?php if($p->pack): ?> Pack <?php echo e($p->pack); ?>

                <?php elseif($p->niveau_sponsor): ?> <?php echo e($p->niveau_sponsor); ?>

                <?php elseif($p->type_apport): ?> <?php echo e($p->type_apport); ?>

                <?php endif; ?>
            </td>
            <td class="small text-muted"><?php echo e($p->created_at->format('d/m/Y')); ?></td>
            <td>
                <form method="POST" action="<?php echo e(route('admin.partenaires.destroy', $p)); ?>" onsubmit="return confirm('Supprimer ?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8" class="text-center text-muted py-5">Aucun partenaire</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="p-3"><?php echo e($partenaires->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\dev-africa-arena\resources\views/admin/partenaires.blade.php ENDPATH**/ ?>