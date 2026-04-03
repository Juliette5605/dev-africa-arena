<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Edition;
use App\Models\Newsletter;
use App\Models\Partenaire;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    private function response($data, int $status = 200): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'version'   => 'v1',
            'timestamp' => now()->toIso8601String(),
            'data'      => $data,
        ], $status)->header('Access-Control-Allow-Origin', '*');
    }

    // GET /api/v1/info
    public function info(): JsonResponse
    {
        return $this->response([
            'name'        => 'DevAfrica Arena',
            'description' => 'Le premier championnat technologique bimestriel à Lomé, Togo.',
            'location'    => 'Lomé, Togo',
            'contact'     => 'wilsoncodemosaic@gmail.com',
            'phone'       => '+228 71 15 50 55',
            'website'     => url('/'),
        ]);
    }

    // GET /api/v1/edition
    public function edition(): JsonResponse
    {
        $edition = Edition::where('active', true)->first();

        if (!$edition) {
            return response()->json(['success' => false, 'message' => 'Aucune édition active.'], 404);
        }

        return $this->response([
            'id'             => $edition->id,
            'nom'            => $edition->nom,
            'lieu'           => $edition->lieu,
            'date_selection' => $edition->date_selection?->toDateString(),
            'date_finale'    => $edition->date_finale?->toDateString(),
            'jours_restants' => max(0, now()->diffInDays($edition->date_finale, false)),
        ]);
    }

    // GET /api/v1/stats
    public function stats(): JsonResponse
    {
        return $this->response([
            'candidatures' => Candidature::count(),
            'partenaires'  => Partenaire::count(),
            'abonnes'      => Newsletter::count(),
            'repartition'  => [
                'junior'        => Candidature::where('niveau', 'Junior')->count(),
                'intermediaire' => Candidature::where('niveau', 'Intermédiaire')->count(),
                'senior'        => Candidature::where('niveau', 'Senior')->count(),
            ],
        ]);
    }

    // GET /api/v1/partenaires
    public function partenaires(): JsonResponse
    {
        $data = Partenaire::select('id','responsable','entreprise','type','created_at')
                          ->latest()->get();
        return $this->response($data);
    }

    // GET /api/v1/partenaires/{type}
    public function partenairesParType(string $type): JsonResponse
    {
        $allowed = ['financier', 'technique', 'sponsor'];
        if (!in_array($type, $allowed)) {
            return response()->json([
                'success' => false,
                'message' => 'Type invalide. Valeurs acceptées : '.implode(', ', $allowed),
            ], 400);
        }

        $data = Partenaire::where('type', $type)
                          ->select('id','responsable','entreprise','created_at')
                          ->latest()->get();
        return $this->response($data);
    }
}
