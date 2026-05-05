<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CandidatAuthController extends Controller
{
    /**
     * Page connexion
     */
    public function showLogin()
    {
        // Si déjà connecté → espace candidat
        if (Auth::check()) {
            return redirect()->route('candidat.dashboard');
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('candidat.dashboard'));
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.'])->withInput();
    }

    /**
     * Page inscription
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('candidat.dashboard');
        }
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'prenom'    => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'profil'    => 'required|in:candidat,sponsor,visiteur',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'      => $validated['prenom'] . ' ' . $validated['name'],
            'email'     => $validated['email'],
            'telephone' => $validated['telephone'],
            'profil'    => $validated['profil'],
            'password'  => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('candidat.dashboard')
            ->with('success', 'Bienvenue ' . $validated['prenom'] . ' ! Votre compte est créé.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
