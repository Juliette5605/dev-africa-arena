<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    // Formulaire demande de reset
    public function showRequest()
    {
        return view('admin.password.request');
    }

    // Envoyer le lien (ici on affiche le token directement — à remplacer par email SMTP quand configuré)
    public function sendReset(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:admins,email'], [
            'email.exists' => 'Aucun compte admin avec cet email.'
        ]);

        $admin = Admin::where('email', $request->email)->first();
        $token = Str::random(64);

        $admin->update([
            'reset_token'            => Hash::make($token),
            'reset_token_expires_at' => now()->addMinutes(30),
        ]);

        // Lien de reset
        $link = route('admin.password.reset.form', ['token' => $token, 'email' => $admin->email]);

        // TODO: envoyer par email quand SMTP configuré
        // Mail::to($admin->email)->send(new AdminPasswordReset($link));

        return back()->with('reset_link', $link)
                     ->with('success', 'Lien de réinitialisation généré. Copiez-le ci-dessous (valable 30 min).');
    }

    // Formulaire nouveau mot de passe
    public function showResetForm(Request $request)
    {
        return view('admin.password.reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    // Appliquer le nouveau mot de passe
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email|exists:admins,email',
            'token'                 => 'required|string',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        // Vérifier token + expiration
        if (!$admin->reset_token
            || !Hash::check($request->token, $admin->reset_token)
            || now()->isAfter($admin->reset_token_expires_at)
        ) {
            return back()->withErrors(['token' => 'Lien invalide ou expiré. Recommencez.']);
        }

        $admin->update([
            'password'               => Hash::make($request->password),
            'reset_token'            => null,
            'reset_token_expires_at' => null,
        ]);

        return redirect()->route('admin.login')
                         ->with('success', '✅ Mot de passe réinitialisé. Connectez-vous.');
    }
}
