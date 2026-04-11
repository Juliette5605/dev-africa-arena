<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Candidature reçue — DevAfrica Arena</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:'Segoe UI',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:40px 0;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:20px;overflow:hidden;box-shadow:0 10px 40px rgba(0,0,0,0.08);">

        
        <tr>
          <td style="background:linear-gradient(135deg,#f39c12 0%,#e67e22 100%);padding:40px 50px;text-align:center;">
            <h1 style="margin:0;color:#ffffff;font-size:28px;font-weight:800;letter-spacing:-1px;">
               DevAfrica Arena
            </h1>
            <p style="margin:8px 0 0;color:rgba(255,255,255,0.85);font-size:14px;text-transform:uppercase;letter-spacing:2px;">
              L'Arène des Talents Numériques
            </p>
          </td>
        </tr>

        
        <tr>
          <td style="padding:50px;">
            <h2 style="color:#222;font-size:22px;font-weight:800;margin:0 0 10px;">
               Candidature bien reçue, <?php echo e($candidature->prenom); ?> !
            </h2>
            <p style="color:#666;font-size:15px;line-height:1.7;margin:0 0 30px;">
              Nous avons bien enregistré votre dossier de candidature pour la prochaine édition de <strong>DevAfrica Arena 2026</strong> à Lomé.
            </p>

            
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fa;border-radius:15px;overflow:hidden;margin-bottom:30px;">
              <tr>
                <td style="padding:25px 30px;">
                  <p style="margin:0 0 5px;color:#f39c12;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1px;">RÉCAPITULATIF</p>
                  <h3 style="margin:0 0 20px;color:#222;font-size:16px;">Votre dossier</h3>
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="padding:8px 0;color:#888;font-size:13px;width:40%;">Nom complet</td>
                      <td style="padding:8px 0;color:#222;font-size:13px;font-weight:700;"><?php echo e($candidature->prenom); ?> <?php echo e($candidature->nom); ?></td>
                    </tr>
                    <tr style="border-top:1px solid #eee;">
                      <td style="padding:8px 0;color:#888;font-size:13px;">Niveau</td>
                      <td style="padding:8px 0;color:#222;font-size:13px;font-weight:700;"><?php echo e($candidature->niveau); ?></td>
                    </tr>
                    <tr style="border-top:1px solid #eee;">
                      <td style="padding:8px 0;color:#888;font-size:13px;">Expertise</td>
                      <td style="padding:8px 0;color:#222;font-size:13px;font-weight:700;"><?php echo e($candidature->expertise); ?></td>
                    </tr>
                    <tr style="border-top:1px solid #eee;">
                      <td style="padding:8px 0;color:#888;font-size:13px;">Pays</td>
                      <td style="padding:8px 0;color:#222;font-size:13px;font-weight:700;"><?php echo e($candidature->pays); ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            
            <h3 style="color:#222;font-size:16px;font-weight:800;margin:0 0 15px;"> Prochaines étapes</h3>
            <table width="100%" cellpadding="0" cellspacing="0">
              <?php $__currentLoopData = [['01','Confirmation de dossier','Votre candidature est en cours d\'examen par notre équipe.'],['02','Convocation','Les candidats retenus recevront une convocation par email.'],['03','Sélection Day','Jour J : Le Grand Quiz + Code Challenge à Lomé.']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$n,$t,$d]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td style="padding:0 0 15px;">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td style="width:40px;vertical-align:top;">
                        <div style="width:32px;height:32px;background:linear-gradient(135deg,#f39c12,#e67e22);border-radius:50%;text-align:center;line-height:32px;color:white;font-weight:800;font-size:12px;"><?php echo e($n); ?></div>
                      </td>
                      <td style="padding-left:12px;vertical-align:top;">
                        <p style="margin:0 0 3px;color:#222;font-weight:700;font-size:14px;"><?php echo e($t); ?></p>
                        <p style="margin:0;color:#888;font-size:13px;"><?php echo e($d); ?></p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>

            
            <div style="text-align:center;margin:35px 0 0;">
              <a href="<?php echo e(config('app.url')); ?>" style="display:inline-block;background:linear-gradient(135deg,#f39c12,#e67e22);color:#ffffff;text-decoration:none;padding:16px 40px;border-radius:50px;font-weight:800;font-size:15px;">
                 Retour à l'Arena
              </a>
            </div>
          </td>
        </tr>

        
        <tr>
          <td style="background:#222;padding:30px 50px;text-align:center;">
            <p style="margin:0 0 5px;color:rgba(255,255,255,0.5);font-size:12px;">© <?php echo e(date('Y')); ?> DevAfrica Arena — Lomé, Togo</p>
            <p style="margin:0;color:rgba(255,255,255,0.3);font-size:11px;">Adjété Alex WILSON · wilsoncodemosaic@gmail.com · +228 71 15 50 55</p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
<?php /**PATH C:\Users\Lenovo\Desktop\dev-africa-arena\resources\views/emails/candidature-confirmation.blade.php ENDPATH**/ ?>