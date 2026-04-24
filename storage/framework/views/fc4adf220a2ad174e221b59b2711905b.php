<?php $__env->startSection('title', 'Mon Dashboard | DevAfricaArena'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .participant-shell {
        background:
            radial-gradient(circle at top right, rgba(243, 156, 18, 0.12), transparent 30%),
            linear-gradient(180deg, #fffaf3 0%, #ffffff 55%, #fff7eb 100%);
        min-height: calc(100vh - 90px);
        padding: 28px 0 44px;
    }
    .participant-hero,
    .participant-card {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 28px;
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.06);
    }
    .participant-hero {
        padding: 28px;
        overflow: hidden;
        position: relative;
    }
    .participant-hero::after {
        content: '';
        position: absolute;
        inset: auto -40px -60px auto;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(243, 156, 18, 0.2), transparent 65%);
        pointer-events: none;
    }
    .participant-card {
        padding: 20px 22px;
    }
    .hero-badge,
    .status-pill,
    .mini-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        font-weight: 800;
    }
    .hero-badge {
        background: rgba(243, 156, 18, 0.12);
        color: #f39c12;
        padding: 8px 16px;
        font-size: 0.74rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .status-pill {
        padding: 10px 16px;
        font-size: 0.8rem;
    }
    .mini-badge {
        padding: 6px 12px;
        font-size: 0.72rem;
    }
    .dashboard-stat {
        border-radius: 22px;
        padding: 18px 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        background: #fff;
    }
    .dashboard-stat-value {
        font-size: 1.9rem;
        font-weight: 800;
        line-height: 1;
    }
    .dashboard-stat-label {
        color: #888;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.74rem;
        font-weight: 700;
        margin-top: 8px;
    }
    .step-row {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid #f2f2f2;
    }
    .step-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .step-dot {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        margin-top: 4px;
        flex-shrink: 0;
        border: 2px solid #e4e4e4;
        background: #fff;
    }
    .step-dot.done {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        border-color: transparent;
        box-shadow: 0 0 0 5px rgba(243, 156, 18, 0.12);
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 10px 0;
        border-bottom: 1px solid #f3f3f3;
        font-size: 0.92rem;
    }
    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .history-table {
        width: 100%;
    }
    .history-table th {
        color: #888;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 14px;
    }
    .history-table td {
        padding: 14px 0;
        border-top: 1px solid #f2f2f2;
        font-size: 0.92rem;
        vertical-align: top;
    }
    .empty-state {
        text-align: center;
        padding: 28px 18px;
        border: 1px dashed rgba(243, 156, 18, 0.3);
        border-radius: 24px;
        background: rgba(243, 156, 18, 0.03);
    }
    .ai-actions {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }
    .ai-action-btn {
        border: none;
        border-radius: 18px;
        padding: 14px 16px;
        font-weight: 800;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .ai-action-btn:hover {
        transform: translateY(-2px);
    }
    .ai-result-box {
        min-height: 110px;
        border-radius: 22px;
        background: #fffaf3;
        border: 1px solid rgba(243, 156, 18, 0.12);
        padding: 16px;
        font-size: 0.92rem;
        line-height: 1.75;
        white-space: pre-wrap;
    }
    .ai-result-box.is-error {
        background: rgba(220, 38, 38, 0.05);
        border-color: rgba(220, 38, 38, 0.18);
        color: #b91c1c;
    }
    .ai-result-box.is-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #777;
        min-height: 110px;
    }
    .ai-source-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    @media (max-width: 767.98px) {
        .ai-actions {
            grid-template-columns: 1fr;
        }
        .participant-shell {
            padding: 22px 0 36px;
        }
        .participant-hero,
        .participant-card {
            padding: 18px;
        }
        .dashboard-stat {
            padding: 16px 18px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $displayName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->name ?? 'Participant');
    $status = $candidature?->statut ?? 'en_attente';
    $statusMap = [
        'en_attente' => ['label' => 'Dossier en attente', 'bg' => 'rgba(243,156,18,0.12)', 'color' => '#f39c12'],
        'retenu' => ['label' => 'Profil retenu', 'bg' => 'rgba(22,163,74,0.12)', 'color' => '#16a34a'],
        'refuse' => ['label' => 'Candidature non retenue', 'bg' => 'rgba(220,38,38,0.10)', 'color' => '#dc2626'],
    ];
    $currentStatus = $statusMap[$status] ?? $statusMap['en_attente'];
    if ($candidature?->finaliste) {
        $currentStatus = ['label' => 'Finaliste confirme', 'bg' => 'rgba(2,132,199,0.12)', 'color' => '#0284c7'];
    }
?>

<section class="participant-shell">
    <div class="container">
        <div class="participant-hero mb-3" data-aos="fade-up">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">
                <div>
                    <span class="hero-badge">
                        <i class="bi bi-person-badge-fill"></i> Espace participant
                    </span>
                    <h1 class="mt-3 mb-2 fw-bold" style="font-size:clamp(2rem,4vw,3rem);">
                        Bonjour <?php echo e($displayName); ?>

                    </h1>
                    <p class="text-muted mb-3" style="max-width:700px;">
                        Voici votre tableau de bord personnel DevAfricaArena. Vous y retrouvez l'etat de votre candidature,
                        les prochaines etapes et le recapitulatif de votre dossier.
                    </p>

                    <?php if($candidature): ?>
                        <span class="status-pill" style="background:<?php echo e($currentStatus['bg']); ?>;color:<?php echo e($currentStatus['color']); ?>;">
                            <i class="bi bi-stars"></i> <?php echo e($currentStatus['label']); ?>

                        </span>
                    <?php else: ?>
                        <span class="status-pill" style="background:rgba(107,114,128,0.12);color:#6b7280;">
                            <i class="bi bi-search"></i> Aucun dossier trouve pour cet email
                        </span>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-column align-items-lg-end justify-content-between gap-3">
                    <div class="text-lg-end">
                        <div class="small text-muted">Compte connecte</div>
                        <div class="fw-bold"><?php echo e($user->email); ?></div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-gold">
                                <i class="bi bi-box-arrow-right"></i> Deconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="50">
                <div class="dashboard-stat">
                    <div class="dashboard-stat-value"><?php echo e($candidatures->count()); ?></div>
                    <div class="dashboard-stat-label">Dossier(s) associe(s)</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="dashboard-stat">
                    <div class="dashboard-stat-value"><?php echo e($candidature?->note ? $candidature->note . '/5' : '--'); ?></div>
                    <div class="dashboard-stat-label">Evaluation actuelle</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="150">
                <div class="dashboard-stat">
                    <div class="dashboard-stat-value"><?php echo e($edition?->nom ?? 'Edition active'); ?></div>
                    <div class="dashboard-stat-label">
                        <?php echo e($edition?->date_finale ? 'Finale le ' . $edition->date_finale->format('d/m/Y') : 'Calendrier en cours de mise a jour'); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="50">
                <div class="participant-card mb-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Suivi</p>
                            <h4 class="fw-bold mb-0">Progression de votre candidature</h4>
                        </div>
                        <?php if($candidature): ?>
                            <span class="mini-badge" style="background:rgba(243,156,18,0.1);color:#f39c12;">
                                Depot du <?php echo e($candidature->created_at->format('d/m/Y')); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="step-row">
                            <div class="step-dot <?php echo e($step['done'] ? 'done' : ''); ?>"></div>
                            <div>
                                <div class="fw-bold"><?php echo e($step['title']); ?></div>
                                <div class="text-muted small"><?php echo e($step['description']); ?></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="participant-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Historique</p>
                            <h4 class="fw-bold mb-0">Mes candidatures</h4>
                        </div>
                    </div>

                    <?php if($candidatures->isEmpty()): ?>
                        <div class="empty-state">
                            <div style="font-size:2.4rem;">📭</div>
                            <h5 class="fw-bold mt-3">Aucune candidature reliee a ce compte</h5>
                            <p class="text-muted mb-3">
                                Votre dashboard se base sur l'email du compte connecte. Si vous avez candidate avec une autre adresse,
                                connectez-vous avec cet email ou soumettez une nouvelle candidature.
                            </p>
                            <a href="<?php echo e(route('criteres')); ?>" class="btn-gold">
                                <i class="bi bi-send-check"></i> Soumettre ma candidature
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="history-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Profil</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $candidatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $rowStatus = $statusMap[$item->statut] ?? $statusMap['en_attente'];
                                            if ($item->finaliste) {
                                                $rowStatus = ['label' => 'Finaliste', 'bg' => 'rgba(2,132,199,0.12)', 'color' => '#0284c7'];
                                            }
                                        ?>
                                        <tr>
                                            <td class="text-muted"><?php echo e($item->created_at->format('d/m/Y')); ?></td>
                                            <td>
                                                <div class="fw-bold"><?php echo e($item->prenom); ?> <?php echo e($item->nom); ?></div>
                                                <div class="text-muted small"><?php echo e($item->expertise); ?> · <?php echo e($item->niveau); ?></div>
                                            </td>
                                            <td>
                                                <span class="mini-badge" style="background:<?php echo e($rowStatus['bg']); ?>;color:<?php echo e($rowStatus['color']); ?>;">
                                                    <?php echo e($rowStatus['label']); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="participant-card mb-3" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Mon dossier</p>
                    <h4 class="fw-bold mb-3">Recapitulatif participant</h4>

                    <?php if($candidature): ?>
                        <div class="info-row">
                            <span class="text-muted">Nom complet</span>
                            <span class="fw-bold"><?php echo e($candidature->prenom); ?> <?php echo e($candidature->nom); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="text-muted">Email</span>
                            <span class="fw-bold"><?php echo e($candidature->email); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="text-muted">Niveau</span>
                            <span class="fw-bold"><?php echo e($candidature->niveau); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="text-muted">Expertise</span>
                            <span class="fw-bold"><?php echo e($candidature->expertise); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="text-muted">Pays</span>
                            <span class="fw-bold"><?php echo e($candidature->pays); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="text-muted">Diplome</span>
                            <span class="fw-bold"><?php echo e($candidature->diplome); ?></span>
                        </div>
                    <?php else: ?>
                        <p class="text-muted mb-0">
                            Aucun dossier n'a ete trouve avec l'email <strong><?php echo e($user->email); ?></strong>.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="participant-card mb-3" data-aos="fade-up" data-aos-delay="130">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Assistant IA</p>
                            <h4 class="fw-bold mb-0">CV, lettre et opportunites</h4>
                        </div>
                        <?php if($candidature): ?>
                            <span id="ai-source" class="ai-source-badge" style="display:none;background:rgba(243,156,18,0.12);color:#f39c12;"></span>
                        <?php endif; ?>
                    </div>

                    <?php if($candidature): ?>
                        <p class="text-muted mb-3">
                            Ces outils utilisent votre dernier dossier pour generer un CV, preparer une lettre de motivation
                            et proposer des opportunites compatibles avec votre profil.
                        </p>

                        <div class="ai-actions mb-3">
                            <button type="button" class="ai-action-btn" style="background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;" onclick="generateParticipantCv()">
                                Generer mon CV
                            </button>
                            <button type="button" class="ai-action-btn" style="background:#17134a;color:#fff;" onclick="generateParticipantLetter()">
                                Lettre de motivation
                            </button>
                            <button type="button" class="ai-action-btn" style="background:#0284c7;color:#fff;" onclick="matchParticipantOpportunities()">
                                Trouver des opportunites
                            </button>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <input type="text" id="ai-poste" class="form-control" placeholder="Poste vise pour la lettre">
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="ai-entreprise" class="form-control" placeholder="Entreprise cible (optionnel)">
                            </div>
                        </div>

                        <div id="ai-result" class="ai-result-box">
                            Cliquez sur une action pour lancer l'assistant IA a partir de votre candidature.
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <div style="font-size:2rem;">🤖</div>
                            <h5 class="fw-bold mt-3">Assistant IA indisponible sans dossier</h5>
                            <p class="text-muted mb-0">
                                Soumettez d'abord votre candidature pour activer la generation de CV, la lettre et le matching.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="participant-card mb-3" data-aos="fade-up" data-aos-delay="150">
                    <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Prochaines etapes</p>
                    <h4 class="fw-bold mb-3">Ce que vous devez surveiller</h4>

                    <div class="step-row">
                        <div class="step-dot done"></div>
                        <div>
                            <div class="fw-bold">Verifier votre email</div>
                            <div class="text-muted small">Les convocations et mises a jour passeront d'abord par votre boite mail.</div>
                        </div>
                    </div>
                    <div class="step-row">
                        <div class="step-dot <?php echo e($candidature ? 'done' : ''); ?>"></div>
                        <div>
                            <div class="fw-bold">Suivre votre statut ici</div>
                            <div class="text-muted small">Votre dashboard sera mis a jour selon l'avancement de la selection.</div>
                        </div>
                    </div>
                    <div class="step-row">
                        <div class="step-dot <?php echo e($candidature?->finaliste ? 'done' : ''); ?>"></div>
                        <div>
                            <div class="fw-bold">Preparation pour la finale</div>
                            <div class="text-muted small">Si vous etes finaliste, vous serez contacte avec le planning detaille.</div>
                        </div>
                    </div>
                </div>

                <div class="participant-card" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Besoin d'aide</p>
                    <h4 class="fw-bold mb-3">Support participant</h4>
                    <p class="text-muted">
                        Si vous avez candidate avec une autre adresse email ou si vous voulez corriger votre dossier,
                        contactez l'equipe organisatrice.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?php echo e(route('contact')); ?>" class="btn-gold">
                            <i class="bi bi-envelope-paper-heart"></i> Contacter l'equipe
                        </a>
                        <a href="<?php echo e(route('criteres')); ?>" class="btn-outline-gold">
                            <i class="bi bi-journal-text"></i> Voir les criteres
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php if($candidature): ?>
<?php $__env->startPush('scripts'); ?>
<script>
const participantAIRoutes = {
    cv: <?php echo json_encode(route('dashboard.ai.cv'), 15, 512) ?>,
    letter: <?php echo json_encode(route('dashboard.ai.letter'), 15, 512) ?>,
    match: <?php echo json_encode(route('dashboard.ai.match'), 15, 512) ?>
};
const participantCsrf = <?php echo json_encode(csrf_token(), 15, 512) ?>;

function setAiSource(source, warning = null) {
    const badge = document.getElementById('ai-source');
    if (!badge) return;

    const sourceLabel = source === 'remote' ? 'IA distante' : 'Mode local';
    badge.textContent = warning ? `${sourceLabel} · fallback` : sourceLabel;
    badge.style.display = 'inline-flex';
    badge.style.background = source === 'remote' ? 'rgba(22,163,74,0.12)' : 'rgba(243,156,18,0.12)';
    badge.style.color = source === 'remote' ? '#16a34a' : '#f39c12';
}

function setAiResult(content, type = 'default') {
    const box = document.getElementById('ai-result');
    box.classList.remove('is-error', 'is-loading');

    if (type === 'error') {
        box.classList.add('is-error');
    }

    if (type === 'loading') {
        box.classList.add('is-loading');
    }

    box.innerHTML = content;
}

async function callParticipantAI(url, body = {}) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': participantCsrf
        },
        body: JSON.stringify(body)
    });

    return response.json();
}

async function generateParticipantCv() {
    setAiResult('<span>Generation du CV en cours...</span>', 'loading');
    const data = await callParticipantAI(participantAIRoutes.cv);

    if (!data.success) {
        setAiResult(`Erreur : ${data.error || 'Generation impossible.'}`, 'error');
        return;
    }

    setAiSource(data.source, data.warning);
    setAiResult(`${data.content}${data.warning ? `\n\nNote: ${data.warning}` : ''}`);
}

async function generateParticipantLetter() {
    const poste = document.getElementById('ai-poste').value.trim();
    if (!poste) {
        setAiResult('Veuillez d’abord saisir le poste vise pour la lettre.', 'error');
        return;
    }

    setAiResult('<span>Generation de la lettre en cours...</span>', 'loading');
    const data = await callParticipantAI(participantAIRoutes.letter, {
        poste,
        entreprise: document.getElementById('ai-entreprise').value.trim()
    });

    if (!data.success) {
        setAiResult(`Erreur : ${data.error || 'Generation impossible.'}`, 'error');
        return;
    }

    setAiSource(data.source, data.warning);
    setAiResult(`${data.content}${data.warning ? `\n\nNote: ${data.warning}` : ''}`);
}

async function matchParticipantOpportunities() {
    setAiResult('<span>Recherche des opportunites en cours...</span>', 'loading');
    const data = await callParticipantAI(participantAIRoutes.match);

    if (!data.success) {
        setAiResult(`Erreur : ${data.error || 'Matching impossible.'}`, 'error');
        return;
    }

    setAiSource(data.source, data.warning);

    if (!Array.isArray(data.matches) || !data.matches.length) {
        setAiResult('Aucune opportunite pertinente n’a ete trouvee pour le moment.');
        return;
    }

    const content = data.matches.map((item, index) => {
        const title = item.titre || item.title || 'Opportunite';
        const company = item.entreprise ? `\nEntreprise: ${item.entreprise}` : '';
        const city = item.ville ? `\nVille: ${item.ville}` : '';
        const type = item.type ? `\nType: ${item.type}` : '';
        const link = item.url ? `\nLien: ${item.url}` : '';
        const score = item.score !== undefined && item.score !== null ? `\nScore: ${item.score}` : '';
        return `${index + 1}. ${title}${company}${city}${type}${score}${link}`;
    }).join('\n\n');

    setAiResult(`${content}${data.warning ? `\n\nNote: ${data.warning}` : ''}`);
}
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/participant/dashboard.blade.php ENDPATH**/ ?>