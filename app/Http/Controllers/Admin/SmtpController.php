<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SmtpController extends Controller
{
    public function show()
    {
        $config = [
            'mailer'     => env('MAIL_MAILER', 'log'),
            'host'       => env('MAIL_HOST', ''),
            'port'       => env('MAIL_PORT', '587'),
            'username'   => env('MAIL_USERNAME', ''),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'from'       => env('MAIL_FROM_ADDRESS', ''),
            'from_name'  => env('MAIL_FROM_NAME', 'DevAfricaArena'),
        ];
        return view('admin.smtp', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mailer'     => 'required|in:smtp,log,mailtrap',
            'host'       => 'required_if:mailer,smtp|nullable|string',
            'port'       => 'required_if:mailer,smtp|nullable|integer',
            'username'   => 'required_if:mailer,smtp|nullable|string',
            'password'   => 'nullable|string',
            'encryption' => 'nullable|in:tls,ssl,',
            'from'       => 'required|email',
            'from_name'  => 'required|string|max:100',
        ]);

        // Mailtrap utilise smtp aussi
        $mailer = $request->mailer === 'mailtrap' ? 'smtp' : $request->mailer;

        $this->setEnvValue('MAIL_MAILER',       $mailer);
        $this->setEnvValue('MAIL_HOST',         $request->host ?? '');
        $this->setEnvValue('MAIL_PORT',         $request->port ?? '587');
        $this->setEnvValue('MAIL_USERNAME',     $request->username ?? '');
        $this->setEnvValue('MAIL_ENCRYPTION',   $request->encryption ?? 'tls');
        $this->setEnvValue('MAIL_FROM_ADDRESS', $request->from);
        $this->setEnvValue('MAIL_FROM_NAME',    '"'.$request->from_name.'"');

        if ($request->filled('password')) {
            $this->setEnvValue('MAIL_PASSWORD', $request->password);
        }

        // Recharger la config en mémoire immédiatement sans avoir à redémarrer
        $this->reloadMailConfig();

        ActivityLog::log('modifié', 'Configuration SMTP', $mailer.' — '.$request->from);
        return back()->with('success', 'Configuration email mise à jour. Testez l\'envoi ci-dessous.');
    }

    public function test(Request $request)
    {
        $request->validate(['test_email' => 'required|email']);

        // Recharger la config depuis le .env avant d'envoyer
        $this->reloadMailConfig();

        try {
            Mail::raw(
                "Test DevAfricaArena\n\nSi vous recevez ce message, votre configuration email est operationnelle.\n\nEnvoye depuis le panel admin de DevAfricaArena.",
                function ($m) use ($request) {
                    $m->to($request->test_email)
                      ->subject('Test Email - DevAfricaArena');
                }
            );
            ActivityLog::log('testé', 'Email SMTP', $request->test_email);
            return back()->with('success', 'Email de test envoyé à '.$request->test_email.' !');
        } catch (\Exception $e) {
            return back()->with('error', 'Echec d\'envoi : '.$e->getMessage().' — Vérifiez votre configuration SMTP et votre mot de passe d\'application Gmail.');
        }
    }

    /**
     * Recharge la config mail depuis le fichier .env
     * sans avoir à redémarrer le serveur
     */
    private function reloadMailConfig(): void
    {
        // Vider le cache de config
        \Illuminate\Support\Facades\Artisan::call('config:clear');

        // Relire les valeurs du .env
        $dotenv = \Dotenv\Dotenv::createMutable(base_path());
        $dotenv->safeLoad();

        // Reconfigurer le mailer en mémoire
        Config::set('mail.default', env('MAIL_MAILER', 'log'));
        Config::set('mail.mailers.smtp.host',       env('MAIL_HOST'));
        Config::set('mail.mailers.smtp.port',       env('MAIL_PORT'));
        Config::set('mail.mailers.smtp.username',   env('MAIL_USERNAME'));
        Config::set('mail.mailers.smtp.password',   env('MAIL_PASSWORD'));
        Config::set('mail.mailers.smtp.encryption', env('MAIL_ENCRYPTION'));
        Config::set('mail.from.address',            env('MAIL_FROM_ADDRESS'));
        Config::set('mail.from.name',               env('MAIL_FROM_NAME'));

        // Forcer Laravel à utiliser un nouveau transporteur
        app()->forgetInstance('mailer');
        app()->forgetInstance('swift.mailer');
        app()->forgetInstance('swift.transport');
    }

    private function setEnvValue(string $key, string $value): void
    {
        $path = base_path('.env');
        $env  = file_get_contents($path);

        // Valeurs avec espaces doivent être entre guillemets
        if (str_contains($value, ' ') && !str_starts_with($value, '"')) {
            $value = '"'.$value.'"';
        }

        if (preg_match('/^'.$key.'=/m', $env)) {
            $env = preg_replace('/^'.$key.'=.*/m', $key.'='.$value, $env);
        } else {
            $env .= "\n".$key.'='.$value;
        }

        file_put_contents($path, $env);
    }
}
