<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumThread;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArenaController extends Controller
{
    public function startQuiz(Request $request): View
    {
        $data = $request->validate([
            'domaine' => 'nullable|string|max:100',
            'niveau' => 'nullable|string|max:100',
        ]);

        $domaine = $data['domaine'] ?? 'web';
        $niveau = $data['niveau'] ?? 'intermediaire';

        $questions = Question::query()
            ->when($domaine, fn ($query) => $query->where('domaine', $domaine))
            ->when($niveau, fn ($query) => $query->where('niveau', $niveau))
            ->with([
                'options' => fn ($query) => $query->inRandomOrder(),
            ])
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if ($questions->isEmpty()) {
            $questions = Question::with([
                'options' => fn ($query) => $query->inRandomOrder(),
            ])->inRandomOrder()->limit(10)->get();
        }

        return view('pages.quiz-play', [
            'questions' => $questions,
            'domaine' => $domaine,
            'niveau' => $niveau,
        ]);
    }

    public function checkAnswer(Request $request): JsonResponse
    {
        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'option_id' => 'required|exists:question_options,id',
        ]);

        $question = Question::with('options')->findOrFail($data['question_id']);
        $selected = QuestionOption::where('question_id', $question->id)
            ->findOrFail($data['option_id']);

        return response()->json([
            'success' => true,
            'correct' => (bool) $selected->est_correcte,
            'explication' => $question->explication,
            'points' => $selected->est_correcte ? $question->points : 0,
        ]);
    }

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
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
            'categorie' => 'nullable|string|max:100',
        ]);

        $thread = ForumThread::create([
            'titre' => $data['titre'],
            'message' => $data['message'],
            'categorie' => $data['categorie'] ?? 'General',
            'user_id' => $request->user()->id,
        ]);

        return redirect()
            ->route('forum.show', $thread)
            ->with('success', 'Discussion créée avec succès.');
    }

    public function forumShow(ForumThread $thread): View
    {
        $thread->load([
            'user',
            'posts.user',
        ]);

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
            'user_id' => $request->user()->id,
            'message' => $data['message'],
        ]);

        return redirect()
            ->route('forum.show', $thread)
            ->with('success', 'Réponse ajoutée au forum.');
    }
}
