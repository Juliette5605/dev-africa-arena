
<?php $__env->startSection('title','Message #'.$message->id); ?>
<?php $__env->startSection('page-title',' Message complet'); ?>
<?php $__env->startSection('content'); ?>
<a href="<?php echo e(route('admin.messages')); ?>" class="btn btn-outline-secondary rounded-pill mb-4"><i class="bi bi-arrow-left me-2"></i>Retour</a>
<div class="stat-card" style="max-width:700px;">
    <div class="mb-4">
        <span class="text-muted small">De</span>
        <h5 class="fw-bold mb-0"><?php echo e($message->nom); ?></h5>
        <a href="mailto:<?php echo e($message->email); ?>" class="text-warning fw-bold small"><?php echo e($message->email); ?></a>
    </div>
    <div class="mb-4">
        <span class="text-muted small">Sujet</span>
        <p class="fw-bold mb-0 fs-5"><?php echo e($message->sujet); ?></p>
    </div>
    <div class="p-4 rounded-3" style="background:#f8f9fa;line-height:1.8;"><?php echo e($message->message); ?></div>
    <p class="text-muted small mt-3 mb-0"><i class="bi bi-clock me-1"></i>Reçu le <?php echo e($message->created_at->format('d/m/Y à H:i')); ?></p>
    <div class="mt-4 d-flex gap-2">
        <a href="mailto:<?php echo e($message->email); ?>?subject=Re: <?php echo e($message->sujet); ?>" class="btn btn-warning fw-bold rounded-pill px-4">
            <i class="bi bi-reply-fill me-2"></i>Répondre
        </a>
        <form method="POST" action="<?php echo e(route('admin.messages.destroy', $message)); ?>" onsubmit="return confirm('Supprimer ?')">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button class="btn btn-outline-danger rounded-pill px-4">Supprimer</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\dev-africa-arena\resources\views/admin/message-show.blade.php ENDPATH**/ ?>