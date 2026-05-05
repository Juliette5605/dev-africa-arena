<?php $__env->startSection('title', 'Orientation | DevAfricaArena'); ?>

<?php ($question = old('question', $maQuestion ?? '')); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .orientation-page {
        padding: 60px 0 90px;
        background:
            radial-gradient(circle at top right, rgba(243, 156, 18, 0.14), transparent 28%),
            radial-gradient(circle at top left, rgba(23, 19, 74, 0.08), transparent 25%),
            linear-gradient(180deg, #fcfcfe 0%, #f7f8fb 100%);
    }

    .orientation-shell,
    .orientation-card,
    .orientation-step,
    .orientation-focus,
    .orientation-assistant,
    .orientation-cta {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(15, 23, 42, 0.06);
        border-radius: 28px;
        box-shadow: 0 18px 50px rgba(15, 23, 42, 0.06);
    }

    .orientation-shell {
        padding: 42px;
        height: 100%;
    }

    .orientation-card,
    .orientation-step,
    .orientation-focus,
    .orientation-assistant {
        padding: 30px;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .orientation-card:hover,
    .orientation-step:hover,
    .orientation-focus:hover,
    .orientation-assistant:hover {
        transform: translateY(-8px);
        border-color: rgba(243, 156, 18, 0.35);
        box-shadow: 0 22px 45px rgba(243, 156, 18, 0.12);
    }

    .orientation-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 18px;
        border-radius: 999px;
        background: rgba(243, 156, 18, 0.12);
        color: #b45309;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .orientation-title {
        font-size: clamp(2.5rem, 5vw, 4.6rem);
        line-height: 1.05;
        font-weight: 800;
        color: #17134a;
        letter-spacing: -0.03em;
    }

    .orientation-lead {
        font-size: 1.08rem;
        line-height: 1.85;
        color: #5b6475;
        max-width: 760px;
    }

    .orientation-points,
    .orientation-list {
        display: grid;
        gap: 14px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .orientation-point,
    .orientation-list li {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        color: #475467;
        line-height: 1.7;
    }

    .orientation-point-icon,
    .orientation-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .orientation-point-icon {
        background: rgba(243, 156, 18, 0.14);
        color: #c26d1a;
    }

    .orientation-icon {
        background: rgba(23, 19, 74, 0.07);
        color: #17134a;
        margin-bottom: 18px;
    }

    .section-heading {
        margin-bottom: 28px;
    }

    .section-copy {
        max-width: 760px;
        margin: 0 auto;
        color: #667085;
        line-height: 1.85;
        font-size: 1.04rem;
    }

    .orientation-card h3,
    .orientation-step h3,
    .orientation-focus h3,
    .orientation-shell h3,
    .orientation-assistant h3,
    .orientation-cta h3 {
        font-weight: 800;
        color: #111827;
        margin-bottom: 14px;
    }

    .orientation-card p,
    .orientation-step p,
    .orientation-focus p,
    .orientation-shell p,
    .orientation-assistant p,
    .orientation-cta p {
        color: #667085;
        line-height: 1.75;
        margin-bottom: 0;
    }

    .orientation-note {
        margin-top: 18px;
        padding: 16px 18px;
        border-radius: 18px;
        background: rgba(243, 156, 18, 0.08);
        color: #7c4a0d;
        font-size: 0.94rem;
        line-height: 1.7;
    }

    .step-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 999px;
        background: linear-gradient(135deg, #f39c12, #d97706);
        color: #fff;
        font-weight: 800;
        margin-bottom: 18px;
    }

    .orientation-form {
        margin-top: 24px;
    }

    .orientation-form textarea {
        min-height: 140px;
        resize: vertical;
    }

    .assistant-answer {
        margin-top: 22px;
        padding: 22px;
        border-radius: 22px;
        background: linear-gradient(180deg, rgba(243, 156, 18, 0.08), rgba(243, 156, 18, 0.03));
        border: 1px solid rgba(243, 156, 18, 0.16);
    }

    .assistant-answer-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #b45309;
        margin-bottom: 14px;
    }

    .assistant-answer p {
        white-space: pre-line;
    }

    .orientation-cta {
        margin-top: 70px;
        padding: 40px;
        background: linear-gradient(135deg, rgba(23, 19, 74, 0.98), rgba(35, 31, 93, 0.96));
        color: #fff;
    }

    .orientation-cta h3,
    .orientation-cta p {
        color: #fff;
    }

    .orientation-cta p {
        opacity: 0.84;
    }

    .cta-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 24px;
    }

    @media (max-width: 991.98px) {
        .orientation-shell,
        .orientation-card,
        .orientation-step,
        .orientation-focus,
        .orientation-assistant,
        .orientation-cta {
            padding: 28px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="orientation-page">
    <div class="container">
        <div class="row g-4 align-items-stretch mb-5">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="orientation-shell">
                    <span class="orientation-kicker">
                        <i class="bi bi-compass"></i>
                        Orientation DevAfricaArena
                    </span>

                    <h1 class="orientation-title mt-4">
                        Trouver sa voie dans les <span class="text-gradient">métiers du numérique</span>
                    </h1>

                    <p class="orientation-lead mt-4">
                        Cette page vous aide à relier votre profil, vos points forts et vos ambitions aux filières
                        réellement valorisées par DevAfricaArena. L'objectif n'est pas de vous perdre dans des
                        généralités, mais de vous donner une direction crédible avant la candidature.
                    </p>

                    <div class="orientation-points mt-4">
                        <div class="orientation-point">
                            <span class="orientation-point-icon"><i class="bi bi-diagram-3"></i></span>
                            <div>
                                <strong>Comprendre les filières</strong><br>
                                Développement, IA, data, design, cybersécurité, marketing digital ou fabrication
                                numérique: l'orientation part des métiers déjà présents dans l'écosystème Arena.
                            </div>
                        </div>

                        <div class="orientation-point">
                            <span class="orientation-point-icon"><i class="bi bi-person-check"></i></span>
                            <div>
                                <strong>Se positionner avec justesse</strong><br>
                                Débutant, autodidacte, étudiant ou profil en reconversion: l'idée est d'identifier la
                                voie la plus cohérente avec votre point de départ.
                            </div>
                        </div>

                        <div class="orientation-point">
                            <span class="orientation-point-icon"><i class="bi bi-flag"></i></span>
                            <div>
                                <strong>Passer à l'action</strong><br>
                                Vous repartez avec une piste claire, des priorités de progression et la bonne suite vers
                                les critères de participation ou le contact équipe.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left">
                <div class="orientation-shell">
                    <div class="orientation-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <h3>Ce que cette orientation couvre vraiment</h3>
                    <p>
                        DevAfricaArena est un espace de révélation et d'accompagnement des talents numériques. Cette
                        page doit donc rester alignée avec cette promesse: aider à identifier une filière, comprendre
                        les attentes du programme et avancer vers une candidature pertinente.
                    </p>

                    <ul class="orientation-list mt-4">
                        <li>
                            <i class="bi bi-check-circle-fill text-gold"></i>
                            <span>Une lecture simple des domaines numériques portés par le site et ses partenaires.</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-gold"></i>
                            <span>Des repères concrets pour les jeunes talents, les profils en progression et la reconversion.</span>
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill text-gold"></i>
                            <span>Une passerelle directe vers les critères, la candidature et l'accompagnement.</span>
                        </li>
                    </ul>

                    <div class="orientation-note">
                        L'orientation n'est pas un verdict. C'est un point d'appui pour choisir une direction réaliste
                        et mieux préparer la suite de votre parcours.
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center section-heading" data-aos="fade-up">
            <span class="section-badge">Filières clés</span>
            <h2 class="section-title">Les voies au cœur de <span class="text-gradient">DevAfricaArena</span></h2>
            <p class="section-copy">
                L'harmonisation de cette page passe aussi par un discours cohérent avec le reste du site: parler des
                métiers, des compétences et des usages réellement mis en avant dans l'Arena.
            </p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="50">
                <div class="orientation-focus">
                    <div class="orientation-icon">
                        <i class="bi bi-code-slash"></i>
                    </div>
                    <h3>Développement Web et Mobile</h3>
                    <p>
                        Pour les profils qui aiment construire, résoudre des problèmes et transformer une idée en
                        solution concrète. Une voie forte pour celles et ceux qui veulent livrer des produits utiles.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="orientation-focus">
                    <div class="orientation-icon">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h3>IA et Data</h3>
                    <p>
                        Pour les talents qui aiment analyser, modéliser, structurer des données et créer des décisions
                        plus intelligentes. Cette filière accompagne bien la dimension innovation du programme.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                <div class="orientation-focus">
                    <div class="orientation-icon">
                        <i class="bi bi-palette"></i>
                    </div>
                    <h3>Design Produit et UX</h3>
                    <p>
                        Pour les profils sensibles à l'expérience utilisateur, à la clarté visuelle et à la conception
                        d'interfaces fluides. Une compétence essentielle dans les projets numériques sérieux.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="orientation-focus">
                    <div class="orientation-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h3>Cybersécurité</h3>
                    <p>
                        Pour les talents qui veulent protéger les systèmes, anticiper les risques et renforcer la
                        confiance numérique. Cette voie demande rigueur, veille et sens des responsabilités.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="250">
                <div class="orientation-focus">
                    <div class="orientation-icon">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <h3>Marketing Digital</h3>
                    <p>
                        Pour celles et ceux qui savent raconter, diffuser et faire grandir un projet. Ici, l'orientation
                        relie communication, acquisition, stratégie et impact numérique.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="orientation-focus">
                    <div class="orientation-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h3>Fabrication Numérique et IoT</h3>
                    <p>
                        Pour les profils qui aiment tester, prototyper et connecter le monde physique au digital. Une
                        filière idéale pour les esprits pratiques et les porteurs de solutions utiles.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center section-heading" data-aos="fade-up">
            <span class="section-badge">Méthode</span>
            <h2 class="section-title">Comment se fait l'<span class="text-gradient">orientation</span></h2>
            <p class="section-copy">
                L'orientation ne sert pas à coller une étiquette. Elle aide à faire le tri entre vos envies, vos acquis
                et les attentes réelles du programme.
            </p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="50">
                <div class="orientation-step">
                    <div class="step-number">1</div>
                    <h3>Explorer les domaines</h3>
                    <p>
                        Vous identifiez les familles de métiers qui correspondent à votre curiosité, votre logique,
                        votre créativité ou votre envie d'impact.
                    </p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="orientation-step">
                    <div class="step-number">2</div>
                    <h3>Évaluer votre point de départ</h3>
                    <p>
                        Débutant, autodidacte, étudiant ou profil en reconversion: la bonne orientation part toujours de
                        ce que vous savez déjà faire et de ce que vous êtes prêt à apprendre.
                    </p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                <div class="orientation-step">
                    <div class="step-number">3</div>
                    <h3>Choisir la prochaine étape</h3>
                    <p>
                        Une fois la filière ciblée, vous pouvez avancer vers les critères, la candidature et
                        l'accompagnement proposé par DevAfricaArena.
                    </p>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-stretch">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="50">
                <div class="orientation-card">
                    <div class="orientation-icon">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <h3>Pour les jeunes talents</h3>
                    <p>
                        Si vous cherchez une première direction claire dans le numérique, cette page vous aide à choisir
                        un cap réaliste avant de candidater.
                    </p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="orientation-card">
                    <div class="orientation-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h3>Pour les profils en reconversion</h3>
                    <p>
                        L'objectif n'est pas d'effacer votre parcours précédent, mais de relire vos acquis sous l'angle
                        des compétences transférables vers les métiers du numérique.
                    </p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                <div class="orientation-card">
                    <div class="orientation-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3>Pour les futurs candidats</h3>
                    <p>
                        Cette orientation permet aussi de mieux comprendre l'esprit DevAfricaArena: excellence,
                        progression, utilité concrète et connexion avec l'écosystème tech.
                    </p>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-5" data-aos="fade-up">
                <div class="orientation-assistant">
                    <div class="orientation-icon">
                        <i class="bi bi-robot"></i>
                    </div>
                    <h3>Assistant d'orientation</h3>
                    <p>
                        Vous pouvez maintenant poser une question simple sur votre profil pour obtenir une première
                        recommandation d'orientation alignée avec les filières de l'Arena.
                    </p>

                    <form action="<?php echo e(route('orientation.ask')); ?>" method="POST" class="orientation-form">
                        <?php echo csrf_field(); ?>
                        <label for="question" class="form-label">Votre question</label>
                        <textarea
                            id="question"
                            name="question"
                            class="form-control <?php $__errorArgs = ['question'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Exemple : Je suis étudiant, j'aime résoudre des problèmes et créer des interfaces. Quelle filière me correspond le mieux ?"
                            maxlength="500"
                            required
                        ><?php echo e($question); ?></textarea>
                        <?php $__errorArgs = ['question'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <button type="submit" class="btn-submit mt-3">
                            Demander une recommandation
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                <div class="orientation-assistant">
                    <div class="orientation-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <h3>Réponse guidée</h3>
                    <p>
                        L'assistant ne remplace pas votre réflexion personnelle, mais il vous aide à clarifier une
                        direction, identifier des compétences à renforcer et préparer la suite.
                    </p>

                    <?php if(!empty($resultat)): ?>
                        <div class="assistant-answer">
                            <div class="assistant-answer-label">
                                <i class="bi bi-stars"></i>
                                Recommandation personnalisée
                            </div>
                            <p class="mb-0"><?php echo e($resultat); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="orientation-note mt-4">
                            Commencez par décrire votre profil, ce que vous aimez faire, votre niveau actuel et la
                            filière qui vous attire. La réponse sera plus utile si votre question est concrète.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="orientation-cta" data-aos="fade-up">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h3>Prêt à transformer cette orientation en candidature solide ?</h3>
                    <p>
                        Continuez avec les critères de participation pour vérifier si votre profil correspond au
                        programme, ou contactez l'équipe si vous voulez un échange plus ciblé.
                    </p>
                </div>

                <div class="col-lg-4">
                    <div class="cta-actions justify-content-lg-end">
                        <a href="<?php echo e(route('criteres')); ?>" class="btn-gold">Voir les critères</a>
                        <a href="<?php echo e(route('contact')); ?>" class="btn-outline-gold" style="border-color:rgba(255,255,255,0.22);color:#fff;">
                            Parler à l'équipe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\dev-africa-arena\resources\views/orientation/index.blade.php ENDPATH**/ ?>