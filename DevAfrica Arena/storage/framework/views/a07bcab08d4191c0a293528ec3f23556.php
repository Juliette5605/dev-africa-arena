<?php $__env->startSection('title', 'Configuration Email'); ?>
<?php $__env->startSection('content'); ?>

<div class="mb-4">
    <h4 class="fw-bold mb-1">Configuration Email SMTP</h4>
    <p class="text-muted small mb-0">Configurez l'envoi d'emails pour les confirmations de candidature et les newsletters.</p>
</div>

<?php if(session('success')): ?>
<div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<div class="row g-4">

    
    <div class="col-lg-7">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                Paramètres SMTP
            </h6>

            <form action="<?php echo e(route('admin.smtp.update')); ?>" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>

                
                <div class="mb-4">
                    <label class="form-label fw-bold small">Mode d'envoi</label>
                    <div class="d-flex gap-2 flex-wrap">
                        <?php $__currentLoopData = [
                            'log'      => 'Log local (dev)',
                            'smtp'     => 'SMTP (Gmail/custom)',
                            'mailtrap' => 'Mailtrap (tests)'
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-bold small"
                               style="cursor:pointer;border:2px solid <?php echo e($config['mailer']===$val?'#f39c12':'#eee'); ?>;background:<?php echo e($config['mailer']===$val?'#fff8eb':'#fff'); ?>;">
                            <input type="radio" name="mailer" value="<?php echo e($val); ?>"
                                   <?php echo e($config['mailer']===$val?'checked':''); ?>

                                   onchange="toggleSmtp(this.value)">
                            <?php echo e($label); ?>

                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="text-muted small mt-2">
                        Mode <strong>Log local</strong> : les emails ne sont pas envoyés, ils s'enregistrent dans
                        <code>storage/logs/laravel.log</code>. Utilisez ce mode uniquement en développement.
                    </p>
                </div>

                
                <div id="smtp-fields" style="<?php echo e($config['mailer']==='log'?'display:none':''); ?>">
                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold small">Hôte SMTP</label>
                            <input type="text" name="host" class="form-control rounded-3 border-0 bg-light py-3"
                                   value="<?php echo e(old('host', $config['host'])); ?>"
                                   placeholder="smtp.gmail.com">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Port</label>
                            <input type="number" name="port" class="form-control rounded-3 border-0 bg-light py-3"
                                   value="<?php echo e(old('port', $config['port'])); ?>" placeholder="587">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Nom d'utilisateur (votre adresse Gmail)</label>
                            <input type="text" name="username" class="form-control rounded-3 border-0 bg-light py-3"
                                   value="<?php echo e(old('username', $config['username'])); ?>"
                                   placeholder="votre@gmail.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Mot de passe d'application (16 caractères)</label>
                            <input type="password" name="password" class="form-control rounded-3 border-0 bg-light py-3"
                                   placeholder="Laisser vide pour ne pas modifier">
                            <p class="text-muted small mt-1">Ne pas mettre votre mot de passe Gmail — générez un "mot de passe d'application" depuis votre compte Google.</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Chiffrement</label>
                        <select name="encryption" class="form-select rounded-3 border-0 bg-light py-3">
                            <option value="tls" <?php echo e($config['encryption']==='tls'?'selected':''); ?>>TLS (recommandé pour Gmail — port 587)</option>
                            <option value="ssl" <?php echo e($config['encryption']==='ssl'?'selected':''); ?>>SSL (port 465)</option>
                            <option value=""   <?php echo e($config['encryption']===''?'selected':''); ?>>Aucun</option>
                        </select>
                    </div>
                </div>

                
                <div class="row g-3 mb-4">
                    <div class="col-md-7">
                        <label class="form-label fw-bold small">Email expéditeur</label>
                        <input type="email" name="from" class="form-control rounded-3 border-0 bg-light py-3"
                               value="<?php echo e(old('from', $config['from'])); ?>"
                               placeholder="arena@devafrica.tg" required>
                        <p class="text-muted small mt-1">Pour Gmail, mettez votre adresse Gmail ici aussi.</p>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold small">Nom expéditeur</label>
                        <input type="text" name="from_name" class="form-control rounded-3 border-0 bg-light py-3"
                               value="<?php echo e(old('from_name', $config['from_name'])); ?>"
                               placeholder="DevAfrica Arena" required>
                    </div>
                </div>

                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Sauvegarder la configuration
                </button>
            </form>
        </div>
    </div>

    
    <div class="col-lg-5">

        
        <div class="admin-card p-4 mb-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                Tester l'envoi
            </h6>
            <form action="<?php echo e(route('admin.smtp.test')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Envoyer un email de test à</label>
                    <input type="email" name="test_email" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="votre@email.com" required>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:#222;color:white;">
                    Envoyer le test
                </button>
                <p class="text-muted small mt-2 text-center">
                    Sauvegardez d'abord la configuration avant de tester.
                </p>
            </form>
        </div>

        
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                Guide de configuration
            </h6>

            <div class="mb-3 p-3 rounded-3" style="background:#fff8eb;border:1px solid rgba(243,156,18,0.3);">
                <p class="fw-bold small mb-2" style="color:#f39c12;">Gmail (recommandé)</p>
                <ol class="small text-muted mb-2 ps-3">
                    <li class="mb-1">Aller sur <strong>myaccount.google.com</strong></li>
                    <li class="mb-1">Sécurité → Validation en 2 étapes (activer si pas fait)</li>
                    <li class="mb-1">Rechercher "Mots de passe des applications" → Générer</li>
                    <li class="mb-1">Copier le mot de passe de 16 caractères généré</li>
                    <li>Coller ce mot de passe dans le champ "Mot de passe d'application" ci-contre</li>
                </ol>
                <div class="p-2 rounded-2" style="background:rgba(243,156,18,0.08);font-size:0.78rem;">
                    Hôte : <strong>smtp.gmail.com</strong> &nbsp;|&nbsp;
                    Port : <strong>587</strong> &nbsp;|&nbsp;
                    Chiffrement : <strong>TLS</strong>
                </div>
            </div>

            <div class="p-3 rounded-3" style="background:#f0f9ff;border:1px solid rgba(2,132,199,0.2);">
                <p class="fw-bold small mb-2" style="color:#0284c7;">Mailtrap (pour les tests)</p>
                <ol class="small text-muted mb-0 ps-3">
                    <li class="mb-1">Créer un compte gratuit sur <strong>mailtrap.io</strong></li>
                    <li class="mb-1">Email Testing → Inboxes → Show Credentials</li>
                    <li class="mb-1">Copier Host, Port, Username, Password</li>
                    <li>Les emails arrivent dans Mailtrap, pas dans les vraies boîtes</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleSmtp(val) {
    document.getElementById('smtp-fields').style.display = val === 'log' ? 'none' : 'block';
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/smtp.blade.php ENDPATH**/ ?>