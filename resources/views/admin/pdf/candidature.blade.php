<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
    body{font-family:Arial,sans-serif;color:#222;font-size:13px;margin:0;padding:0;}
    .header{background:#222;color:#fff;padding:24px 32px;display:flex;justify-content:space-between;align-items:center;}
    .header h1{margin:0;font-size:1.4rem;color:#f39c12;}
    .header p{margin:0;color:rgba(255,255,255,0.6);font-size:0.8rem;}
    .body{padding:32px;}
    .section{margin-bottom:24px;}
    .section-title{font-size:0.7rem;font-weight:bold;text-transform:uppercase;letter-spacing:1px;color:#888;border-bottom:2px solid #f39c12;padding-bottom:6px;margin-bottom:12px;}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
    .field label{font-size:0.7rem;color:#888;text-transform:uppercase;display:block;margin-bottom:3px;}
    .field p{margin:0;font-weight:600;}
    .badge{display:inline-block;padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;}
    .stars{color:#f39c12;font-size:1.1rem;}
    .text-block{background:#f8f9fa;border-left:3px solid #f39c12;padding:12px 16px;border-radius:0 8px 8px 0;line-height:1.6;}
    .footer{background:#f8f9fa;padding:16px 32px;text-align:center;font-size:0.75rem;color:#888;border-top:1px solid #eee;}
</style>
</head>
<body>
<div class="header">
    <div>
        <h1> DevAfricaArena</h1>
        <p>Dossier de candidature — #{{ str_pad($candidature->id,4,'0',STR_PAD_LEFT) }}</p>
    </div>
    <div style="text-align:right;">
        <p style="color:#f39c12;font-weight:bold;font-size:1rem;">{{ $candidature->statut_label }}</p>
        <p>Généré le {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</div>

<div class="body">
    <div class="section">
        <div class="section-title">Informations personnelles</div>
        <div class="grid">
            <div class="field"><label>Nom complet</label><p>{{ $candidature->prenom }} {{ $candidature->nom }}</p></div>
            <div class="field"><label>Email</label><p>{{ $candidature->email }}</p></div>
            <div class="field"><label>Âge</label><p>{{ $candidature->age }} ans</p></div>
            <div class="field"><label>Pays</label><p>{{ $candidature->pays }}</p></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Profil technique</div>
        <div class="grid">
            <div class="field"><label>Niveau</label><p>{{ $candidature->niveau }}</p></div>
            <div class="field"><label>Expertise</label><p>{{ $candidature->expertise }}</p></div>
            <div class="field"><label>Diplôme</label><p>{{ $candidature->diplome }}</p></div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Motivation</div>
        <div class="text-block">{{ $candidature->motivation }}</div>
    </div>

    <div class="section">
        <div class="section-title">Vision</div>
        <div class="text-block">{{ $candidature->vision }}</div>
    </div>

    @if($candidature->note)
    <div class="section">
        <div class="section-title">Évaluation admin</div>
        <div class="grid">
            <div class="field">
                <label>Note</label>
                <p class="stars">@for($i=1;$i<=5;$i++){{ $i<=$candidature->note?'★':'☆' }}@endfor ({{ $candidature->note }}/5)</p>
            </div>
            <div class="field">
                <label>Statut</label>
                <p>{{ $candidature->statut_label }}</p>
            </div>
        </div>
        @if($candidature->commentaire_admin)
        <div class="text-block mt-3">{{ $candidature->commentaire_admin }}</div>
        @endif
    </div>
    @endif
</div>

<div class="footer">
    DevAfricaArena · Lomé, Togo · wilsoncodemosaic@gmail.com · +228 71 15 50 55
</div>
</body>
</html>
