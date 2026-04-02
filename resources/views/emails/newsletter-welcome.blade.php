<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:'Segoe UI',Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:40px 0;">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 10px 40px rgba(0,0,0,0.08);">
      <tr>
        <td style="background:linear-gradient(135deg,#222 0%,#333 100%);padding:50px;text-align:center;">
          <div style="font-size:48px;margin-bottom:15px;"></div>
          <h1 style="margin:0;color:#f39c12;font-size:32px;font-weight:800;">Bienvenue dans l'Arena !</h1>
          <p style="margin:10px 0 0;color:rgba(255,255,255,0.7);font-size:14px;">DevAfrica Arena 2026 — Lomé, Togo</p>
        </td>
      </tr>
      <tr>
        <td style="padding:50px;">
          <p style="color:#666;font-size:15px;line-height:1.8;margin:0 0 25px;">
            Bonjour {{ $subscriber->nom ?? 'talent' }}, vous êtes maintenant dans la liste exclusive des personnes qui suivent <strong>DevAfrica Arena</strong> — le premier championnat technologique d'Afrique de l'Ouest.
          </p>
          <div style="background:#fffbf0;border-left:4px solid #f39c12;border-radius:0 12px 12px 0;padding:20px 25px;margin-bottom:30px;">
            <p style="margin:0;color:#222;font-weight:700;font-size:14px;">Vous recevrez en avant-première :</p>
            <ul style="margin:10px 0 0;padding-left:20px;color:#555;font-size:14px;line-height:2;">
              <li>Les dates des prochaines éditions</li>
              <li>Les ouvertures d'inscriptions candidats</li>
              <li>Les résultats & classements live</li>
              <li>Les offres d'emploi exclusives partenaires</li>
            </ul>
          </div>
          <div style="text-align:center;margin-top:35px;">
            <a href="{{ config('app.url') }}/criteres" style="display:inline-block;background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;text-decoration:none;padding:16px 40px;border-radius:50px;font-weight:800;font-size:15px;">
              Postuler maintenant →
            </a>
          </div>
        </td>
      </tr>
      <tr>
        <td style="background:#222;padding:25px 50px;text-align:center;">
          <p style="margin:0;color:rgba(255,255,255,0.4);font-size:11px;">© {{ date('Y') }} DevAfrica Arena · Lomé, Togo · <a href="{{ config('app.url') }}" style="color:#f39c12;">devafricaarena.com</a></p>
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
