<?php $__env->startSection('title', 'Médiathèque'); ?>
<?php $__env->startSection('page-title', ' Médiathèque'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .media-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:16px; }
    .media-card { background:#fff; border:1px solid #eee; border-radius:16px; overflow:hidden; transition:0.3s; }
    .media-card:hover { border-color:#f39c12; box-shadow:0 8px 24px rgba(243,156,18,0.1); transform:translateY(-3px); }
    .media-thumb { width:100%; height:130px; object-fit:cover; background:#f8f9fa; }
    .media-thumb-icon { width:100%; height:130px; display:flex; align-items:center; justify-content:center; background:#f8f9fa; font-size:2.5rem; }
    .media-info { padding:12px; }
    .drop-zone { border:2px dashed rgba(243,156,18,0.4); border-radius:20px; padding:40px; text-align:center; transition:0.3s; cursor:pointer; }
    .drop-zone:hover, .drop-zone.dragover { border-color:#f39c12; background:rgba(243,156,18,0.04); }
    .category-badge { font-size:0.65rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; padding:3px 10px; border-radius:20px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<div class="row g-4">

    
    <div class="col-lg-4">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                ⬆ Uploader un fichier
            </h6>
            <form action="<?php echo e(route('admin.media.store')); ?>" method="POST" enctype="multipart/form-data" id="upload-form">
                <?php echo csrf_field(); ?>

                <div class="drop-zone mb-3" onclick="document.getElementById('file-input').click()" id="drop-zone">
                    <div id="drop-preview">
                        <div style="font-size:2.5rem;">📁</div>
                        <p class="fw-bold mt-2 mb-1 small">Cliquer ou glisser-déposer</p>
                        <p class="text-muted" style="font-size:0.75rem;">JPG, PNG, GIF, WEBP, SVG, PDF · Max 5MB</p>
                    </div>
                    <input type="file" name="file" id="file-input" class="d-none"
                           accept=".jpg,.jpeg,.png,.gif,.webp,.svg,.pdf" required
                           onchange="previewFile(this)">
                </div>
                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mb-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="mb-3">
                    <label class="form-label fw-bold small">Catégorie</label>
                    <select name="category" class="form-select rounded-3 border-0 bg-light py-3" required>
                        <option value="general"> Général</option>
                        <option value="logo"> Logo</option>
                        <option value="hero"> Image Hero</option>
                        <option value="partenaire"> Partenaire</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Nom personnalisé (optionnel)</label>
                    <input type="text" name="name" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Ex: Logo principal">
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    ⬆ Uploader
                </button>
            </form>
        </div>
    </div>

    
    <div class="col-lg-8">
        
        <form method="GET" class="d-flex gap-2 mb-4 flex-wrap">
            <?php $__currentLoopData = [''=>'Tous', 'logo'=>'Logos', 'hero'=>'Hero', 'partenaire'=>'Partenaires', 'general'=>'Général']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.media.index', $val?['category'=>$val]:[])); ?>"
               class="btn btn-sm fw-bold rounded-pill px-3"
               style="<?php echo e(request('category')===$val && ($val||!request('category'))
                   ? 'background:linear-gradient(135deg,#f39c12,#e67e22);color:white;'
                   : 'background:#f8f9fa;color:#555;'); ?>">
                <?php echo e($label); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </form>

        
        <?php if($medias->isEmpty()): ?>
        <div class="text-center py-5 text-muted">
            <div style="font-size:3rem;">📁</div>
            <p class="mt-2">Aucun fichier uploadé pour l'instant.</p>
        </div>
        <?php else: ?>
        <div class="media-grid">
            <?php $__currentLoopData = $medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="media-card">
                <?php if(str_starts_with($media->type, 'image/')): ?>
                    <img src="<?php echo e($media->url); ?>" alt="<?php echo e($media->name); ?>" class="media-thumb"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="media-thumb-icon" style="display:none;"></div>
                <?php else: ?>
                    <div class="media-thumb-icon"></div>
                <?php endif; ?>
                <div class="media-info">
                    <p class="fw-bold mb-1" style="font-size:0.8rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"
                       title="<?php echo e($media->name); ?>"><?php echo e($media->name); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php
                            $catColors = ['logo'=>'#f39c12','hero'=>'#0284c7','partenaire'=>'#16a34a','general'=>'#6b7280'];
                            $cc = $catColors[$media->category] ?? '#888';
                        ?>
                        <span class="category-badge" style="background:<?php echo e($cc); ?>20;color:<?php echo e($cc); ?>;">
                            <?php echo e($media->category); ?>

                        </span>
                        <span class="text-muted" style="font-size:0.7rem;"><?php echo e($media->size_formatted); ?></span>
                    </div>
                    <div class="d-flex gap-1 mt-2">
                        <a href="<?php echo e($media->url); ?>" target="_blank"
                           class="btn btn-sm rounded-3 fw-bold px-2 py-1 flex-grow-1 text-center"
                           style="background:#f8f9fa;color:#555;font-size:0.72rem;">
                             Copier l'URL
                        </a>
                        <form action="<?php echo e(route('admin.media.destroy', $media)); ?>" method="POST"
                              onsubmit="return confirm('Supprimer ce fichier ?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm rounded-3 px-2 py-1"
                                    style="background:rgba(220,38,38,0.08);color:#dc2626;font-size:0.8rem;">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if($medias->hasPages()): ?>
        <div class="mt-4"><?php echo e($medias->links()); ?></div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewFile(input) {
    if (!input.files[0]) return;
    const file = input.files[0];
    const preview = document.getElementById('drop-preview');
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `<img src="${e.target.result}" style="max-height:80px;border-radius:8px;"><p class="small fw-bold mt-2 mb-0">${file.name}</p>`;
        };
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `<div style="font-size:2rem;">📄</div><p class="small fw-bold mt-2 mb-0">${file.name}</p>`;
    }
}

// Drag & drop
const zone = document.getElementById('drop-zone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('dragover'); });
zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
zone.addEventListener('drop', e => {
    e.preventDefault(); zone.classList.remove('dragover');
    const input = document.getElementById('file-input');
    input.files = e.dataTransfer.files;
    previewFile(input);
});

// Copier URL au clic
document.querySelectorAll('a[href$=""]').forEach(a => {
    if (a.textContent.includes('Copier')) {
        a.addEventListener('click', function(e) {
            e.preventDefault();
            navigator.clipboard.writeText(this.href).then(() => {
                const orig = this.textContent;
                this.textContent = ' Copié !';
                setTimeout(() => this.textContent = orig, 1500);
            });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\TalentSync AI\resources\views/admin/media/index.blade.php ENDPATH**/ ?>