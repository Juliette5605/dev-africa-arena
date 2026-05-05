

<?php $__env->startSection('title', 'Tableau de bord - ' . $candidature->prenom . ' ' . $candidature->nom); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2"><?php echo e($candidature->prenom); ?> <?php echo e($candidature->nom); ?></h1>
            <p class="text-muted">Candidature #<?php echo e($candidature->id); ?></p>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('admin.candidatures')); ?>" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <a href="<?php echo e(route('admin.candidatures.show', $candidature)); ?>" class="btn btn-primary">
                <i class="fas fa-eye"></i> Détails complets
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Informations personnelles</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Prénom :</dt>
                        <dd class="col-sm-7"><?php echo e($candidature->prenom); ?></dd>

                        <dt class="col-sm-5">Nom :</dt>
                        <dd class="col-sm-7"><?php echo e($candidature->nom); ?></dd>

                        <dt class="col-sm-5">Email :</dt>
                        <dd class="col-sm-7">
                            <a href="mailto:<?php echo e($candidature->email); ?>"><?php echo e($candidature->email); ?></a>
                        </dd>

                        <dt class="col-sm-5">Âge :</dt>
                        <dd class="col-sm-7"><?php echo e($candidature->age); ?> ans</dd>

                        <dt class="col-sm-5">Pays :</dt>
                        <dd class="col-sm-7"><?php echo e($candidature->pays); ?></dd>

                        <dt class="col-sm-5">Diplôme :</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-info"><?php echo e(ucfirst($candidature->diplome)); ?></span>
                        </dd>

                        <dt class="col-sm-5">Niveau :</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-warning"><?php echo e($candidature->niveau); ?></span>
                        </dd>

                        <dt class="col-sm-5">Expertise :</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-secondary"><?php echo e($candidature->expertise); ?></span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Analyse IA -->
        <div class="col-md-6 mb-4">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-brain"></i> Analyse IA</h5>
                </div>
                <div class="card-body">
                    <?php if($candidature->score_ia): ?>
                        <div class="mb-3">
                            <h6>Score IA</h6>
                            <div class="score-display">
                                <?php
                                    $colors = [1 => 'danger', 2 => 'warning', 3 => 'info', 4 => 'success', 5 => 'success'];
                                    $labels = [1 => 'Faible', 2 => 'Moyen', 3 => 'Bon', 4 => 'Très bon', 5 => 'Excellent'];
                                ?>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-<?php echo e($colors[$candidature->score_ia]); ?> fs-5 me-2">
                                        <?php echo e($candidature->score_ia); ?>/5
                                    </span>
                                    <span class="text-muted"><?php echo e($labels[$candidature->score_ia]); ?></span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-<?php echo e($colors[$candidature->score_ia]); ?>" 
                                         role="progressbar" 
                                         style="width: <?php echo e(($candidature->score_ia / 5) * 100); ?>%"
                                         aria-valuenow="<?php echo e($candidature->score_ia); ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6>Analyse détaillée</h6>
                            <p class="card-text text-justify">
                                <?php echo e($candidature->analyse_ia); ?>

                            </p>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Aucune analyse IA disponible.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Motivation et Vision -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Motivation</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        <?php echo e($candidature->motivation); ?>

                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-telescope"></i> Vision</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-justify">
                        <?php echo e($candidature->vision); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statut et Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-cogs"></i> Gestion de la candidature</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Statut :</label>
                            <?php
                                $statusColors = [
                                    'en_attente' => 'warning',
                                    'revu' => 'info',
                                    'retenu' => 'success',
                                    'refuse' => 'danger',
                                ];
                                $statusLabels = [
                                    'en_attente' => 'En attente',
                                    'revu' => 'Revu',
                                    'retenu' => 'Retenu',
                                    'refuse' => 'Refusé',
                                ];
                            ?>
                            <span class="badge bg-<?php echo e($statusColors[$candidature->statut] ?? 'secondary'); ?>">
                                <?php echo e($statusLabels[$candidature->statut] ?? ucfirst($candidature->statut)); ?>

                            </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Finaliste :</label>
                            <?php if($candidature->finaliste): ?>
                                <span class="badge bg-success"><i class="fas fa-check"></i> Oui</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><i class="fas fa-times"></i> Non</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dernière mise à jour :</label>
                            <small class="text-muted"><?php echo e($candidature->updated_at->diffForHumans()); ?></small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Note :</label>
                            <?php if($candidature->note): ?>
                                <div class="d-flex align-items-center">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <?php if($i <= $candidature->note): ?>
                                            <i class="fas fa-star text-warning"></i>
                                        <?php else: ?>
                                            <i class="far fa-star text-warning"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <span class="ms-2"><?php echo e($candidature->note); ?>/5</span>
                                </div>
                            <?php else: ?>
                                <small class="text-muted">Non notée</small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Commentaire :</label>
                            <?php if($candidature->commentaire_admin): ?>
                                <p class="small"><?php echo e($candidature->commentaire_admin); ?></p>
                            <?php else: ?>
                                <small class="text-muted">Aucun commentaire</small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr>

                    <div class="btn-group" role="group">
                        <a href="<?php echo e(route('admin.candidatures.show', $candidature)); ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Éditer
                        </a>
                        <a href="<?php echo e(route('admin.candidatures.pdf', $candidature)); ?>" class="btn btn-info">
                            <i class="fas fa-file-pdf"></i> Télécharger PDF
                        </a>
                        <?php if(!$candidature->finaliste): ?>
                            <form method="POST" action="<?php echo e(route('admin.candidatures.finaliste', $candidature)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn btn-success" onclick="return confirm('Confirmer le passage en finaliste ?')">
                                    <i class="fas fa-check"></i> Passer finaliste
                                </button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('admin.candidatures.finaliste', $candidature)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Retirer du statut finaliste ?')">
                                    <i class="fas fa-times"></i> Retirer finaliste
                                </button>
                            </form>
                        <?php endif; ?>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Supprimer la candidature</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer la candidature de <strong><?php echo e($candidature->prenom); ?> <?php echo e($candidature->nom); ?></strong> ?</p>
                <p class="text-danger"><small>Cette action est irréversible.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form method="POST" action="<?php echo e(route('admin.candidatures.destroy', $candidature)); ?>" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/candidature-dashboard.blade.php ENDPATH**/ ?>