<?php $__env->startSection('title', $candidature->nom . ' — Voter'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.vote-hero {
    background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
    min-height: 100vh;
    padding: 40px 0;
}
.candidat-card {
    background: #222;
    border: 1px solid rgba(243,156,18,0.2);
    border-radius: 20px;
    overflow: hidden;
    max-width: 480px;
    margin: 0 auto;
}
.candidat-header {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    padding: 32px 24px 24px;
    text-align: center;
    position: relative;
}
.candidat-photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 4px solid #fff;
    object-fit: cover;
    margin: 0 auto 16px;
    display: block;
    background: #333;
}
.candidat-photo-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 4px solid #fff;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: 700;
    color: #fff;
    margin: 0 auto 16px;
}
.candidat-name {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin: 0 0 4px;
}
.candidat-projet {
    font-size: 14px;
    color: rgba(255,255,255,0.85);
    margin: 0;
}
.stats-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 0;
    border-bottom: 1px solid rgba(243,156,18,0.15);
}
.stat-item {
    padding: 16px 12px;
    text-align: center;
    border-right: 1px solid rgba(243,156,18,0.15);
}
.stat-item:last-child { border-right: none; }
.stat-val {
    font-size: 22px;
    font-weight: 700;
    color: #f39c12;
    display: block;
}
.stat-lab {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.vote-form {
    padding: 24px;
}
.form-title {
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    margin: 0 0 20px;
    text-align: center;
}
.form-group { margin-bottom: 16px; }
.form-label {
    display: block;
    font-size: 12px;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    background: #2d2d2d;
    border: 1px solid rgba(243,156,18,0.25);
    border-radius: 8px;
    padding: 10px 14px;
    color: #fff;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.2s;
}
.form-control:focus {
    outline: none;
    border-color: #f39c12;
}
.form-control option { background: #2d2d2d; }
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
    margin-bottom: 16px;
}
.price-btn {
    background: #2d2d2d;
    border: 1px solid rgba(243,156,18,0.25);
    border-radius: 8px;
    padding: 10px 4px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    color: #fff;
}
.price-btn:hover, .price-btn.selected {
    background: rgba(243,156,18,0.15);
    border-color: #f39c12;
}
.price-btn input[type="radio"] { display: none; }
.price-amount {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #f39c12;
}
.price-points {
    display: block;
    font-size: 11px;
    color: #888;
}
.payment-methods {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 20px;
}
.method-btn {
    background: #2d2d2d;
    border: 1px solid rgba(243,156,18,0.25);
    border-radius: 8px;
    padding: 12px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
}
.method-btn input[type="radio"] { display: none; }
.method-btn:hover, .method-btn.selected {
    background: rgba(243,156,18,0.15);
    border-color: #f39c12;
}
.method-name { font-size: 13px; font-weight: 600; color: #fff; }
.method-sub  { font-size: 11px; color: #888; }
.btn-vote {
    width: 100%;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    padding: 14px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    letter-spacing: 0.5px;
    transition: opacity 0.2s;
}
.btn-vote:hover { opacity: 0.9; }
.vote-type-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 8px;
    margin-bottom: 16px;
}
.type-btn {
    background: #2d2d2d;
    border: 1px solid rgba(243,156,18,0.2);
    border-radius: 8px;
    padding: 10px 4px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 12px;
    color: #aaa;
}
.type-btn input[type="radio"] { display: none; }
.type-btn:hover, .type-btn.selected {
    background: rgba(243,156,18,0.15);
    border-color: #f39c12;
    color: #f39c12;
}
.share-section {
    padding: 0 24px 24px;
    text-align: center;
}
.share-title { font-size: 12px; color: #888; margin-bottom: 12px; }
.share-buttons { display: flex; gap: 8px; justify-content: center; }
.share-btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.share-link-btn {
    background: rgba(243,156,18,0.15);
    border: 1px solid rgba(243,156,18,0.4);
    color: #f39c12;
}
.share-tiktok-btn {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
}
.flash-success {
    background: rgba(39,174,96,0.15);
    border: 1px solid rgba(39,174,96,0.4);
    color: #2ecc71;
    padding: 12px 16px;
    border-radius: 8px;
    margin: 16px 24px 0;
    font-size: 14px;
    text-align: center;
}
.rang-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255,255,255,0.2);
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.back-link {
    text-align: center;
    margin-bottom: 20px;
}
.back-link a {
    color: #888;
    font-size: 13px;
    text-decoration: none;
}
.back-link a:hover { color: #f39c12; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="vote-hero">
    <div class="container">
        <div class="back-link">
            <a href="<?php echo e(route('vote.leaderboard')); ?>">← Voir tous les candidats</a>
        </div>

        <div class="candidat-card">
            
            <div class="candidat-header">
                <?php if($rang): ?>
                    <span class="rang-badge">#<?php echo e($rang); ?></span>
                <?php endif; ?>

                <?php if($candidature->photo ?? false): ?>
                    <img src="<?php echo e(asset('storage/' . $candidature->photo)); ?>" alt="<?php echo e($candidature->nom); ?>" class="candidat-photo">
                <?php else: ?>
                    <div class="candidat-photo-placeholder">
                        <?php echo e(strtoupper(substr($candidature->prenom ?? $candidature->nom ?? 'C', 0, 1))); ?>

                    </div>
                <?php endif; ?>

                <h1 class="candidat-name"><?php echo e($candidature->prenom ?? ''); ?> <?php echo e($candidature->nom ?? $candidature->nomcomplet ?? ''); ?></h1>
                <p class="candidat-projet"><?php echo e($candidature->projet ?? $candidature->domaine ?? $candidature->expertise ?? ''); ?></p>
            </div>

            
            <div class="stats-row">
                <div class="stat-item">
                    <span class="stat-val"><?php echo e(number_format($totalPoints)); ?></span>
                    <span class="stat-lab">Points</span>
                </div>
                <div class="stat-item">
                    <span class="stat-val"><?php echo e(number_format($totalVotants)); ?></span>
                    <span class="stat-lab">Votants</span>
                </div>
                <div class="stat-item">
                    <span class="stat-val"><?php echo e($rang ? '#'.$rang : '—'); ?></span>
                    <span class="stat-lab">Classement</span>
                </div>
            </div>

            
            <?php if(session('success')): ?>
                <div class="flash-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            
            <form class="vote-form" method="POST" action="<?php echo e(route('vote.store', $voteLink->slug)); ?>" id="voteForm">
                <?php echo csrf_field(); ?>
                <p class="form-title">Voter pour ce candidat</p>

                
                <div class="form-group">
                    <label class="form-label">Vous êtes</label>
                    <div class="vote-type-row">
                        <label class="type-btn" id="type-public">
                            <input type="radio" name="voter_type" value="public" checked>
                            Public
                        </label>
                        <label class="type-btn" id="type-sponsor">
                            <input type="radio" name="voter_type" value="sponsor">
                            Sponsor
                        </label>
                        <label class="type-btn" id="type-jury">
                            <input type="radio" name="voter_type" value="jury">
                            Jury
                        </label>
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Votre nom</label>
                    <input type="text" name="voter_name" class="form-control" placeholder="Nom complet" required value="<?php echo e(old('voter_name')); ?>">
                    <?php $__errorArgs = ['voter_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div style="color:#e74c3c;font-size:12px;margin-top:4px"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Numéro de téléphone</label>
                    <input type="tel" name="voter_phone" class="form-control" placeholder="+228 XX XX XX XX" required value="<?php echo e(old('voter_phone')); ?>">
                    <?php $__errorArgs = ['voter_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div style="color:#e74c3c;font-size:12px;margin-top:4px"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Montant du vote</label>
                    <div class="pricing-grid">
                        <?php $__currentLoopData = $pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amount => $points): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="price-btn" onclick="selectPrice(this)">
                            <input type="radio" name="amount" value="<?php echo e($amount); ?>" <?php echo e($amount == 500 ? 'checked' : ''); ?>>
                            <span class="price-amount"><?php echo e(number_format($amount)); ?> F</span>
                            <span class="price-points"><?php echo e($points); ?> pt<?php echo e($points > 1 ? 's' : ''); ?></span>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div style="color:#e74c3c;font-size:12px;margin-top:4px"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Payer avec</label>
                    <div class="payment-methods">
                        <label class="method-btn" onclick="selectMethod(this)">
                            <input type="radio" name="payment_method" value="flooz" checked>
                            <div class="method-name">Flooz</div>
                            <div class="method-sub">Moov Africa</div>
                        </label>
                        <label class="method-btn" onclick="selectMethod(this)">
                            <input type="radio" name="payment_method" value="tmoney">
                            <div class="method-name">T-Money</div>
                            <div class="method-sub">Togocel</div>
                        </label>
                    </div>
                    <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div style="color:#e74c3c;font-size:12px;margin-top:4px"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn-vote" id="submitBtn">
                    Voter — <span id="amountLabel">500 FCFA</span>
                </button>
            </form>

            
            <div class="share-section">
                <p class="share-title">Partager le lien de vote</p>
                <div class="share-buttons">
                    <button class="share-btn share-link-btn" onclick="copyLink()">
                        Copier le lien
                    </button>
                    <?php if($voteLink->tiktok_url): ?>
                    <a href="<?php echo e($voteLink->tiktok_url); ?>" target="_blank" class="share-btn share-tiktok-btn">
                        TikTok
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Sélectionner un montant
function selectPrice(el) {
    document.querySelectorAll('.price-btn').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    const amount = el.querySelector('input').value;
    document.getElementById('amountLabel').textContent = parseInt(amount).toLocaleString('fr') + ' FCFA';
}

// Sélectionner un mode de paiement
function selectMethod(el) {
    document.querySelectorAll('.method-btn').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
}

// Sélectionner type de votant
document.querySelectorAll('.type-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
    });
});

// Copier le lien
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = event.target;
        btn.textContent = 'Copié !';
        setTimeout(() => btn.textContent = 'Copier le lien', 2000);
    });
}

// Init
document.addEventListener('DOMContentLoaded', () => {
    // Marquer le bouton 500F comme sélectionné par défaut
    const defaultPrice = document.querySelector('.price-btn input[value="500"]');
    if (defaultPrice) defaultPrice.closest('.price-btn').classList.add('selected');

    const defaultMethod = document.querySelector('.method-btn input[value="flooz"]');
    if (defaultMethod) defaultMethod.closest('.method-btn').classList.add('selected');

    const defaultType = document.querySelector('.type-btn input[value="public"]');
    if (defaultType) defaultType.closest('.type-btn').classList.add('selected');
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/vote/profil.blade.php ENDPATH**/ ?>