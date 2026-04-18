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
}