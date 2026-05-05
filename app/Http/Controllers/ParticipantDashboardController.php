<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Services\IAService;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ParticipantDashboardController extends Controller
{
    public function __invoke(Request $request, IAService $iaService): View
    {
        $user = $request->user();
        $candidatures = $user->candidatures()->latest()->get();
        $candidature = $candidatures->first();
        $edition = Edition::where('active', true)->first();

        // Analyse IA automatique si non présente
        if ($candidature && (!$candidature->score_ia || !$candidature->analyse_ia)) {
            $resultatIA = $iaService->analyserCandidat(
                $candidature->motivation,
                $candidature->expertise
            );

            $candidature->update([
                'score_ia' => $resultatIA['score'] ?? null,
                'analyse_ia' => $resultatIA['analyse'] ?? null,
            ]);

            $candidature->refresh();
        }

        // Génération du lien de vote pour le dashboard candidat
        $voteUrl = null;
        if ($candidature && $candidature->vote_link_active) {
            // Construit l'URL vers la page publique du profil de vote
            $voteUrl = route('vote.profil', ['slug' => $candidature->slug]);
        }

        $steps = [
            [
                'title' => 'Dossier reçu',
                'description' => 'Votre candidature est bien enregistrée dans l\'Arena.',
                'done' => (bool) $candidature,
            ],
            [
                'title' => 'Dossier consulté',
                'description' => 'L\'équipe a ouvert et pris connaissance de votre dossier.',
                'done' => (bool) optional($candidature)->read_at,
            ],
            [
                'title' => 'Pré-sélection',
                'description' => 'Votre profil a été retenu pour l\'étape suivante.',
                'done' => optional($candidature)->statut === 'retenu' || (bool) optional($candidature)->finaliste,
            ],
            [
                'title' => 'Finaliste',
                'description' => 'Vous faites partie des finalistes de la sélection.',
                'done' => (bool) optional($candidature)->finaliste,
            ],
        ];

        return view('participant.dashboard', compact('user', 'candidature', 'candidatures', 'edition', 'steps', 'voteUrl'));
    }

    public function generateCv(Request $request, IAService $iaService): JsonResponse
    {
        $candidature = $request->user()->latestCandidature;

        if (!$candidature) {
            return response()->json([
                'success' => false,
                'error' => 'Aucune candidature n’est associee a ce compte.',
            ], 422);
        }

        return response()->json($iaService->generateCv($candidature));
    }

    public function generateCoverLetter(Request $request, IAService $iaService): JsonResponse
    {
        $request->validate([
            'poste' => 'required|string|max:200',
            'entreprise' => 'nullable|string|max:200',
        ]);

        $candidature = $request->user()->latestCandidature;

        if (!$candidature) {
            return response()->json([
                'success' => false,
                'error' => 'Aucune candidature n’est associee a ce compte.',
            ], 422);
        }

        return response()->json(
            $iaService->generateCoverLetter($candidature, $request->poste, $request->entreprise)
        );
    }

    public function matchOpportunities(Request $request, IAService $iaService): JsonResponse
    {
        $candidature = $request->user()->latestCandidature;

        if (!$candidature) {
            return response()->json([
                'success' => false,
                'error' => 'Aucune candidature n’est associee a ce compte.',
            ], 422);
        }

        return response()->json($iaService->matchOpportunities($candidature));
    }
}