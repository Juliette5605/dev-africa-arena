<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Candidature;
use App\Services\IAService;
use Illuminate\Http\Request;

class DevAfricaArenaController extends Controller
{
    public function __construct(private readonly IAService $iaService)
    {
    }

    // ── Page principale IA dans l'admin ──────────────────────────
    public function index()
    {
        $candidatures = Candidature::latest()->get();
        return view('admin.devafricaarena.index', compact('candidatures'));
    }

    // ── Générer CV ────────────────────────────────────────────────
    public function generateCV(Request $request)
    {
        $request->validate([
            'candidature_id' => 'required|exists:candidatures,id',
        ]);

        $c = Candidature::findOrFail($request->candidature_id);
        $result = $this->iaService->generateCv($c);

        if ($result['success']) {
            ActivityLog::log('généré CV IA', 'DevAfricaArena', $c->prenom . ' ' . $c->nom);
        }

        return response()->json([
            'success' => $result['success'],
            'cv' => $result['content'] ?? null,
            'source' => $result['source'] ?? null,
            'warning' => $result['warning'] ?? null,
            'error' => $result['error'] ?? null,
        ]);
    }

    // ── Générer lettre de motivation ──────────────────────────────
    public function generateCoverLetter(Request $request)
    {
        $request->validate([
            'candidature_id' => 'required|exists:candidatures,id',
            'poste'          => 'required|string|max:200',
            'entreprise'     => 'nullable|string|max:200',
        ]);

        $c = Candidature::findOrFail($request->candidature_id);
        $result = $this->iaService->generateCoverLetter($c, $request->poste, $request->entreprise);

        if ($result['success']) {
            ActivityLog::log('généré lettre IA', 'DevAfricaArena', $c->prenom . ' ' . $c->nom);
        }

        return response()->json([
            'success' => $result['success'],
            'lettre' => $result['content'] ?? null,
            'source' => $result['source'] ?? null,
            'warning' => $result['warning'] ?? null,
            'error' => $result['error'] ?? null,
        ]);
    }

    // ── Matching d'opportunités ───────────────────────────────────
    public function matchOpportunities(Request $request)
    {
        $request->validate([
            'candidature_id' => 'required|exists:candidatures,id',
        ]);

        $c = Candidature::findOrFail($request->candidature_id);
        $result = $this->iaService->matchOpportunities($c);

        if ($result['success']) {
            ActivityLog::log('matching IA', 'DevAfricaArena', $c->prenom . ' ' . $c->nom);
        }

        return response()->json([
            'success' => $result['success'],
            'matches' => $result['matches'] ?? [],
            'source' => $result['source'] ?? null,
            'warning' => $result['warning'] ?? null,
            'error' => $result['error'] ?? null,
        ]);
    }

    // ── Candidature automatique ───────────────────────────────────
    public function autoApply(Request $request)
    {
        $request->validate([
            'candidature_id' => 'required|exists:candidatures,id',
            'offre_titre'    => 'required|string',
            'offre_url'      => 'required|url',
        ]);

        $c = Candidature::findOrFail($request->candidature_id);
        $result = $this->iaService->autoApply($c, $request->offre_titre, $request->offre_url);

        if ($result['success']) {
            ActivityLog::log('candidature auto IA', 'DevAfricaArena', $c->prenom . ' ' . $c->nom . ' → ' . $request->offre_titre);
        }

        return response()->json([
            'success' => $result['success'],
            'result' => $result['result'] ?? null,
            'source' => $result['source'] ?? null,
            'error' => $result['error'] ?? null,
        ]);
    }

    // ── Statut candidature ────────────────────────────────────────
    public function applicationStatus(Request $request)
    {
        return response()->json($this->iaService->health());
    }

    // ── Chatbot public (page d'accueil) ───────────────────────────
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $msg = strtolower($request->message);

        // Réponses contextuelles intelligentes sur DevAfricaArena
        $reponses = [
            ['mots' => ['candidat','postuler','inscription','participer'],
             'rep'  => "Pour candidater à DevAfricaArena, rendez-vous sur la page Critères. Vous devez avoir des compétences en développement web, mobile, IA ou cybersécurité. La sélection se fait en 2 phases : un Grand Quiz puis un Code Challenge."],
            ['mots' => ['cv','curriculum','vitae','générer'],
             'rep'  => "Notre IA DevAfricaArena peut générer votre CV automatiquement ! Postulez d'abord à l'Arena via la page Critères, puis notre équipe utilisera l'IA pour optimiser votre dossier."],
            ['mots' => ['lettre','motivation','cover'],
             'rep'  => "DevAfricaArena génère des lettres de motivation personnalisées pour chaque candidat. Après votre candidature, notre équipe IA prépare votre dossier complet."],
            ['mots' => ['prize','prix','récompense','gagner','cash'],
             'rep'  => "Le Cash Prize de DevAfricaArena est de 350 000 FCFA remis directement au gagnant lors de la Grande Finale. 6 finalistes s'affrontent en live coding sur écran géant !"],
            ['mots' => ['date','quand','juin','2026'],
             'rep'  => "La prochaine édition de DevAfricaArena se tient en Juin 2026 à Lomé, Togo. Inscrivez-vous dès maintenant sur la page Critères !"],
            ['mots' => ['partenaire','sponsor','financer','investir'],
             'rep'  => "Vous souhaitez devenir partenaire ? Consultez notre page Partenaires pour découvrir les packs Silver (100K), Gold (150K) et Diamond (250K FCFA). Contactez-nous via la page Contact."],
            ['mots' => ['niveau','junior','senior','intermédiaire','expérience'],
             'rep'  => "DevAfricaArena est ouvert à tous les niveaux : Junior, Intermédiaire et Senior. La sélection est basée sur vos compétences techniques réelles, pas sur votre diplôme."],
            ['mots' => ['ia','intelligence artificielle','devafricaarena','ai'],
             'rep'  => "DevAfricaArena est notre technologie IA integree a DevAfricaArena. Elle genere des CV, des lettres de motivation, fait du matching d'opportunites et peut meme postuler automatiquement pour vous !"],
            ['mots' => ['lomé','togo','lieu','où','location'],
             'rep'  => "DevAfricaArena se déroule à Lomé, Togo — au cœur de l'écosystème tech d'Afrique de l'Ouest. L'événement est ouvert aux développeurs de toute l'Afrique."],
        ];

        foreach ($reponses as $r) {
            foreach ($r['mots'] as $mot) {
                if (str_contains($msg, $mot)) {
                    return response()->json(['success' => true, 'reply' => $r['rep']]);
                }
            }
        }

        // Fallback — appel à l'API DevAfricaArena si disponible
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(10)->get(rtrim((string) env('IA_SERVICE_URL', 'https://web-production-f3fa9.up.railway.app'), '/') . '/health');
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'reply'   => "Je suis l'assistant IA de DevAfricaArena. Je peux vous aider à comprendre l'événement, les critères de participation, les partenariats ou la génération de CV. Que souhaitez-vous savoir ?"
                ]);
            }
        } catch (\Exception $e) {}

        return response()->json([
            'success' => true,
            'reply'   => "Bonjour ! Je suis l'assistant IA de DevAfricaArena. Posez-moi une question sur l'événement, les candidatures, les partenariats ou notre technologie DevAfricaArena !"
        ]);
    }
}
