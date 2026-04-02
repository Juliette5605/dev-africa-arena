<?php $__env->startSection('title','Newsletter'); ?>
<?php $__env->startSection('page-title',' Abonnés Newsletter'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0"><strong><?php echo e($newsletters->total()); ?></strong> abonnés enregistrés</p>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Email</th><th>Nom</th><th>Statut</th><th>Date</th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="text-muted small"><?php echo e($n->id); ?></td>
            <td class="fw-bold"><?php echo e($n->email); ?></td>
            <td><?php echo e($n->nom ?? '—'); ?></td>
            <td>
                <?php if($n->confirmed): ?>
                    <span class="badge rounded-pill fw-bold px-3" style="background:#d1fae5;color:#065f46;">Confirmé</span>
                <?php else: ?>
                    <span class="badge rounded-pill fw-bold px-3" style="background:#fef3c7;color:#92400e;">En attente</span>
                <?php endif; ?>
            </td>
            <td class="small text-muted"><?php echo e($n->created_at->format('d/m/Y')); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="5" class="text-center text-muted py-5">Aucun abonné</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="p-3"><?php echo e($newsletters->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/admin/newsletters.blade.php ENDPATH**/ ?>