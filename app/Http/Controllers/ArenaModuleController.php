<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class ArenaModuleController extends Controller
{
    public function startQuiz(Request $request)
    {
        // 🔐 validation simple mais efficace
        $data = $request->validate([
            'domaine' => 'nullable|string',
            'niveau'  => 'nullable|string',
        ]);

        $domaine = $data['domaine'] ?? 'web';
        $niveau  = $data['niveau'] ?? 'intermediaire';

        $questions = Question::where('domaine', $domaine)
            ->where('niveau', $niveau)
            ->with([
                'options' => function ($q) {
                    $q->inRandomOrder();
                }
            ])
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return view('pages.quiz-play', [
            'questions' => $questions,
            'domaine'   => $domaine,
            'niveau'    => $niveau
        ]);
    }

    public function forumIndex()
    {
        $threads = ForumThread::with(['user'])
            ->withCount('comments') // 🔥 bonus utile
            ->latest()
            ->paginate(20); // 🚀 mieux que get()

        return view('pages.forum-index', compact('threads'));
    }
}