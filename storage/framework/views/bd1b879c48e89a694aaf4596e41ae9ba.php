

<?php $__env->startSection('title', 'Gestion des Votes'); ?>
<?php $__env->startSection('page-title', 'Classement & Votes en temps réel'); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-4 mb-4">
    <div class="col-md-4 col-xl-2">
        <div class="stat-card shadow-sm border-0 bg-white p-3 rounded">
            <div class="stat-icon bg-warning text-white mb-2"><i class="bi bi-trophy"></i></div>
            <div class="stat-value fw-bold fs-4"><?php echo e(number_format($stats['total_votes'] ?? 0)); ?></div>
            <div class="stat-label text-muted small">Total Votes</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-2">
        <div class="stat-card shadow-sm border-0 bg-white p-3 rounded">
            <div class="stat-icon bg-success text-white mb-2"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-value fw-bold fs-4"><?php echo e(number_format($stats['total_montant'] ?? 0)); ?></div>
            <div class="stat-label text-muted small">FCFA Récoltés</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-2">
        <div class="stat-card shadow-sm border-0 bg-white p-3 rounded">
            <div class="stat-icon bg-primary text-white mb-2"><i class="bi bi-people"></i></div>
            <div class="stat-value fw-bold fs-4"><?php echo e($stats['votes_public'] ?? 0); ?></div>
            <div class="stat-label text-muted small">Public</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-2">
        <div class="stat-card shadow-sm border-0 bg-white p-3 rounded">
            <div class="stat-icon bg-info text-white mb-2"><i class="bi bi-star"></i></div>
            <div class="stat-value fw-bold fs-4"><?php echo e($stats['votes_sponsor'] ?? 0); ?></div>
            <div class="stat-label text-muted small">Sponsors</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-2">
        <div class="stat-card shadow-sm border-0 bg-white p-3 rounded">
            <div class="stat-icon bg-dark text-white mb-2"><i class="bi bi-person-check"></i></div>
            <div class="stat-value fw-bold fs-4"><?php echo e($stats['votes_jury'] ?? 0); ?></div>
            <div class="stat-label text-muted small">Jury</div>
        </div>
    </div>
    <div class="col-md-4 col-xl-2">
        <div class="h-100 d-flex align-items-center">
            <a href="<?php echo e(route('admin.votes.export')); ?>" class="btn btn-outline-dark w-100 py-3 shadow-sm">
                <i class="bi bi-download me-2"></i> Export CSV
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    
    <div class="col-lg-8">
        <div class="admin-table shadow-sm border-0 bg-white rounded">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-800">CLASSEMENT ACTUEL</h5>
                <span class="badge bg-soft-warning text-warning border">Live Ranking</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="table-light">
                            <th>Rang</th>
                            <th>Candidat</th>
                            <th class="text-center">Points</th>
                            <th class="text-center">Votes</th>
                            <th>Actions Lien</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $classement; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $candidat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-bold fs-5 text-muted">#<?php echo e($index + 1); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-size: 14px;">
                                        <?php echo e(strtoupper(substr($candidat->prenom, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?php echo e($candidat->nom); ?> <?php echo e($candidat->prenom); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark px-3 fw-bold">
                                    <?php echo e(number_format($candidat->total_points ?? 0)); ?> pts
                                </span>
                            </td>
                            <td class="text-center fw-bold"><?php echo e($candidat->total_votes ?? 0); ?></td>
                            <td>
                                <?php if($candidat->voteLink): ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <form action="<?php echo e(route('admin.votes.toggle', $candidat->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm <?php echo e($candidat->voteLink->is_active ? 'btn-success' : 'btn-danger'); ?> px-2 py-1">
                                                <?php echo e($candidat->voteLink->is_active ? 'Actif' : 'Inactif'); ?>

                                            </button>
                                        </form>
                                        <small class="text-muted font-monospace"><?php echo e($candidat->voteLink->slug); ?></small>
                                    </div>
                                <?php else: ?>
                                    <form action="<?php echo e(route('admin.votes.generate', $candidat->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-dark">Générer lien</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">Aucun candidat enregistré.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">
        <div class="admin-table shadow-sm border-0 bg-white rounded">
            <div class="p-3 border-bottom bg-light">
                <h6 class="mb-0 fw-800"><i class="bi bi-clock-history me-2"></i>Flux de votes récents</h6>
            </div>
            <div class="p-0">
                <ul class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $recentVotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item border-0 border-bottom p-3">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold small text-dark"><?php echo e($vote->voter_name ?: 'Anonyme'); ?></span>
                            <span class="badge bg-light text-success">+<?php echo e($vote->points); ?> pts</span>
                        </div>
                        <div class="text-muted small">
                            Pour : <?php echo e($vote->candidature->prenom ?? 'Candidat'); ?>

                        </div>
                        <div class="text-end" style="font-size: 10px;">
                            <?php echo e($vote->created_at->diffForHumans()); ?>

                        </div>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item text-center py-4 text-muted small">Aucun vote confirmé.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/votes/index.blade.php ENDPATH**/ ?>