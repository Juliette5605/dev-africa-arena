<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | DevAfricaArena</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* RESET & BASE */
        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d0d0d;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* ANIMATED GLOW BACKGROUND */
        .bg-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(243, 156, 18, 0.08) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.15);
            }
        }

        /* LOGIN CARD */
        .login-card {
            position: relative;
            z-index: 2;
            background: #161616;
            border: 1px solid rgba(243, 156, 18, 0.15);
            border-radius: 24px;
            padding: 50px 45px;
            width: 420px;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
        }

        /* BRANDING */
        .brand {
            text-align: center;
            margin-bottom: 35px;
        }

        .brand-icon {
            font-size: 3rem;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .brand h1 {
            color: #f39c12;
            font-size: 1.4rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .brand p {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 5px;
        }

        /* FORM ELEMENTS */
        .form-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #fff;
            border-radius: 12px;
            padding: 14px 18px;
            width: 100%;
            font-family: inherit;
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #f39c12;
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.2);
        }

        /* BUTTON */
        .btn-login {
            width: 100%;
            padding: 15px;
            margin-top: 25px;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            font-family: inherit;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(243, 156, 18, 0.3);
        }

        /* ALERTS */
        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* LINKS */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .back-link:hover {
            color: #f39c12;
        }

        .forgot-link {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.8rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .forgot-link:hover {
            color: rgba(255, 255, 255, 0.7);
        }

        .mb-4 {
            margin-bottom: 18px;
        }

        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="bg-glow"></div>

    <div class="login-card">
        <!-- BRAND -->
        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-cpu-fill"></i>
            </div>
            <h1>DevAfricaArena</h1>
            <p>Administration Panel</p>
        </div>

        <!-- ERROR ALERTS -->
        @if($errors->any())
            <div class="alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- LOGIN FORM -->
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">Email Professionnel</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@talentsync.ai" required autofocus>
            </div>

            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-shield-lock-fill"></i> Authentification
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('admin.password.request') }}" class="forgot-link">
                    Accès perdu ? Réinitialiser
                </a>
            </div>
        </form>

        <a href="{{ route('home') }}" class="back-link">
            <i class="bi bi-arrow-left me-1"></i> Retour au site public
        </a>
    </div>

</body>

</html>