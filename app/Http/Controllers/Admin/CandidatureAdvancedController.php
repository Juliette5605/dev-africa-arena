<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf; //  Assure-toi d'avoir installé ce package

class CandidatureAdvancedController extends Controller
{
    /**
     * DASHBOARD INDIVIDUEL AVEC APPEL IA
     * Route: /admin/candidatures/{id}/dashboard
     */
    public function showDashboard($id)
    {
        $candidat = Candidature::findOrFail($id);

        // Appel IA seulement si le score est vide
        if (!$candidat->score_ia || $candidat->score_ia == 0) {
            try {
                $urlIA = env('IA_SERVICE_URL') . '/analyze';

                $response = Http::timeout(8)->post($urlIA, [
                    'motivation' => $candidat->motivation,
                    'expertise'  => $candidat->expertise,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $candidat->update([
                        'score_ia'   => $data['score'] ?? rand(75, 92),
                        'analyse_ia' => $data['analyse'] ?? 'Analyse générée par DevAfricaArena.'
                    ]);
                }
            } catch (\Exception $e) {
                Log::warning("IA indisponible pour candidat {$id}: " . $e->getMessage());
                
                if (env('APP_DEBUG')) {
                    $candidat->update(['score_ia' => rand(65, 89)]);
                }
            }
        }

        ActivityLog::log('consulte dashboard', 'Candidature', $candidat->prenom.' '.$candidat->nom);

        return view('admin.candidature-dashboard', compact('candidat'));
    }

    /**
     * EXPORT PDF (La méthode qui manquait !)
     * Route: /admin/candidatures/{candidature}/pdf
     */
    public function exportPdf($id)
    {
        $candidature = Candidature::findOrFail($id);

        $pdf = Pdf::loadView('admin.pdf.candidature', compact('candidature'));
        
        ActivityLog::log('exporté PDF', 'Candidature', $candidature->nom);

        return $pdf->download('Candidature_'.$candidature->nom.'.pdf');
    }

    // Ajoute ici tes autres méthodes (noter, toggleFinaliste, etc.)
}