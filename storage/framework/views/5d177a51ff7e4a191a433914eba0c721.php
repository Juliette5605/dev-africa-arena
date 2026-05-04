<?php $__env->startSection('title', 'Candidature #' . $candidature->id); ?>
<?php $__env->startSection('page-title', ' Dossier candidat'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .star-btn {
            font-size: 1.6rem;
            cursor: pointer;
            color: #ddd;
            transition: 0.2s;
            background: none;
            border: none;
            padding: 2px;
        }

        .star-btn:hover,
        .star-btn.active {
            color: #f39c12;
        }

        .info-field label {
            font-size: 0.72rem;
            text-transform: uppercase;
            color: #888;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }

        .info-field p {
            font-weight: 600;
            margin: 0;
            font-size: 0.95rem;
        }

        .text-block {
            background: #f8f9fa;
            border-left: 3px solid #f39c12;
            padding: 14px 18px;
            border-radius: 0 12px 12px 0;
            line-height: 1.7;
            font-size: 0.95rem;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
            <?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="<?php echo e(route('admin.candidatures')); ?>" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Retour
        </a>
        <div class="d-flex gap-2 flex-wrap">
            <a href="<?php echo e(route('admin.candidatures.pdf', $candidature)); ?>" class="btn fw-bold rounded-3 px-3 py-2"
                style="background:#222;color:white;font-size:0.85rem;" target="_blank">
                <i class="bi bi-file-pdf me-1"></i> Export PDF
            </a>
            <?php if(auth('admin')->user()?->canManage()): ?>
                <form action="<?php echo e(route('admin.candidatures.finaliste', $candidature)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn fw-bold rounded-3 px-3 py-2" style="background:<?php echo e($candidature->finaliste ? 'rgba(220,38,38,0.1)' : 'rgba(243,156,18,0.1)'); ?>;
                                   color:<?php echo e($candidature->finaliste ? '#dc2626' : '#f39c12'); ?>;font-size:0.85rem;">
                        <?php echo e($candidature->finaliste ? '✕ Retirer des finalistes' : ' Ajouter aux finalistes'); ?>

                    </button>
                </form>
                <form action="<?php echo e(route('admin.candidatures.destroy', $candidature)); ?>" method="POST"
                    onsubmit="return confirm('Supprimer définitivement cette candidature ?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn fw-bold rounded-3 px-3 py-2"
                        style="background:rgba(220,38,38,0.08);color:#dc2626;font-size:0.85rem;">
                        <i class="bi bi-trash3"></i>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="row g-4">

        
        <div class="col-lg-4">

            
            <div class="stat-card text-center mb-4">
                <div
                    style="width:72px;height:72px;background:linear-gradient(135deg,#f39c12,#e67e22);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.9rem;color:white;font-weight:800;">
                    <?php echo e(strtoupper(substr($candidature->prenom, 0, 1))); ?>

                </div>
                <h4 class="fw-bold mb-1"><?php echo e($candidature->prenom); ?> <?php echo e($candidature->nom); ?></h4>
                <span
                    class="badge fw-bold rounded-pill px-3 py-2 mb-2 <?php echo e($candidature->niveau === 'Junior' ? 'badge-junior' : ($candidature->niveau === 'Senior' ? 'badge-senior' : 'badge-inter')); ?>">
                    <?php echo e($candidature->niveau); ?>

                </span>
                <?php if($candidature->finaliste): ?>
                    <div><span class="badge fw-bold rounded-pill px-3 py-2 mt-1"
                            style="background:rgba(243,156,18,0.1);color:#f39c12;"> Finaliste</span></div>
                <?php endif; ?>
                <hr>
                <div class="d-flex justify-content-around mt-3">
                    <div class="text-center">
                        <div class="fw-bold"><?php echo e($candidature->age); ?></div>
                        <div class="small text-muted">Ans</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold"><?php echo e($candidature->pays); ?></div>
                        <div class="small text-muted">Pays</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold"><?php echo e($candidature->created_at->format('d/m')); ?></div>
                        <div class="small text-muted">Inscrit</div>
                    </div>
                </div>
                <hr>
                <div class="text-start px-2">
                    <div class="info-field mb-2"><label>Email</label>
                        <p class="small"><?php echo e($candidature->email); ?></p>
                    </div>
                    <div class="info-field mb-2"><label>Expertise</label>
                        <p><?php echo e($candidature->expertise); ?></p>
                    </div>
                    <div class="info-field"><label>Diplôme</label>
                        <p><?php echo e($candidature->diplome); ?></p>
                    </div>
                </div>
            </div>

            
            <div class="stat-card mb-4 text-center p-3">
                <div class="fw-bold mb-1" style="font-size:1.2rem;"><?php echo e($candidature->statut_label); ?></div>
                <div class="small text-muted">Statut de la candidature</div>
                <?php if($candidature->note): ?>
                    <div class="mt-2" style="color:#f39c12;font-size:1.3rem;">
                        <?php for($i = 1; $i <= 5; $i++): ?><?php echo e($i <= $candidature->note ? '★' : '☆'); ?><?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="stat-card p-3">
                <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                    Historique</h6>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Soumis le</span>
                    <span class="small fw-bold"><?php echo e($candidature->created_at->format('d/m/Y H:i')); ?></span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Lu le</span>
                    <span class="small fw-bold"><?php echo e($candidature->read_at?->format('d/m/Y H:i') ?? '—'); ?></span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted small">Référence</span>
                    <span class="small fw-bold">#<?php echo e(str_pad($candidature->id, 4, '0', STR_PAD_LEFT)); ?></span>
                </div>
            </div>
        </div>

        
        <div class="col-lg-8">

            
            <div class="stat-card mb-4">
                <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                     Motivation</h6>
                <div class="text-block"><?php echo e($candidature->motivation); ?></div>
            </div>

            
            <div class="stat-card mb-4">
                <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                     Vision Tech</h6>
                <div class="text-block"><?php echo e($candidature->vision); ?></div>
            </div>

            
            <?php if(auth('admin')->user()?->canManage()): ?>
                <div class="stat-card">
                    <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">⭐
                        Évaluation admin</h6>
                    <form action="<?php echo e(route('admin.candidatures.noter', $candidature)); ?>" method="POST">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>

                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Note (1 à 5 étoiles)</label>
                            <div class="d-flex gap-1" id="stars-container">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <button type="button" class="star-btn <?php echo e($i <= ($candidature->note ?? 0) ? 'active' : ''); ?>"
                                        data-val="<?php echo e($i); ?>" onclick="setNote(<?php echo e($i); ?>)">★</button>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="note" id="note-input" value="<?php echo e($candidature->note ?? ''); ?>" required>
                            <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Statut de la candidature</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <?php $__currentLoopData = ['en_attente' => ' En attente', 'retenu' => '✅ Retenu', 'refuse' => ' ❌ Refusé']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-bold small"
                                        style="cursor:pointer;border:2px solid <?php echo e($candidature->statut === $val ? '#f39c12' : '#eee'); ?>;background:<?php echo e($candidature->statut === $val ? '#fff8eb' : '#fff'); ?>;">
                                        <input type="radio" name="statut" value="<?php echo e($val); ?>" <?php echo e($candidature->statut === $val ? 'checked' : ''); ?>>
                                        <?php echo e($label); ?>

                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['statut'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Commentaire interne (visible uniquement dans
                                l'admin)</label>
                            <textarea name="commentaire_admin" class="form-control rounded-3 border-0 bg-light py-3" rows="4"
                                placeholder="Notes sur le candidat, points forts, questions à poser..."><?php echo e(old('commentaire_admin', $candidature->commentaire_admin)); ?></textarea>
                        </div>

                        <button type="submit" class="btn fw-bold py-3 px-5 rounded-3"
                            style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                            Enregistrer l'évaluation
                        </button>
                    </form>
                </div>
            <?php elseif($candidature->note): ?>
                
                <div class="stat-card p-4">
                    <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                        Évaluation</h6>
                    <div style="color:#f39c12;font-size:1.4rem;">
                        <?php for($i = 1; $i <= 5; $i++): ?><?php echo e($i <= $candidature->note ? '★' : '☆'); ?><?php endfor; ?></div>
                    <?php if($candidature->commentaire_admin): ?>
                        <div class="text-block mt-3"><?php echo e($candidature->commentaire_admin); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function setNote(val) {
            document.getElementById('note-input').value = val;
            document.querySelectorAll('.star-btn').forEach((btn, i) => {
                btn.classList.toggle('active', i < val);
            });
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/admin/candidature-show.blade.php ENDPATH**/ ?>