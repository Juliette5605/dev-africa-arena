<?php $__env->startSection('title', 'Éditions'); ?>
<?php $__env->startSection('page-title', ' Éditions DevAfrica Arena'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="stat-card">
                <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                    Nouvelle édition</h6>
                <form method="POST" action="<?php echo e(route('admin.editions.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nom</label>
                        <input type="text" name="nom" class="form-control rounded-3" placeholder="Édition #1 — Saison 2026"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Date Sélection (Jour 1)</label>
                        <input type="date" name="date_selection" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Date Finale (Jour 2)</label>
                        <input type="date" name="date_finale" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Lieu</label>
                        <input type="text" name="lieu" class="form-control rounded-3" value="Lomé, Togo">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="active" value="1" id="activeCheck">
                        <label class="form-check-label fw-bold" for="activeCheck">Activer immédiatement</label>
                    </div>
                    <button type="submit" class="btn btn-warning fw-bold rounded-pill w-100">Créer l'édition</button>
                </form>
            </div>
        </div>

        
        <div class="col-lg-8">
            <div class="admin-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Édition</th>
                            <th>Sélection</th>
                            <th>Finale</th>
                            <th>Lieu</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $editions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-bold"><?php echo e($e->nom); ?></td>
                                <td class="small"><?php echo e($e->date_selection->format('d/m/Y')); ?></td>
                                <td class="small"><?php echo e($e->date_finale->format('d/m/Y')); ?></td>
                                <td class="small text-muted"><?php echo e($e->lieu); ?></td>
                                <td>
                                    <?php if($e->active): ?>
                                        <span class="badge rounded-pill fw-bold px-3" style="background:#d1fae5;color:#065f46;">●
                                            Active</span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill fw-bold px-3"
                                            style="background:#f3f4f6;color:#888;">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex gap-1">
                                    <?php if(!$e->active): ?>
                                        <form method="POST" action="<?php echo e(route('admin.editions.activate', $e)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button class="btn btn-sm btn-outline-warning rounded-pill fw-bold">Activer</button>
                                        </form>
                                    <?php endif; ?>
                                    <form method="POST" action="<?php echo e(route('admin.editions.destroy', $e)); ?>"
                                        onsubmit="return confirm('Supprimer ?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Aucune édition créée</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/editions.blade.php ENDPATH**/ ?>