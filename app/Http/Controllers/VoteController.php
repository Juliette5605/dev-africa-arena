<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class VoteController extends Controller
{
    /**
     * Page publique du tableau des candidats (leaderboard)
     */
    public function leaderboard()
    {
        $candidats = Candidature::withCount(['votes as total_points' => function ($q) {
                $q->where('status', 'confirmed')->selectRaw('sum(points)');
            }])
            ->where('vote_link_active', true)
            ->orderByDesc('total_points')
            ->get();

        return view('pages.vote-leaderboard', compact('candidats'));
    }

    /**
     * Page profil d'un candidat (C'est cette méthode qui manquait !)
     */
    public function profil(string $slug)
    {
        $candidature = Candidature::where('slug', $slug)
            ->where('vote_link_active', true)
            ->firstOrFail();

        $totalPoints = Vote::where('candidature_id', $candidature->id)
            ->where('status', 'confirmed')
            ->sum('points');

        $totalVotants = Vote::where('candidature_id', $candidature->id)
            ->where('status', 'confirmed')
            ->count();

        $pricing = Vote::pricingTable();

        // Objet fictif pour la compatibilité Blade
        $voteLink = (object) [
            'slug'          => $candidature->slug,
            'is_active'     => $candidature->vote_link_active,
            'tiktok_url'    => $candidature->tiktok_url ?? null,
            'facebook_url'  => $candidature->facebook_url ?? null,
            'instagram_url' => $candidature->instagram_url ?? null,
        ];

        // Calcul du rang
        $rang = Candidature::whereHas('votes', fn($q) => $q->where('status', 'confirmed'))
            ->withCount(['votes as pts' => fn($q) => $q->where('status', 'confirmed')->selectRaw('sum(points)')])
            ->orderByDesc('pts')
            ->pluck('id')
            ->search($candidature->id);
            
        $rang = $rang !== false ? $rang + 1 : null;

        return view('vote.profil', compact(
            'candidature', 'voteLink', 'totalPoints', 'totalVotants', 'pricing', 'rang'
        ));
    }

    /**
     * Soumettre un vote (Redirection vers PayGate Togo)
     */
    public function store(Request $request, string $slug)
    {
        $candidature = Candidature::where('slug', $slug)
            ->where('vote_link_active', true)
            ->firstOrFail();

        $validated = $request->validate([
            'voter_name'     => 'required|string|max:100',
            'voter_email'    => 'nullable|email|max:150',
            'voter_phone'    => 'required|string|max:20',
            'voter_type'     => 'required|in:public,sponsor,jury',
            'amount'         => 'required|integer|in:100,200,500,1000,2000,5000,10000',
            'payment_method' => 'required|in:flooz,tmoney',
        ]);

        $points = Vote::pointsForAmount($validated['amount']);
        $voteToken = (string) Str::uuid();

        // On enregistre le vote en attente
        $vote = Vote::create([
            'candidature_id' => $candidature->id,
            'voter_name'     => $validated['voter_name'],
            'voter_email'    => $request->voter_email,
            'voter_phone'    => $validated['voter_phone'],
            'voter_type'     => $validated['voter_type'],
            'amount'         => $validated['amount'],
            'points'         => $points,
            'payment_method' => $validated['payment_method'],
            'status'         => 'pending',
            'ip_address'     => $request->ip(),
            'vote_token'     => $voteToken,
        ]);

        // Paramètres PayGate Global
        $paygateParams = [
            'token'       => env('PAYGATE_TOKEN'),
            'amount'      => $validated['amount'],
            'description' => "Vote DevAricaArena - " . $candidature->slug,
            'identifier'  => $voteToken,
            'url'         => route('vote.profil', $slug), // Retour après succès
        ];

        // Redirection vers PayGate
        $paymentUrl = env('PAYGATE_URL') . "?" . http_build_query($paygateParams);
        return redirect()->away($paymentUrl);
    }

    /**
     * Webhook de confirmation appelé par PayGate
     */
    public function confirmWebhook(Request $request)
    {
        $identifier = $request->input('identifier'); 
        $status = $request->input('status'); // 0 = Succès chez PayGate

        $vote = Vote::where('vote_token', $identifier)->where('status', 'pending')->first();

        if ($vote && $status == 0) {
            $vote->update([
                'status' => 'confirmed',
                'transaction_ref' => $request->input('txreference')
            ]);
            return response()->json(['result' => 'OK'], 200);
        }

        return response()->json(['result' => 'FAILED'], 400);
    }
}