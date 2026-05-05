<?php $__env->startSection('title', 'Quiz Arena | DevAfricaArena'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .quiz-page {
        min-height: calc(100vh - 90px);
        padding: 34px 0 52px;
        background: radial-gradient(circle at top right, rgba(243, 156, 18, 0.12), transparent 30%),
                    linear-gradient(180deg, #fffaf3 0%, #ffffff 55%, #fff7eb 100%);
    }
    .quiz-card { padding: 28px; background: rgba(255, 255, 255, 0.94); border-radius: 28px; box-shadow: 0 18px 50px rgba(0,0,0,0.06); }
    
    .timer-container {
        width: 100%;
        height: 8px;
        background: #eee;
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .timer-bar {
        height: 100%;
        background: #f39c12;
        width: 100%;
        transition: width 1s linear, background-color 0.3s;
    }
    .timer-text { font-weight: 800; color: #f39c12; font-size: 1.2rem; }
    
    .q-card { animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .quiz-option {
        border: 2px solid transparent;
        border-radius: 18px;
        padding: 16px 18px;
        background: #fffdf8;
        font-weight: 700;
        transition: all 0.2s ease;
        width: 100%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .quiz-option:hover:not(:disabled) { transform: translateY(-2px); background: #fff8eb; border-color: #f39c12; }
    .quiz-option.is-correct { background: #dcfce7 !important; border-color: #22c55e !important; color: #166534; }
    .quiz-option.is-wrong { background: #fee2e2 !important; border-color: #ef4444 !important; color: #b91c1c; }
    
    .explanation-box {
        display: none;
        background: #f0fdf4;
        border-left: 4px solid #22c55e;
        padding: 15px;
        margin-top: 15px;
        border-radius: 8px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="quiz-page">
    <div class="container">
        <?php if($questions->isEmpty()): ?>
            <div class="quiz-empty text-center p-5 card shadow-sm border-0">
                <div style="font-size:2.8rem;">🧠</div>
                <h1 class="fw-bold mt-3 mb-2">Quiz Arena indisponible</h1>
                <p class="text-muted mb-4">Aucune question trouvée. L'IA prépare de nouveaux défis !</p>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-warning fw-bold">Retour à l'accueil</a>
            </div>
        <?php else: ?>
            <div class="quiz-card">
                
                <?php if(isset($ai_fallback) && $ai_fallback): ?>
                <div class="alert alert-info border-0 shadow-sm mb-4 rounded-4">
                    🤖 <strong>Note :</strong> Le mode IA est surchargé. Nous avons chargé des questions de notre base de données pour vous !
                </div>
                <?php endif; ?>

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>
                        <span class="badge bg-warning text-dark mb-2">MODE <?php echo e($modeIa ? 'IA EXPERT' : 'STANDARD'); ?></span>
                        <h1 class="fw-bold mb-1 h3">Challenge : <?php echo e(ucfirst($domaine)); ?></h1>
                    </div>
                    <div class="text-end" id="timer-wrapper">
                        <div class="timer-text" id="timer-display">30s</div>
                        <small class="text-muted">Temps restant</small>
                    </div>
                </div>

                <div class="timer-container" id="progress-wrapper">
                    <div id="timer-bar" class="timer-bar"></div>
                </div>

                <div id="quiz-steps">
                    <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="q-card" data-step="<?php echo e($index); ?>" style="<?php echo e($index > 0 ? 'display:none;' : ''); ?>">
                            <div class="mb-4">
                                <span class="text-muted fw-bold">QUESTION <?php echo e($index + 1); ?> SUR <?php echo e($questions->count()); ?></span>
                                
                                <h2 class="fw-bold mt-2 h4"><?php echo e($question->enonce ?? $question->texte); ?></h2>
                            </div>

                            <div class="d-grid gap-3 options-container">
                                <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" class="quiz-option option-btn text-start" 
                                            data-correct="<?php echo e((bool)$option->est_correcte ? 1 : 0); ?>">
                                        <?php echo e($option->texte); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php if(!empty($question->explication)): ?>
                            <div class="explanation-box mt-3" id="expl-<?php echo e($index); ?>">
                                <strong>💡 Le saviez-vous ?</strong><br>
                                <?php echo e($question->explication); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Résultats finaux -->
                <div id="final-results" class="text-center py-4" style="display:none;">
                    <div style="font-size:4rem;">🏆</div>
                    <h2 class="fw-bold mb-2">Challenge terminé !</h2>
                    <div class="display-4 fw-bold text-warning mb-3">
                        <span id="score-val">0</span> / <?php echo e($questions->count()); ?>

                    </div>
                    <p id="feedback-text" class="fs-5 mb-4"></p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="<?php echo e(url()->full()); ?>" class="btn btn-warning px-4 py-2 fw-bold shadow-sm">Rejouer</a>
                        <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-dark px-4 py-2">Quitter</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
    const totalQuestions = <?php echo e($questions->count()); ?>;
    let currentStep = 0;
    let score = 0;
    let timeLeft = 30;
    let timerInterval;
    let locked = false;

    function startTimer() {
        timeLeft = 30;
        updateTimerDisplay();
        
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            timeLeft--;
            updateTimerDisplay();
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                handleTimeOut();
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        const bar = document.getElementById('timer-bar');
        const display = document.getElementById('timer-display');
        if (!bar || !display) return;

        const percentage = (timeLeft / 30) * 100;
        bar.style.width = percentage + '%';
        display.textContent = timeLeft + 's';
        
        bar.style.backgroundColor = (timeLeft <= 10) ? '#e74c3c' : '#f39c12';
    }

    function handleTimeOut() {
        if (locked) return;
        locked = true;

        const currentCard = document.querySelector(`[data-step="${currentStep}"]`);
        const correctBtn = currentCard.querySelector('[data-correct="1"]');
        if (correctBtn) correctBtn.classList.add('is-correct');

        const expl = document.getElementById(`expl-${currentStep}`);
        if (expl) expl.style.display = 'block';

        setTimeout(nextQuestion, 3000);
    }

    function nextQuestion() {
        const currentCard = document.querySelector(`[data-step="${currentStep}"]`);
        if(currentCard) currentCard.style.display = 'none';
        
        currentStep++;

        const nextCard = document.querySelector(`[data-step="${currentStep}"]`);
        if (nextCard) {
            nextCard.style.display = 'block';
            locked = false;
            startTimer();
        } else {
            showFinalResults();
        }
    }

    function showFinalResults() {
        clearInterval(timerInterval);
        document.getElementById('quiz-steps').style.display = 'none';
        document.getElementById('progress-wrapper').style.display = 'none';
        document.getElementById('timer-wrapper').style.display = 'none';
        document.getElementById('final-results').style.display = 'block';
        document.getElementById('score-val').textContent = score;
        
        const feedback = document.getElementById('feedback-text');
        if (score === totalQuestions) feedback.textContent = "Incroyable Juliette ! Tu es une véritable experte.";
        else if (score >= totalQuestions / 2) feedback.textContent = "Pas mal ! Tu as de bonnes bases pour le hackathon.";
        else feedback.textContent = "Continue d'apprendre, le succès est au bout de l'effort !";
    }

    document.querySelectorAll('.option-btn').forEach((btn) => {
        btn.addEventListener('click', function () {
            if (locked) return;
            locked = true;
            clearInterval(timerInterval);

            const isCorrect = this.dataset.correct === '1';
            const container = this.closest('.q-card');

            if (isCorrect) {
                score++;
                this.classList.add('is-correct');
            } else {
                this.classList.add('is-wrong');
                const correctBtn = container.querySelector('[data-correct="1"]');
                if(correctBtn) correctBtn.classList.add('is-correct');
            }

            const expl = document.getElementById(`expl-${currentStep}`);
            if (expl) expl.style.display = 'block';

            setTimeout(nextQuestion, 2500);
        });
    });

    if (totalQuestions > 0) startTimer();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\dev-africa-arena\resources\views/pages/quiz-play.blade.php ENDPATH**/ ?>