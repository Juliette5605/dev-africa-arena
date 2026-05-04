<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumThread;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ArenaController extends Controller
{
    // ── DOMAINES DISPONIBLES ─────────────────────────────────────────────
    private array $domaines = [
        'web'           => 'Développement Web (HTML, CSS, JS, PHP, Laravel, React...)',
        'mobile'        => 'Développement Mobile (Flutter, React Native, Android, iOS...)',
        'ia'            => 'Intelligence Artificielle & Machine Learning',
        'data'          => 'Data Science & Big Data (Python, SQL, Hadoop, Spark...)',
        'cybersecurite' => 'Cybersécurité & Ethical Hacking',
        'devops'        => 'DevOps & Cloud (Docker, Kubernetes, AWS, CI/CD...)',
        'marketing'     => 'Marketing Digital & Growth Hacking',
        'communication' => 'Communication & Stratégie de marque Tech',
        'design'        => 'UI/UX Design & Design Thinking',
        'blockchain'    => 'Blockchain & Web3',
    ];

    private array $niveaux = [
        'debutant'      => 'Débutant — notions de base',
        'intermediaire' => 'Intermédiaire — pratique courante',
        'avance'        => 'Avancé — niveau hackathon professionnel',
    ];

    // ═════════════════════════════════════════════════════════════════════
    // QUIZ STANDARD (questions depuis la BDD)
    // ═════════════════════════════════════════════════════════════════════
    public function startQuiz(Request $request): View
    {
        $data = $request->validate([
            'domaine' => 'nullable|string|max:100',
            'niveau'  => 'nullable|string|max:100',
            'mode'    => 'nullable|in:standard,ia',
        ]);

        $domaine = $data['domaine'] ?? 'web';
        $niveau  = $data['niveau']  ?? 'intermediaire';
        $mode    = $data['mode']    ?? 'standard';

        // Si mode IA → on génère avec Gemini
        if ($mode === 'ia') {
            return $this->startAiQuiz($domaine, $niveau);
        }

        // Mode standard → BDD
        $questions = Question::query()
            ->when($domaine, fn($q) => $q->where('domaine', $domaine))
            ->when($niveau,  fn($q) => $q->where('niveau', $niveau))
            ->with(['options' => fn($q) => $q->inRandomOrder()])
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if ($questions->isEmpty()) {
            $questions = Question::with(['options' => fn($q) => $q->inRandomOrder()])
                ->inRandomOrder()->limit(10)->get();
        }

        return view('pages.quiz-play', [
            'questions'   => $questions,
            'domaine'     => $domaine,
            'niveau'      => $niveau,
            'mode'        => 'standard',
            'modeIa'      => false, // Correction : Ajout pour la vue
            'domaines'    => $this->domaines,
            'niveaux'     => $this->niveaux,
            'ai_fallback' => false,
        ]);
    }

    // ═════════════════════════════════════════════════════════════════════
    // QUIZ IA (questions générées par Gemini en temps réel)
    // ═════════════════════════════════════════════════════════════════════
    private function startAiQuiz(string $domaine, string $niveau): View
    {
        $domaineLabel = $this->domaines[$domaine] ?? $domaine;
        $niveauLabel  = $this->niveaux[$niveau]   ?? $niveau;

        $prompt = <<<PROMPT
Tu es un expert technique qui prépare un hackathon professionnel en Afrique.
Génère exactement 5 questions QCM de niveau "$niveauLabel" dans le domaine : "$domaineLabel".

Règles STRICTES :
- Les questions doivent être complexes (niveau "Question pour un champion" tech)
- Chaque question a exactement 4 options de réponse
- Une seule bonne réponse par question
- Réponds UNIQUEMENT en JSON valide.

Format :
{
  "questions": [
    {
      "enonce": "La question ?",
      "points": 15,
      "explication": "Explication de la réponse.",
      "options": [
        {"texte": "Option A", "correct": false},
        {"texte": "Option B", "correct": true},
        {"texte": "Option C", "correct": false},
        {"texte": "Option D", "correct": false}
      ]
    }
  ]
}
PROMPT;

        try {
            $apiKey = config('services.gemini.key');
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

            $response = Http::timeout(30)->post($url, [
                'contents' => [
                    ['parts' => [['text' => $prompt]]]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json',
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
                $data = json_decode(trim($text), true);

                if (!empty($data['questions'])) {
                    $questions = collect($data['questions'])->map(function ($q, $i) use ($domaine, $niveau) {
                        return (object)[
                            'id'          => 'ai_' . $i,
                            'enonce'      => $q['enonce'],
                            'points'      => $q['points'] ?? 15,
                            'explication' => $q['explication'],
                            'domaine'     => $domaine,
                            'niveau'      => $niveau,
                            'type'        => 'qcm',
                            'options'     => collect($q['options'])->map(fn($o, $j) => (object)[
                                'id'           => 'ai_opt_' . $j,
                                'texte'        => $o['texte'],
                                'est_correcte' => $o['correct'],
                            ]),
                        ];
                    });

                    return view('pages.quiz-play', [
                        'questions'   => $questions,
                        'domaine'     => $domaine,
                        'niveau'      => $niveau,
                        'mode'        => 'ia',
                        'modeIa'      => true, // Correction : Ajout pour la vue
                        'domaines'    => $this->domaines,
                        'niveaux'     => $this->niveaux,
                        'ai_fallback' => false,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Log de l'erreur possible ici : \Log::error($e->getMessage());
        }

        // Fallback : questions BDD si l'IA échoue
        $questions = Question::with(['options' => fn($q) => $q->inRandomOrder()])
            ->inRandomOrder()->limit(5)->get();

        return view('pages.quiz-play', [
            'questions'    => $questions,
            'domaine'      => $domaine,
            'niveau'       => $niveau,
            'mode'         => 'standard',
            'modeIa'       => false, // Correction : Toujours envoyer la variable
            'ai_fallback'  => true,
            'domaines'     => $this->domaines,
            'niveaux'      => $this->niveaux,
        ]);
    }

    // ═════════════════════════════════════════════════════════════════════
    // VÉRIFICATION RÉPONSE (compatible BDD + IA)
    // ═════════════════════════════════════════════════════════════════════
    public function checkAnswer(Request $request): JsonResponse
    {
        if ($request->filled('ai_mode')) {
            return response()->json([
                'success'     => true,
                'correct'     => (bool) $request->input('is_correct'),
                'explication' => $request->input('explication', ''),
                'points'      => $request->input('is_correct') ? $request->input('points', 15) : 0,
            ]);
        }

        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'option_id'   => 'required|exists:question_options,id',
        ]);

        $question = Question::with('options')->findOrFail($data['question_id']);
        $selected = QuestionOption::where('question_id', $question->id)
            ->findOrFail($data['option_id']);

        return response()->json([
            'success'     => true,
            'correct'     => (bool) $selected->est_correcte,
            'explication' => $question->explication,
            'points'      => $selected->est_correcte ? $question->points : 0,
        ]);
    }

    // ═════════════════════════════════════════════════════════════════════
    // FORUM
    // ═════════════════════════════════════════════════════════════════════
    public function forumIndex(): View
    {
        $threads = ForumThread::with(['user'])
            ->withCount('comments')
            ->orderByDesc('est_epingle')
            ->latest()
            ->paginate(12);

        return view('pages.forum-index', compact('threads'));
    }

    public function forumStore(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'titre'     => 'required|string|max:255',
            'message'   => 'required|string',
            'categorie' => 'nullable|string|max:100',
        ]);

        $thread = ForumThread::create([
            'titre'     => $data['titre'],
            'message'   => $data['message'],
            'categorie' => $data['categorie'] ?? 'General',
            'user_id'   => $request->user()->id,
        ]);

        return redirect()->route('forum.show', $thread)
            ->with('success', 'Discussion créée avec succès.');
    }

    public function forumShow(ForumThread $thread): View
    {
        $thread->load(['user', 'posts.user']);
        $thread->increment('vues');

        return view('pages.forum-show', compact('thread'));
    }

    public function forumReply(Request $request, ForumThread $thread): RedirectResponse
    {
        $data = $request->validate([
            'message' => 'required|string',
        ]);

        ForumPost::create([
            'forum_thread_id' => $thread->id,
            'user_id'         => $request->user()->id,
            'message'         => $data['message'],
        ]);

        return redirect()->route('forum.show', $thread)
            ->with('success', 'Réponse ajoutée au forum.');
    }
}