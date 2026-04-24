<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DevAfricaArena | Authentification</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            background: #0d0d0d; font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative; overflow-x: hidden; color: white;
        }

        .bg-glow {
            position: absolute; width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(243,156,18,0.12) 0%, transparent 70%);
            top: 50%; left: 50%; transform: translate(-50%,-50%);
            animation: pulse 4s ease-in-out infinite; z-index: 1;
        }
        @keyframes pulse { 0%,100%{transform:translate(-50%,-50%) scale(1);} 50%{transform:translate(-50%,-50%) scale(1.1);} }

        .login-card {
            position: relative; z-index: 10; background: #161616; 
            border: 1px solid rgba(243,156,18,0.2); border-radius: 24px; 
            padding: 40px; width: 100%; max-width: 450px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6);
        }

        .brand { text-align: center; margin-bottom: 25px; }
        .brand-icon { font-size: 2.5rem; color: #f39c12; }
        .brand h1 { color: #f39c12; font-size: 1.4rem; font-weight: 800; margin-top: 5px; }
        .brand p { color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 8px; line-height: 1.5; }

        .tabs { display: flex; gap: 20px; justify-content: center; margin-bottom: 25px; }
        .tab { cursor: pointer; font-size: 0.8rem; font-weight: 800; color: rgba(255,255,255,0.3); border-bottom: 2px solid transparent; padding-bottom: 5px; text-transform: uppercase; }
        .tab.active { color: #f39c12; border-bottom-color: #f39c12; }

        .alert-box {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.82);
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 18px;
            font-size: 0.85rem;
        }
        .alert-box.error {
            border-color: rgba(220,53,69,0.35);
            background: rgba(220,53,69,0.10);
            color: #ffb8c0;
        }

        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 0.7rem; font-weight: 700; color: rgba(255,255,255,0.5); margin-bottom: 5px; text-transform: uppercase; }
        .form-control {
            width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px; padding: 12px; color: white; font-family: inherit; font-size: 0.9rem;
        }
        .form-control:focus { outline: none; border-color: #f39c12; }

        /* Captcha Style */
        .captcha-box {
            background: rgba(243,156,18,0.05); border: 1px dashed rgba(243,156,18,0.3);
            padding: 10px; border-radius: 10px; display: flex; align-items: center; justify-content: space-between;
        }

        .btn-action {
            width: 100%; background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white; border: none; border-radius: 10px; padding: 14px;
            font-weight: 800; cursor: pointer; margin-top: 15px; transition: 0.3s;
        }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(243,156,18,0.4); }

        .row { display: flex; gap: 10px; }
        .row div { flex: 1; }
    </style>
</head>
<body>

    <div class="bg-glow"></div>

    <div class="login-card">
        <div class="brand">
            <i class="bi bi-cpu-fill brand-icon"></i>
            <h1>DevAfricaArena</h1>
            <p>Inscris-toi ou connecte-toi avant d'acceder au site complet et a ton dashboard personnel.</p>
        </div>

        <div class="alert-box">
            L'acces au site candidat est reserve aux utilisateurs connectes.
        </div>

        @if($errors->any())
            <div class="alert-box error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="tabs">
            <span id="t-login" class="tab active" onclick="showForm('login')">Connexion</span>
            <span id="t-reg" class="tab" onclick="showForm('reg')">Inscription</span>
        </div>

        <form id="f-login" action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nom@exemple.com" required>
            </div>
            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-action">SE CONNECTER</button>
        </form>

        <form id="f-reg" action="/register" method="POST" style="display:none;">
            @csrf
            <div class="row">
                <div class="form-group">
                    <label class="form-label">Prénom</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Jean" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nom</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Koffi" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Date de naissance</label>
                <input type="date" name="birthday" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email Professionnel</label>
                <input type="email" name="email" class="form-control" placeholder="nom@entreprise.com" required>
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input type="password" id="pass1" name="password" class="form-control" placeholder="8+ caractères" required>
            </div>
            
            <input type="hidden" name="password_confirmation" id="pass2">

            <div class="form-group">
                <label class="form-label">Vérification humaine</label>
                <div class="captcha-box">
                    <span id="captcha-text" style="font-weight: 800; color: #f39c12;">Combien font 5 + 3 ?</span>
                    <input type="text" id="captcha-input" class="form-control" style="width: 60px; padding: 5px; text-align: center;" placeholder="?" required>
                </div>
            </div>

            <button type="submit" class="btn-action">
                CRÉER MON COMPTE
            </button>
        </form>
    </div>

    <script>
        const initialMode = @json($authMode ?? 'login');
        const csrfRefreshUrl = @json(route('csrf.refresh'));

        function showForm(mode) {
            const fLogin = document.getElementById('f-login'), fReg = document.getElementById('f-reg');
            const tLogin = document.getElementById('t-login'), tReg = document.getElementById('t-reg');

            if(mode === 'reg') {
                fLogin.style.display = 'none'; fReg.style.display = 'block';
                tReg.classList.add('active'); tLogin.classList.remove('active');
            } else {
                fLogin.style.display = 'block'; fReg.style.display = 'none';
                tLogin.classList.add('active'); tReg.classList.remove('active');
            }
        }

        function validateAndSubmit() {
            // 1. Synchronise le mot de passe pour Laravel Breeze
            document.getElementById('pass2').value = document.getElementById('pass1').value;

            // 2. Vérifie le captcha (5 + 3 = 8)
            const captcha = document.getElementById('captcha-input').value;
            if(captcha !== "8") {
                alert("Erreur de vérification : Vous semblez être un robot !");
                return false;
            }
            return true;
        }

        async function refreshCsrfToken() {
            const response = await fetch(csrfRefreshUrl, {
                method: 'GET',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error('csrf_refresh_failed');
            }

            const data = await response.json();
            document.querySelectorAll('input[name="_token"]').forEach((input) => {
                input.value = data.token;
            });
        }

        function bindProtectedSubmit(form, validator = null) {
            form.addEventListener('submit', async function (event) {
                if (form.dataset.submitting === '1') {
                    return;
                }

                event.preventDefault();

                if (validator && !validator()) {
                    return;
                }

                form.dataset.submitting = '1';

                try {
                    await refreshCsrfToken();
                    form.submit();
                } catch (error) {
                    form.dataset.submitting = '0';
                    alert("La session a expiré. Le formulaire va être rechargé avec un nouveau token.");
                    window.location.reload();
                }
            });
        }

        bindProtectedSubmit(document.getElementById('f-login'));
        bindProtectedSubmit(document.getElementById('f-reg'), validateAndSubmit);
        showForm(initialMode);
    </script>
</body>
</html>
