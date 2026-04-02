<?php $__env->startSection('title', 'Gestion des Admins'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"> Gestion des Admins</h4>
        <p class="text-muted small mb-0">Maximum 2 sous-administrateurs. Vous seul pouvez leur accorder la délégation.</p>
    </div>
</div>


<?php if(session('success')): ?>
    <div class="alert border-0 rounded-4 fw-bold mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="alert border-0 rounded-4 fw-bold mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="row g-4">

    
    <?php if($subAdmins->count() < 2): ?>
    <div class="col-lg-5">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Créer un sous-admin
            </h6>
            <form action="<?php echo e(route('admin.admins.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nom complet</label>
                    <input type="text" name="name" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('name')); ?>" placeholder="Ex: Alex WILSON" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Adresse email</label>
                    <input type="email" name="email" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('email')); ?>" placeholder="email@exemple.com" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Mot de passe</label>
                    <input type="password" name="password" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Minimum 8 caractères" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Répétez le mot de passe" required>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Créer le sous-admin
                </button>
            </form>
        </div>
    </div>
    <?php else: ?>
    <div class="col-lg-5">
        <div class="admin-card p-4 text-center">
            <div style="font-size:3rem;">🔒</div>
            <h6 class="fw-bold mt-3">Limite atteinte</h6>
            <p class="text-muted small">Vous avez déjà 2 sous-admins. Supprimez-en un pour en créer un nouveau.</p>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="col-lg-7">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Sous-administrateurs (<?php echo e($subAdmins->count()); ?>/2)
            </h6>

            <?php $__empty_1 = true; $__currentLoopData = $subAdmins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-3"
                 style="background:#f8f9fa;border:1px solid #eee;">
                <div class="d-flex align-items-center gap-3">
                    
                    <div class="d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                         style="width:44px;height:44px;background:linear-gradient(135deg,#f39c12,#e67e22);font-size:1rem;flex-shrink:0;">
                        <?php echo e(strtoupper(substr($sub->name, 0, 1))); ?>

                    </div>
                    <div>
                        <div class="fw-bold" style="font-size:0.95rem;"><?php echo e($sub->name); ?></div>
                        <div class="text-muted small"><?php echo e($sub->email); ?></div>
                        <div class="mt-1">
                            <?php if($sub->can_edit): ?>
                                <span class="badge rounded-pill fw-bold px-3"
                                      style="background:rgba(22,163,74,0.12);color:#16a34a;font-size:0.7rem;">
                                     Délégation active — peut modifier
                                </span>
                            <?php else: ?>
                                <span class="badge rounded-pill fw-bold px-3"
                                      style="background:rgba(107,114,128,0.1);color:#6b7280;font-size:0.7rem;">
                                     Lecture seule
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-shrink-0">
                    
                    <form action="<?php echo e(route('admin.admins.delegate', $sub)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <button type="submit"
                                class="btn btn-sm fw-bold rounded-3 px-3"
                                style="<?php echo e($sub->can_edit
                                    ? 'background:rgba(220,38,38,0.1);color:#dc2626;border:1px solid rgba(220,38,38,0.2);'
                                    : 'background:rgba(22,163,74,0.1);color:#16a34a;border:1px solid rgba(22,163,74,0.2);'); ?>"
                                title="<?php echo e($sub->can_edit ? 'Révoquer la délégation' : 'Accorder la délégation'); ?>">
                            <?php echo e($sub->can_edit ? ' Révoquer' : ' Déléguer'); ?>

                        </button>
                    </form>

                    
                    <form action="<?php echo e(route('admin.admins.destroy', $sub)); ?>" method="POST"
                          onsubmit="return confirm('Supprimer ce sous-admin ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm fw-bold rounded-3 px-3"
                                style="background:rgba(220,38,38,0.08);color:#dc2626;border:1px solid rgba(220,38,38,0.15);">
                            🗑️
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 text-muted">
                <div style="font-size:2.5rem;">👤</div>
                <p class="mt-2 small">Aucun sous-admin créé pour l'instant.</p>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="mt-3 p-3 rounded-4" style="background:#fff8eb;border:1px dashed rgba(243,156,18,0.4);">
            <p class="mb-0 small" style="color:#92400e;">
                <strong> Délégation :</strong> En temps normal les sous-admins sont en <strong>lecture seule</strong>.
                Si vous êtes indisponible, activez la délégation pour leur accorder temporairement les droits de modification.
                Révoquez-la dès votre retour.
            </p>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/admins/index.blade.php ENDPATH**/ ?>