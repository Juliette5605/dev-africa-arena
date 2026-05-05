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
        $validated = $request->validate([
            'question' => 'required|string|max:500',
        ]);

        $userQuestion = trim($validated['question']);
        $url = config('services.ia.url');
        $key = config('services.ia.key');
        $model = config('services.ia.model');

        if (blank($url) || blank($key) || blank($model)) {
            return view('orientation.index', [
                'resultat' => "L'assistant d'orientation n'est pas encore configuré. Vérifiez les variables IA dans le fichier .env.",
                'maQuestion' => $userQuestion,
            ]);
        }

        try {
            $response = Http::withToken($key)
                ->acceptJson()
                ->timeout(30)
                ->post($url, [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "Tu es un conseiller expert en orientation numérique pour DevAfricaArena. Réponds en français, de manière claire, concrète et bienveillante. Oriente l'utilisateur vers une ou deux filières maximum parmi: développement web/mobile, IA et data, design produit/UX, cybersécurité, marketing digital, fabrication numérique/IoT. Termine par 2 ou 3 prochaines étapes concrètes.",
                        ],
                        [
                            'role' => 'user',
                            'content' => $userQuestion,
                        ],
                    ],
                ]);

            if ($response->successful()) {
                $reponseIA = data_get(
                    $response->json(),
                    'choices.0.message.content',
                    "L'assistant n'a pas pu générer de recommandation exploitable pour le moment."
                );
            } else {
                $reponseIA = "L'assistant d'orientation est momentanément indisponible. Vérifiez la clé API et la configuration du service IA.";
            }
        } catch (\Throwable $e) {
            $reponseIA = "Erreur de connexion au service d'orientation: " . $e->getMessage();
        }

        return view('orientation.index', [
            'resultat' => $reponseIA,
            'maQuestion' => $userQuestion,
        ]);
    }
}
