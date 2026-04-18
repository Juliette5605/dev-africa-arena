<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Candidature;

class IAService
{
    protected $baseUrl;

    public function __construct()
    {
        // Utilise l'URL de votre .env
        $this->baseUrl = env('IA_SERVICE_URL', 'https://web-production-f3fa9.up.railway.app');
    }

    /**
     * Génère un CV via le microservice
     * Route: POST /generate-cv
     */
    public function genererCV(Candidature $candidat)
    {
        try {
            $response = Http::timeout(15)->post($this->baseUrl . '/generate-cv', [
                'profil' => [
                    'nom' => $candidat->nom,
                    'prenom' => $candidat->prenom,
                    'email' => $candidat->email,
                    'telephone' => $candidat->telephone ?? 'Non renseigné',
                    'localisation' => $candidat->pays ?? 'Lomé, Togo',
                    'competences' => explode(',', $candidat->expertise), // Transforme texte en tableau
                    'langages' => [],
                    'experiences' => [],
                    'formations' => [$candidat->diplome],
                    'objectif_professionnel' => $candidat->motivation
                ]
            ]);

            return $response->successful() ? $response->json() : "Erreur de génération CV";
        } catch (\Exception $e) {
            Log::error("IA CV Error: " . $e->getMessage());
            return "Service indisponible.";
        }
    }

    /**
     * Génère une lettre de motivation
     * Route: POST /generate-cover-letter
     */
    public function genererLettre(Candidature $candidat, $offreTitre = "Développeur Fullstack")
    {
        try {
            $response = Http::timeout(15)->post($this->baseUrl . '/generate-cover-letter', [
                'profil' => [
                    'nom' => $candidat->nom,
                    'prenom' => $candidat->prenom,
                    'competences' => explode(',', $candidat->expertise),
                    'objectif_professionnel' => $candidat->motivation
                ],
                'offre' => [
                    'titre' => $offreTitre,
                    'entreprise' => 'DevAfrica Arena',
                    'description' => 'Recherche un talent passionné par l\'innovation.'
                ]
            ]);

            return $response->successful() ? $response->json() : "Erreur lettre de motivation";
        } catch (\Exception $e) {
            Log::error("IA Letter Error: " . $e->getMessage());
            return "Erreur de connexion à l'IA.";
        }
    }

    /**
     * Analyse un candidat et retourne un score + analyse
     * Route: POST /analyse-candidat (ou fallback local)
     */
    public function analyserCandidat($motivation, $expertise)
    {
        try {
            // Tentative d'appel au microservice IA
            $response = Http::timeout(15)->post($this->baseUrl . '/analyse-candidat', [
                'motivation' => $motivation,
                'expertise' => $expertise
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::warning("IA Analyse Error: " . $e->getMessage());
        }

        // Fallback: analyse locale basée sur les règles simples
        $score = $this->calculerScoreLocal($motivation, $expertise);
        $analyse = $this->genererAnalyseLocal($motivation, $expertise, $score);

        return [
            'score' => $score,
            'analyse' => $analyse
        ];
    }

    /**
     * Calcule un score local de 1 à 5 basé sur la longueur et contenu
     */
    private function calculerScoreLocal($motivation, $expertise)
    {
        $score = 2; // Score de base

        // Augmente si motivation suffisamment longue (qualité supposée)
        if (strlen($motivation) > 100) $score++;
        if (strlen($motivation) > 300) $score++;

        // Augmente si expertise spécifique mentionnée
        if (!empty($expertise) && strlen($expertise) > 5) $score++;

        // Cap à 5
        return min(5, max(1, $score));
    }

    /**
     * Génère une analyse textuelle locale
     */
    private function genererAnalyseLocal($motivation, $expertise, $score)
    {
        $analyses = [
            1 => "Profil à développer. Recommandation : clarifier les objectifs professionnels.",
            2 => "Profil élémentaire. Les compétences sont présentes mais peu détaillées.",
            3 => "Profil satisfaisant. Bonnes bases avec un potentiel intéressant.",
            4 => "Très bon profil. Candidat montre forte motivation et compétences claires.",
            5 => "Profil excellent. Candidat très motivé avec expertise bien définie."
        ];

        return $analyses[$score] ?? "Analyse non disponible.";
    }
}