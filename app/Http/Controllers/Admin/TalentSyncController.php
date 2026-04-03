<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TalentSyncController extends Controller
{
    private const API = 'https://web-production-f3fa9.up.railway.app';

    // ── Page principale IA dans l'admin ──────────────────────────
    public function index()
    {
        $candidatures = Candidature::latest()->get();
        return view('admin.talentsync.index', compact('candidatures'));
    }

    // ── Générer CV ────────────────────────────────────────────────
    public function generateCV(Request $request)
    {
        $request->validate([
            'candidature_id' => 'required|exists:candidatures,id',
        ]);

        $c = Candidature::findOrFail($request->candidature_id);

        $payload = [
            'profil' => [
                'nom'                    => $c->nom,
                'prenom'                 => $c->prenom,
                'email'                  => $c->email,
                'telephone'              => '',
                'localisation'           => $c->pays ?? 'Lomé, Togo',
                'competences'            => [$c->expertise],
                'langages'               => [],
                'experiences'            => [],
                'formations'             => [['diplome' => $c->diplome, 'etablissement' => '', 'annee' => '']],
                'objectif_professionnel' => $c->motivation,
            ]
        ];

        try {
            $response = Http::timeout(30)->post(self::API . '/generate-cv', $payload);
            if ($response->successful()) {
                ActivityLog::log('généré CV IA', 'TalentSync', $c->prenom.' '.$c->nom);
                return response()->json(['success' => true, 'cv' => $response->json()]);
            }
            return response()->json(['success' => false, 'error' => 'Erreur API : '.$response->status()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
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

        $payload = [
            'profil' => [
                'nom'    => $c->nom,
                'prenom' => $c->prenom,
                'email'  => $c->email,
                'competences' => [$c->expertise],
                'objectif_professionnel' => $c->motivation,
            ],
            'poste'      => $request->poste,
            'entreprise' => $request->entreprise ?? 'DevAfrica Arena',
            'motivation' => $c->motivation,
        ];

        try {
            $response = Http::timeout(30)->post(self::API . '/generate-cover-letter', $payload);
            if ($response->successful()) {
                ActivityLog::log('généré lettre IA', 'TalentSync', $c->prenom.' '.$c->nom);
                return response()->json(['success' => true, 'lettre' => $response->json()]);
            }
            return response()->json(['success' => false, 'error' => 'Erreur API : '.$response->status()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // ── Matching d'opportunités ───────────────────────────────────
    public function matchOpportunities(Request $request)
    {
        $request->validate([
            'candidature_id' => 'required|exists:candidatures,id',
        ]);

        $c = Candidature::findOrFail($request->candidature_id);

        $payload = [
            'profil' => [
                'nom'         => $c->nom,
                'prenom'      => $c->prenom,
                'email'       => $c->email,
                'competences' => [$c->expertise],
                'niveau'      => $c->niveau,
                'localisation' => $c->pays ?? 'Lomé, Togo',
            ]
        ];

        try {
            $response = Http::timeout(30)->post(self::API . '/match-opportunities', $payload);
            if ($response->successful()) {
                ActivityLog::log('matching IA', 'TalentSync', $c->prenom.' '.$c->nom);
                return response()->json(['success' => true, 'matches' => $response->json()]);
            }
            return response()->json(['success' => false, 'error' => 'Erreur API : '.$response->status()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
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

        $payload = [
            'profil' => [
                'nom'         => $c->nom,
                'prenom'      => $c->prenom,
                'email'       => $c->email,
                'competences' => [$c->expertise],
            ],
            'offre' => [
                'titre' => $request->offre_titre,
                'url'   => $request->offre_url,
            ]
        ];

        try {
            $response = Http::timeout(60)->post(self::API . '/auto-apply', $payload);
            if ($response->successful()) {
                ActivityLog::log('candidature auto IA', 'TalentSync', $c->prenom.' '.$c->nom.' → '.$request->offre_titre);
                return response()->json(['success' => true, 'result' => $response->json()]);
            }
            return response()->json(['success' => false, 'error' => 'Erreur API : '.$response->status()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // ── Statut candidature ────────────────────────────────────────
    public function applicationStatus(Request $request)
    {
        try {
            $response = Http::timeout(15)->get(self::API . '/application-status');
            return response()->json(['success' => true, 'applications' => $response->json()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // ── Chatbot public (page d'accueil) ───────────────────────────
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string|max:500']);

        $msg = strtolower($request->message);

        // Réponses contextuelles intelligentes sur DevAfrica Arena
        $reponses = [
            ['mots' => ['candidat','postuler','inscription','participer'],
             'rep'  => "Pour candidater à DevAfrica Arena, rendez-vous sur la page Critères. Vous devez avoir des compétences en développement web, mobile, IA ou cybersécurité. La sélection se fait en 2 phases : un Grand Quiz puis un Code Challenge."],
            ['mots' => ['cv','curriculum','vitae','générer'],
             'rep'  => "Notre IA TalentSync peut générer votre CV automatiquement ! Postulez d'abord à l'Arena via la page Critères, puis notre équipe utilisera l'IA pour optimiser votre dossier."],
            ['mots' => ['lettre','motivation','cover'],
             'rep'  => "TalentSync génère des lettres de motivation personnalisées pour chaque candidat. Après votre candidature, notre équipe IA prépare votre dossier complet."],
            ['mots' => ['prize','prix','récompense','gagner','cash'],
             'rep'  => "Le Cash Prize de DevAfrica Arena est de 350 000 FCFA remis directement au gagnant lors de la Grande Finale. 6 finalistes s'affrontent en live coding sur écran géant !"],
            ['mots' => ['date','quand','juin','2026'],
             'rep'  => "La prochaine édition de DevAfrica Arena se tient en Juin 2026 à Lomé, Togo. Inscrivez-vous dès maintenant sur la page Critères !"],
            ['mots' => ['partenaire','sponsor','financer','investir'],
             'rep'  => "Vous souhaitez devenir partenaire ? Consultez notre page Partenaires pour découvrir les packs Silver (100K), Gold (150K) et Diamond (250K FCFA). Contactez-nous via la page Contact."],
            ['mots' => ['niveau','junior','senior','intermédiaire','expérience'],
             'rep'  => "DevAfrica Arena est ouvert à tous les niveaux : Junior, Intermédiaire et Senior. La sélection est basée sur vos compétences techniques réelles, pas sur votre diplôme."],
            ['mots' => ['ia','intelligence artificielle','talentsync','ai'],
             'rep'  => "TalentSync est notre microservice IA intégré à DevAfrica Arena. Il génère des CV, des lettres de motivation, fait du matching d'opportunités et peut même postuler automatiquement pour vous !"],
            ['mots' => ['lomé','togo','lieu','où','location'],
             'rep'  => "DevAfrica Arena se déroule à Lomé, Togo — au cœur de l'écosystème tech d'Afrique de l'Ouest. L'événement est ouvert aux développeurs de toute l'Afrique."],
        ];

        foreach ($reponses as $r) {
            foreach ($r['mots'] as $mot) {
                if (str_contains($msg, $mot)) {
                    return response()->json(['success' => true, 'reply' => $r['rep']]);
                }
            }
        }

        // Fallback — appel à l'API TalentSync si disponible
        try {
            $response = Http::timeout(10)->get(self::API . '/health');
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'reply'   => "Je suis l'assistant IA de DevAfrica Arena. Je peux vous aider à comprendre l'événement, les critères de participation, les partenariats ou la génération de CV. Que souhaitez-vous savoir ?"
                ]);
            }
        } catch (\Exception $e) {}

        return response()->json([
            'success' => true,
            'reply'   => "Bonjour ! Je suis l'assistant IA de DevAfrica Arena. Posez-moi une question sur l'événement, les candidatures, les partenariats ou notre technologie TalentSync !"
        ]);
    }
}
