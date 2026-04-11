
<?php $__env->startSection('title', 'Candidatures'); ?>
<?php $__env->startSection('page-title', ' Candidatures'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control rounded-pill"
                style="width:220px;" placeholder=" Nom, expertise...">
            <select name="niveau" class="form-select rounded-pill" style="width:170px;">
                <option value="">Tous les niveaux</option>
                <option <?php echo e(request('niveau') == 'Junior' ? 'selected' : ''); ?>>Junior</option>
                <option <?php echo e(request('niveau') == 'Intermédiaire' ? 'selected' : ''); ?>>Intermédiaire</option>
                <option <?php echo e(request('niveau') == 'Senior' ? 'selected' : ''); ?>>Senior</option>
            </select>
            <button class="btn btn-dark rounded-pill px-4 fw-bold">Filtrer</button>
            <?php if(request()->hasAny(['search', 'niveau'])): ?>
                <a href="<?php echo e(route('admin.candidatures')); ?>" class="btn btn-outline-secondary rounded-pill">✕ Reset</a>
            <?php endif; ?>
        </form>
        <a href="<?php echo e(route('admin.export.candidatures')); ?>" class="btn btn-warning fw-bold rounded-pill px-4">
            <i class="bi bi-download me-2"></i>Export CSV
        </a>
    </div>

    <div class="admin-table">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Candidat</th>
                    <th>Niveau</th>
                    <th>Expertise</th>
                    <th>Pays</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $candidatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="text-muted small"><?php echo e($c->id); ?></td>
                        <td>
                            <span class="fw-bold"><?php echo e($c->prenom); ?> <?php echo e($c->nom); ?></span>
                            <br><small class="text-muted"><?php echo e($c->age); ?> ans · <?php echo e($c->diplome); ?></small>
                        </td>
                        <td>
                            <span
                                class="badge fw-bold rounded-pill px-3 <?php echo e($c->niveau === 'Junior' ? 'badge-junior' : ($c->niveau === 'Senior' ? 'badge-senior' : 'badge-inter')); ?>">
                                <?php echo e($c->niveau); ?>

                            </span>
                        </td>
                        <td class="small text-muted"><?php echo e($c->expertise); ?></td>
                        <td class="small"><?php echo e($c->pays); ?></td>
                        <td class="small text-muted"><?php echo e($c->created_at->format('d/m/Y')); ?></td>
                        <td>
                            <a href="<?php echo e(route('admin.candidatures.show', $c)); ?>"
                                class="btn btn-sm btn-outline-dark rounded-pill me-1">Voir</a>
                            <form method="POST" action="<?php echo e(route('admin.candidatures.destroy', $c)); ?>" class="d-inline"
                                onsubmit="return confirm('Supprimer cette candidature ?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">Aucune candidature</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($candidatures->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\dev-africa-arena\resources\views/admin/candidatures.blade.php ENDPATH**/ ?>