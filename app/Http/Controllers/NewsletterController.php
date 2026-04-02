<?php

namespace App\Http\Controllers;

use App\Mail\NewsletterWelcome;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:200',
            'nom'   => 'nullable|string|max:100',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.email'    => 'Format d\'email invalide.',
            'email.unique'   => 'Cet email est déjà inscrit.',
        ]);

        // Vérifier si déjà inscrit
        if (Newsletter::where('email', $request->email)->exists()) {
            return back()->with('newsletter_info', 'Vous êtes déjà abonné(e) à notre newsletter.');
        }

        $subscriber = Newsletter::create([
            'email'        => $request->email,
            'nom'          => $request->nom,
            'token'        => Str::random(40),
            'confirmed'    => true,
            'confirmed_at' => now(),
        ]);

        try {
            Mail::to($subscriber->email)->send(new NewsletterWelcome($subscriber));
        } catch (\Exception $e) {
            // Silencieux si mail non configuré
        }

        return back()->with('newsletter_success', ' Bienvenue dans l\'Arena ! Email de confirmation envoyé à ' . $subscriber->email);
    }
}
