<?php $__env->startSection('title', 'Paramètres'); ?>
<?php $__env->startSection('page-title', ' Paramètres du site'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<form action="<?php echo e(route('admin.settings.update')); ?>" method="POST">
<?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
<div class="row g-4">

    
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Informations générales</h6>
            <?php $__currentLoopData = ['site_name'=>'Nom du site','site_slogan'=>'Slogan','site_email'=>'Email de contact','site_phone'=>'Téléphone','site_address'=>'Adresse']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3">
                <label class="form-label fw-bold small"><?php echo e($label); ?></label>
                <input type="<?php echo e($key==='site_email'?'email':'text'); ?>" name="<?php echo e($key); ?>"
                       class="form-control rounded-3 border-0 bg-light py-3"
                       value="<?php echo e(old($key, $settings[$key]->value ?? '')); ?>" required>
                <?php $__errorArgs = [$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="admin-card p-4 mb-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">🏆 Compétition</h6>
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label fw-bold small">Cash Prize (FCFA)</label>
                    <input type="text" name="cash_prize" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('cash_prize', $settings['cash_prize']->value ?? '350 000')); ?>">
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold small">Max candidats/édition</label>
                    <input type="number" name="max_candidats" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('max_candidats', $settings['max_candidats']->value ?? '100')); ?>" min="1">
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold small">Nombre de finalistes</label>
                    <input type="number" name="nb_finalistes" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('nb_finalistes', $settings['nb_finalistes']->value ?? '6')); ?>" min="1">
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold small">Jours de compétition</label>
                    <input type="number" name="nb_jours" class="form-control rounded-3 border-0 bg-light py-3"
                           value="<?php echo e(old('nb_jours', $settings['nb_jours']->value ?? '2')); ?>" min="1">
                </div>
            </div>
        </div>

        
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Réseaux sociaux</h6>
            <?php $__currentLoopData = ['facebook'=>' Facebook','linkedin'=>' LinkedIn','instagram'=>' Instagram','twitter'=>' Twitter/X']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3">
                <label class="form-label fw-bold small"><?php echo e($label); ?></label>
                <input type="url" name="<?php echo e($key); ?>" class="form-control rounded-3 border-0 bg-light py-3"
                       value="<?php echo e(old($key, $settings[$key]->value ?? '')); ?>"
                       placeholder="https://...">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Newsletter par défaut</h6>
            <div class="mb-3">
                <label class="form-label fw-bold small">Objet par défaut des newsletters</label>
                <input type="text" name="newsletter_subject" class="form-control rounded-3 border-0 bg-light py-3"
                       value="<?php echo e(old('newsletter_subject', $settings['newsletter_subject']->value ?? '')); ?>">
            </div>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="admin-card p-4" style="<?php echo e(($settings['maintenance_mode']->value??'0')==='1'?'border:2px solid #ef4444;':''); ?>">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Mode Maintenance</h6>
            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3" style="background:#fff5f5;border:1px solid rgba(239,68,68,0.2);">
                <div>
                    <p class="fw-bold mb-0 small">Activer le mode maintenance</p>
                    <p class="text-muted mb-0" style="font-size:0.78rem;">Le site public affichera un message de maintenance. Le panel admin reste accessible.</p>
                </div>
                <div class="form-check form-switch ms-auto">
                    <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maint"
                           <?php echo e(($settings['maintenance_mode']->value??'0')==='1'?'checked':''); ?> style="width:48px;height:24px;cursor:pointer;">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small">Message affiché pendant la maintenance</label>
                <textarea name="maintenance_msg" class="form-control rounded-3 border-0 bg-light py-3" rows="3"><?php echo e(old('maintenance_msg', $settings['maintenance_msg']->value ?? '')); ?></textarea>
            </div>
        </div>
    </div>

</div>

<div class="mt-4">
    <button type="submit" class="btn px-5 fw-bold py-3 rounded-3"
            style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;font-size:1rem;">
         Sauvegarder tous les paramètres
    </button>
</div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/admin/settings.blade.php ENDPATH**/ ?>