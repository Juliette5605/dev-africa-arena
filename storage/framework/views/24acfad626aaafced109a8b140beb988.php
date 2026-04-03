<?php $__env->startSection('title', 'Mon Profil'); ?>
<?php $__env->startSection('page-title', ' Mon Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">

    
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Informations personnelles
            </h6>
            <?php if(session('success')): ?>
            <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>
            <form action="<?php echo e(route('admin.profile.update.info')); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nom complet</label>
                    <input type="text" name="name" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('name', $admin->name)); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Adresse email</label>
                    <input type="email" name="email" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('email', $admin->email)); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-4 p-3 rounded-3" style="background:#f8f9fa;">
                    <p class="small mb-1 text-muted">Rôle</p>
                    <span class="fw-bold">
                        <?php if($admin->isSuperAdmin()): ?>  Super Administrateur
                        <?php else: ?>  Sous-administrateur <?php echo e($admin->can_edit ? '(délégation active)' : '(lecture seule)'); ?>

                        <?php endif; ?>
                    </span>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Mettre à jour les informations
                </button>
            </form>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Changer le mot de passe
            </h6>
            <form action="<?php echo e(route('admin.profile.update.password')); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="••••••••" required>
                    <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nouveau mot de passe</label>
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
                    <label class="form-label fw-bold small">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Répéter le mot de passe" required>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:#222;color:white;">
                    Changer le mot de passe
                </button>
            </form>
        </div>

        
        <div class="admin-card p-4 mt-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Informations du compte
            </h6>
            <div class="d-flex justify-content-between py-2 border-bottom">
                <span class="text-muted small">Compte créé le</span>
                <span class="small fw-bold"><?php echo e($admin->created_at->format('d/m/Y')); ?></span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom">
                <span class="text-muted small">Dernière mise à jour</span>
                <span class="small fw-bold"><?php echo e($admin->updated_at->format('d/m/Y H:i')); ?></span>
            </div>
            <div class="d-flex justify-content-between py-2">
                <span class="text-muted small">ID Admin</span>
                <span class="small fw-bold">#<?php echo e($admin->id); ?></span>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/profile.blade.php ENDPATH**/ ?>