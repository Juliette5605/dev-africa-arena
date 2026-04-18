<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin - DevAfrica Arena'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #f39c12;
            --primary-dark: #e67e22;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --dark: #343a40;
            --light: #f8f9fa;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #343a40 0%, #495057 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar.collapsed .sidebar-header {
            padding: 20px 10px;
        }

        .sidebar-logo {
            height: 40px;
            filter: brightness(0) invert(1);
        }

        .sidebar.collapsed .sidebar-logo {
            height: 30px;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: 10px;
            color: var(--primary);
        }

        .sidebar.collapsed .sidebar-title {
            display: none;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav .nav-item {
            margin: 5px 0;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .sidebar.collapsed .sidebar-nav .nav-link {
            padding: 12px 20px;
            justify-content: center;
        }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background-color: rgba(243,156,18,0.2);
            color: white;
            border-left: 4px solid var(--primary);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            margin-right: 15px;
            font-size: 1.1rem;
        }

        .sidebar.collapsed .sidebar-nav .nav-link i {
            margin-right: 0;
        }

        .sidebar-nav .nav-link span {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-nav .nav-link span {
            opacity: 0;
            position: absolute;
            left: 70px;
            background: var(--dark);
            padding: 8px 12px;
            border-radius: 4px;
            white-space: nowrap;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .sidebar.collapsed .sidebar-nav .nav-link:hover span {
            opacity: 1;
        }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.collapsed ~ .main-content {
            margin-left: 70px;
        }

        /* Top navbar */
        .top-navbar {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .top-navbar .navbar-brand {
            font-weight: 700;
            color: var(--dark);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .user-role {
            color: var(--secondary);
            font-size: 0.8rem;
            margin-bottom: 0;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Content area */
        .content-wrapper {
            padding: 30px;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: var(--dark);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* Tables */
        .table th {
            background: #f8f9fa;
            border-top: none;
            font-weight: 600;
            color: var(--dark);
        }

        /* Badges */
        .badge {
            font-size: 0.75rem;
        }

        /* Progress bars */
        .progress {
            height: 8px;
            border-radius: 4px;
        }

        /* Modal */
        .modal-content {
            border-radius: 10px;
            border: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.collapsed ~ .main-content {
                margin-left: 0;
            }

            .content-wrapper {
                padding: 20px 15px;
            }
        }

        /* Toggle button */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: var(--sidebar-width);
            z-index: 1001;
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed ~ .sidebar-toggle {
            left: 70px;
        }

        .sidebar-toggle:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: none;
            }
        }

        /* Flash messages */
        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #dc3545, #fd7e14);
            color: white;
        }

        /* Loading spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="<?php echo e(asset('assets/logoprincipal-removebg-preview.png')); ?>" alt="DevAfrica Arena" class="sidebar-logo">
            <div class="sidebar-title">Admin Panel</div>
        </div>

        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.candidatures')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.candidatures*') ? 'active' : ''); ?>">
                    <i class="fas fa-users"></i>
                    <span>Candidatures</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.messages')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.messages*') ? 'active' : ''); ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.finalistes')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.finalistes') ? 'active' : ''); ?>">
                    <i class="fas fa-star"></i>
                    <span>Finalistes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.partenaires')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.partenaires*') ? 'active' : ''); ?>">
                    <i class="fas fa-handshake"></i>
                    <span>Partenaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.newsletters')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.newsletters*') ? 'active' : ''); ?>">
                    <i class="fas fa-newspaper"></i>
                    <span>Newsletters</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.settings')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings*') ? 'active' : ''); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.profile')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.profile*') ? 'active' : ''); ?>">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a href="<?php echo e(route('home')); ?>" class="nav-link" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Site Public</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('admin.logout')); ?>" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Sidebar toggle button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="top-navbar">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h4>

                    <div class="user-menu">
                        <div class="user-info">
                            <p class="user-name"><?php echo e(auth('admin')->user()->name ?? 'Admin'); ?></p>
                            <p class="user-role">Administrateur</p>
                        </div>
                        <div class="user-avatar">
                            <?php echo e(strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1))); ?>

                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash messages -->
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');

            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\devafrica-arena-laravel-FULL\arena-laravel\resources\views/layouts/admin.blade.php ENDPATH**/ ?>