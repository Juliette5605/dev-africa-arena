

<?php $__env->startSection('title', 'Critères & Inscription | DevAfricaArena'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        :root {
            --brand-gold: #c9933b;
            --brand-dark: #1a1a1a;
            --accent-gradient: linear-gradient(135deg, #c9933b 0%, #e2b05e 100%);
        }

        #snow-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .content-wrapper {
            position: relative;
            z-index: 2;
        }

        .tech-badge {
            display: inline-block;
            padding: 8px 20px;
            margin: 5px;
            background: #f8f9fa;
            border: 1px solid #eee;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            transition: 0.3s;
        }

        .tech-badge:hover {
            border-color: var(--brand-gold);
            color: var(--brand-gold);
        }

        .category-title {
            border-left: 4px solid var(--brand-gold);
            padding-left: 15px;
            margin-bottom: 25px;
            font-weight: 800;
        }

        .registration-box {
            background: var(--brand-dark);
            color: white;
            border-radius: 40px;
            padding: 60px;
            margin-bottom: 80px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #bbb;
            text-transform: uppercase;
            margin-bottom: 10px;
            display: block;
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 2px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 12px;
            padding: 15px;
            color: white !important;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: var(--brand-gold) !important;
            box-shadow: 0 0 0 4px rgba(201, 147, 59, 0.2) !important;
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-select option {
            color: #111;
            background: #fff;
        }

        .btn-register {
            background: var(--accent-gradient);
            border: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 800;
            color: white;
            width: 100%;
            transition: 0.3s transform ease;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(201, 147, 59, 0.3);
        }

        .account-lock {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(201, 147, 59, 0.28);
            border-radius: 16px;
            padding: 16px 18px;
            margin-bottom: 30px;
        }

        .account-lock strong {
            color: #fff;
        }

        @media(max-width:768px) {
            .registration-box {
                padding: 30px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <canvas id="snow-canvas"></canvas>
    <div class="content-wrapper">
        <header class="py-5 mt-5 text-center">
            <div class="container">
                <span class="badge bg-dark rounded-pill px-3 py-2 mb-3">DEVAFRICA ARENA 2026</span>
                <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">Critères de <span class="text-gradient">Sélection</span></h1>
            </div>
        </header>

        <div class="container">
            <?php if(session('success')): ?>
                <div class="alert alert-success rounded-4 py-3 fw-bold border-0 shadow-sm mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <section class="py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="category-title text-uppercase">Frontend</h3>
                        <span class="tech-badge">HTML5 / CSS3</span>
                        <span class="tech-badge">JavaScript (ES6+)</span>
                        <span class="tech-badge">React / Next.js</span>
                        <span class="tech-badge">TypeScript</span>
                        <span class="tech-badge">Tailwind CSS</span>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="category-title text-uppercase">Backend & Ops</h3>
                        <span class="tech-badge">Node.js / NestJS</span>
                        <span class="tech-badge">Python / FastAPI</span>
                        <span class="tech-badge">Docker / Redis</span>
                        <span class="tech-badge">PostgreSQL</span>
                        <span class="tech-badge">MongoDB</span>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="category-title text-uppercase">Mobile Development</h3>
                        <span class="tech-badge">Dart / Flutter</span>
                        <span class="tech-badge">Firebase</span>
                        <span class="tech-badge">Sqflite</span>
                        <span class="tech-badge">Kotlin</span>
                        <span class="tech-badge">Swift</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="registration-box" data-aos="zoom-in">
                <?php if(auth()->guard()->check()): ?>
                    <?php
                        $hasExistingCandidature = \App\Models\Candidature::where('email', auth()->user()->email)->exists();
                    ?>
                    <h2 class="fw-bold mb-5 text-center text-white">Soumettre ma candidature</h2>

                    <div class="account-lock">
                        <p class="mb-1 small text-uppercase fw-bold" style="letter-spacing:1px;color:#c9933b;">Compte connecté</p>
                        <p class="mb-0">
                            Cette candidature sera automatiquement liée à l'adresse
                            <strong><?php echo e(auth()->user()->email); ?></strong>.
                        </p>
                    </div>

                    <?php if($hasExistingCandidature): ?>
                        <div class="alert alert-warning rounded-4 border-0 shadow-sm mb-0">
                            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                                <div>
                                    <strong>Une candidature existe déjà pour ce compte.</strong><br>
                                    Consultez votre dashboard personnel pour suivre votre dossier.
                                </div>
                                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-dark rounded-pill px-4 py-2 fw-bold">
                                    Aller à mon dashboard
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <form action="<?php echo e(route('criteres.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="nom" class="form-control" value="<?php echo e(old('nom', auth()->user()->last_name ?? '')); ?>" placeholder="Votre nom" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" value="<?php echo e(old('prenom', auth()->user()->first_name ?? '')); ?>" placeholder="Votre prénom" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email du compte</label>
                                    <input type="email" class="form-control" value="<?php echo e(auth()->user()->email); ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Âge</label>
                                    <input type="number" name="age" class="form-control" value="<?php echo e(old('age')); ?>" min="16" max="60" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Niveau</label>
                                    <select name="niveau" class="form-select">
                                        <option value="Junior" <?php echo e(old('niveau') == 'Junior' ? 'selected' : ''); ?>>Junior</option>
                                        <option value="Intermédiaire" <?php echo e(old('niveau') == 'Intermédiaire' ? 'selected' : ''); ?>>Intermédiaire</option>
                                        <option value="Senior" <?php echo e(old('niveau') == 'Senior' ? 'selected' : ''); ?>>Senior</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pays</label>
                                    <input type="text" name="pays" class="form-control" value="<?php echo e(old('pays')); ?>" placeholder="Ex: Togo" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Expertise Principale</label>
                                    <input type="text" name="expertise" class="form-control" placeholder="Ex: Flutter / Web" value="<?php echo e(old('expertise')); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Diplôme</label>
                                    <input type="text" name="diplome" class="form-control" value="<?php echo e(old('diplome')); ?>" placeholder="Dernier diplôme obtenu" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Motivation</label>
                                    <textarea name="motivation" class="form-control" rows="3" placeholder="Pourquoi souhaitez-vous participer ?" required><?php echo e(old('motivation')); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Vision Tech (Projets futurs)</label>
                                    <textarea name="vision" class="form-control" rows="3" placeholder="Où vous voyez-vous dans 5 ans ?" required><?php echo e(old('vision')); ?></textarea>
                                </div>
                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn-register">Envoyer ma candidature</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center p-4">
                        <h2 class="fw-bold mb-4 text-white">Soumettre ma candidature</h2>
                        <p class="text-white-50">Veuillez vous connecter pour accéder au formulaire de candidature.</p>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-warning rounded-pill px-5 py-3 fw-bold mt-3">Se connecter / S'inscrire</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        const canvas = document.getElementById('snow-canvas');
        const ctx = canvas.getContext('2d');
        let p = [];

        function i() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            p = [];
            for (let j = 0; j < 50; j++) {
                p.push({
                    x: Math.random() * canvas.width,
                    y: Math.random() * canvas.height,
                    s: Math.random() * 2 + 1,
                    v: Math.random() * 0.5 + 0.1,
                    o: Math.random() * 0.3
                });
            }
        }

        function a() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            p.forEach(q => {
                ctx.fillStyle = `rgba(180,180,180,${q.o})`;
                ctx.beginPath();
                ctx.arc(q.x, q.y, q.s, 0, Math.PI * 2);
                ctx.fill();
                q.y += q.v;
                if (q.y > canvas.height) q.y = -5;
            });
            requestAnimationFrame(a);
        }

        i();
        a();
        window.onresize = i;
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/pages/criteres.blade.php ENDPATH**/ ?>