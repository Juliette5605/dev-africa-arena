<?php $__env->startSection('title', 'Forum Arena | DevAfricaArena'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .forum-page {
        min-height: calc(100vh - 90px);
        padding: 34px 0 52px;
        background:
            radial-gradient(circle at top right, rgba(243, 156, 18, 0.12), transparent 30%),
            linear-gradient(180deg, #fffaf3 0%, #ffffff 55%, #fff7eb 100%);
    }
    .forum-card {
        background: rgba(255,255,255,0.94);
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 28px;
        box-shadow: 0 18px 50px rgba(0,0,0,0.06);
        padding: 24px;
    }
    .thread-item {
        display: block;
        padding: 18px 0;
        border-top: 1px solid #f2f2f2;
        color: inherit;
        text-decoration: none;
    }
    .thread-item:first-child {
        border-top: none;
        padding-top: 0;
    }
    .thread-item:hover h4 {
        color: #f39c12;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="forum-page">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-5">
                <div class="forum-card">
                    <span class="section-badge">Forum Arena</span>
                    <h1 class="fw-bold mb-2">Poser une question a la communaute</h1>
                    <p class="text-muted mb-4">
                        Ouvrez une discussion autour du quiz, des technologies, des candidatures ou des modules Arena.
                    </p>

                    <form action="<?php echo e(route('forum.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" value="<?php echo e(old('titre')); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categorie</label>
                            <select name="categorie" class="form-select">
                                <?php $__currentLoopData = ['General', 'Quiz', 'Forum', 'Web', 'Mobile', 'IA', 'Design', 'Cyber']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category); ?>" <?php echo e(old('categorie') === $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Votre message</label>
                            <textarea name="message" class="form-control" rows="5" required><?php echo e(old('message')); ?></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Creer la discussion</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="forum-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Discussions</p>
                            <h3 class="fw-bold mb-0">Fils actifs</h3>
                        </div>
                        <span class="mini-badge" style="background:rgba(243,156,18,0.12);color:#f39c12;padding:8px 14px;border-radius:999px;font-weight:800;">
                            <?php echo e($threads->total()); ?> sujet(s)
                        </span>
                    </div>

                    <?php $__empty_1 = true; $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('forum.show', $thread)); ?>" class="thread-item">
                            <div class="d-flex justify-content-between gap-3 flex-wrap">
                                <div>
                                    <div class="d-flex gap-2 align-items-center flex-wrap mb-2">
                                        <?php if($thread->est_epingle): ?>
                                            <span class="mini-badge" style="background:rgba(2,132,199,0.12);color:#0284c7;padding:6px 12px;border-radius:999px;font-weight:800;">
                                                Epingle
                                            </span>
                                        <?php endif; ?>
                                        <span class="mini-badge" style="background:rgba(243,156,18,0.12);color:#f39c12;padding:6px 12px;border-radius:999px;font-weight:800;">
                                            <?php echo e($thread->categorie); ?>

                                        </span>
                                    </div>
                                    <h4 class="fw-bold mb-1"><?php echo e($thread->titre); ?></h4>
                                    <p class="text-muted mb-2"><?php echo e(\Illuminate\Support\Str::limit($thread->message, 150)); ?></p>
                                    <div class="small text-muted">
                                        Par <?php echo e($thread->user?->name ?? 'Utilisateur'); ?> · <?php echo e($thread->created_at->diffForHumans()); ?>

                                    </div>
                                </div>
                                <div class="text-end small text-muted">
                                    <div><?php echo e($thread->comments_count); ?> reponse(s)</div>
                                    <div><?php echo e($thread->vues); ?> vue(s)</div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-5 text-muted">
                            <div style="font-size:2.4rem;">💬</div>
                            <p class="mt-3 mb-0">Aucune discussion n'a encore ete creee.</p>
                        </div>
                    <?php endif; ?>

                    <?php if($threads->hasPages()): ?>
                        <div class="mt-4">
                            <?php echo e($threads->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/pages/forum-index.blade.php ENDPATH**/ ?>