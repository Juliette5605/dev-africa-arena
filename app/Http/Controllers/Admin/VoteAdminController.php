<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Vote;
use App\Models\VoteLink;
use Illuminate\Http\Request;

class VoteAdminController extends Controller
{
    /**
     * Dashboard votes — stats + liste candidats
     */
    public function index()
    {
        $stats = [
            'total_votes'   => Vote::where('status', 'confirmed')->count(),
            'total_points'  => Vote::where('status', 'confirmed')->sum('points'),
            'total_montant' => Vote::where('status', 'confirmed')->sum('amount'),
            'votes_public'  => Vote::where('status', 'confirmed')->where('voter_type', 'public')->count(),
            'votes_sponsor' => Vote::where('status', 'confirmed')->where('voter_type', 'sponsor')->count(),
            'votes_jury'    => Vote::where('status', 'confirmed')->where('voter_type', 'jury')->count(),
        ];

        $classement = Candidature::withCount([
                'votes as total_points' => fn($q) => $q->where('status', 'confirmed')->selectRaw('sum(points)'),
                'votes as total_votes'  => fn($q) => $q->where('status', 'confirmed'),
            ])
            ->with('voteLink')
            ->orderByDesc('total_points')
            ->get();

        $recentVotes = Vote::with('candidature')
            ->where('status', 'confirmed')
            ->latest()
            ->take(20)
            ->get();

        return view('admin.votes.index', compact('stats', 'classement', 'recentVotes'));
    }

    /**
     * Générer/mettre à jour le lien de vote d'un candidat
     */
    public function generateLink(Request $request, int $candidatureId)
    {
        $candidature = Candidature::findOrFail($candidatureId);

        $validated = $request->validate([
            'tiktok_url' => 'nullable|url',
        ]);

        $existing = VoteLink::where('candidature_id', $candidatureId)->first();

        if ($existing) {
            $existing->update(['tiktok_url' => $validated['tiktok_url'] ?? null]);
            $link = $existing;
        } else {
            $slug = VoteLink::generateSlug($candidature->nom ?? 'candidat', $candidature->prenom ?? '');
            $link = VoteLink::create([
                'candidature_id' => $candidatureId,
                'slug'           => $slug,
                'tiktok_url'     => $validated['tiktok_url'] ?? null,
                'is_active'      => true,
            ]);
        }

        return back()->with('success', 'Lien de vote généré : ' . $link->getPublicUrl());
    }

    /**
     * Activer / désactiver les votes d'un candidat
     */
    public function toggleLink(int $candidatureId)
    {
        $link = VoteLink::where('candidature_id', $candidatureId)->firstOrFail();
        $link->update(['is_active' => !$link->is_active]);
        return back()->with('success', 'Lien ' . ($link->is_active ? 'activé' : 'désactivé'));
    }

    /**
     * Exporter les votes en CSV
     */
    public function exportCsv()
    {
        $votes = Vote::with('candidature')->where('status', 'confirmed')->get();

        $csv = "Candidat,Votant,Type,Montant FCFA,Points,Méthode,Référence,Date\n";
        foreach ($votes as $v) {
            $nom = $v->candidature->nom ?? 'N/A';
            $csv .= "\"{$nom}\",\"{$v->voter_name}\",{$v->voter_type},{$v->amount},{$v->points},{$v->payment_method},{$v->transaction_ref},{$v->created_at}\n";
        }

        return response($csv, 200, [
            'Content-Type'        => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="votes_' . now()->format('Y-m-d') . '.csv"',
        ]);
    }
}
