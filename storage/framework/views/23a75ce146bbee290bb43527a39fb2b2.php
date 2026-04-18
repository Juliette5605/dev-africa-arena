<?php $__env->startSection('title','Messages'); ?>
<?php $__env->startSection('page-title',' Messages de contact'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Expéditeur</th><th>Email</th><th>Sujet</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td class="text-muted small"><?php echo e($m->id); ?></td>
            <td class="fw-bold"><?php echo e($m->nom); ?></td>
            <td class="small text-muted"><?php echo e($m->email); ?></td>
            <td class="small"><?php echo e(Str::limit($m->sujet, 50)); ?></td>
            <td class="small text-muted"><?php echo e($m->created_at->format('d/m/Y H:i')); ?></td>
            <td class="d-flex gap-1">
                <a href="<?php echo e(route('admin.messages.show', $m)); ?>" class="btn btn-sm btn-outline-dark rounded-pill">Lire</a>
                <form method="POST" action="<?php echo e(route('admin.messages.destroy', $m)); ?>" onsubmit="return confirm('Supprimer ?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6" class="text-center text-muted py-5">Aucun message</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="p-3"><?php echo e($messages->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/messages.blade.php ENDPATH**/ ?>