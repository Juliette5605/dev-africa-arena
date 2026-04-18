<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Obligatoire pour appeler l'IA

class OrientationController extends Controller
{
    /**
     * Affiche la page d'orientation.
     */
    public function index()
    {
        return view('orientation.index');
    }

    /**
     * Interroge l'IA pour obtenir une recommandation d'orientation.
     */
    public function interrogerIA(Request $request)
    {
        // 1. Validation de la question
        $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $userQuestion = $request->input('question');

        // 2. Récupération des secrets depuis config/services.php
        $url = config('services.ia.url');
        $key = config('services.ia.key');
        $model = config('services.ia.model');

        try {
            // 3. Appel API (On envoie la question à l'IA)
            $response = Http::withToken($key)
                ->timeout(30)
                ->post($url, [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system', 
                            'content' => 'Tu es un conseiller expert en orientation numérique pour DevAfricaArena. Tu aides les jeunes de 25 ans à Lomé à se réorienter vers la tech.'
                        ],
                        ['role' => 'user', 'content' => $userQuestion],
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $reponseIA = $data['choices'][0]['message']['content'];
            } else {
                $reponseIA = "Désolé, l'IA est indisponible pour le moment. Vérifie ta clé API dans le fichier .env.";
            }

        } catch (\Exception $e) {
            $reponseIA = "Erreur de connexion : " . $e->getMessage();
        }

        // 4. On retourne à la vue avec la réponse de l'IA
        return view('orientation.index', [
            'resultat' => $reponseIA,
            'maQuestion' => $userQuestion
        ]);
    }
}