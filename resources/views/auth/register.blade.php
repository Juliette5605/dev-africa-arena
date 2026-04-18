<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription | DevAfricaArena</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body { background: #0d0d0d; color: white; font-family: 'Plus Jakarta Sans', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .card { background: #161616; padding: 40px; border-radius: 24px; border: 1px solid rgba(243,156,18,0.2); width: 100%; max-width: 450px; box-shadow: 0 40px 80px rgba(0,0,0,0.6); }
        .brand { text-align: center; color: #f39c12; font-weight: 800; font-size: 1.5rem; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-size: 0.7rem; color: rgba(255,255,255,0.5); text-transform: uppercase; margin-bottom: 5px; }
        input { width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px; color: white; outline: none; }
        input:focus { border-color: #f39c12; }
        .btn { width: 100%; background: #f39c12; color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 800; cursor: pointer; margin-top: 20px; }
        .row { display: flex; gap: 10px; }
    </style>
</head>
<body>

    <div class="card">
        <div class="brand">DevAfricaArena</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="first_name" required autofocus>
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="last_name" required>
                </div>
            </div>

            <div class="form-group">
                <label>Date de naissance</label>
                <input type="date" name="birthday" required>
            </div>

            <div class="form-group">
                <label>Email Professionnel</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" required>
            </div>

            <input type="hidden" name="password_confirmation" id="pc">

            <button type="submit" class="btn" onclick="document.getElementById('pc').value = document.getElementsByName('password')[0].value">
                CRÉER MON COMPTE
            </button>
            
            <p style="text-align: center; margin-top: 15px; font-size: 0.8rem;">
                <a href="{{ route('login') }}" style="color: #f39c12; text-decoration: none;">Déjà un compte ? Se connecter</a>
            </p>
        </form>
    </div>

</body>
</html>