@extends('layouts.app')

@section('title', 'Quiz Arena | DevAfricaArena')

@push('styles')
<style>
    .quiz-page {
        min-height: calc(100vh - 90px);
        padding: 34px 0 52px;
        background:
            radial-gradient(circle at top right, rgba(243, 156, 18, 0.12), transparent 30%),
            linear-gradient(180deg, #fffaf3 0%, #ffffff 55%, #fff7eb 100%);
    }
    .quiz-card,
    .quiz-empty {
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 28px;
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.06);
    }
    .quiz-card {
        padding: 28px;
    }
    .quiz-empty {
        padding: 42px 28px;
        text-align: center;
    }
    .quiz-option {
        border: 1px solid rgba(243, 156, 18, 0.18);
        border-radius: 18px;
        padding: 16px 18px;
        background: #fffdf8;
        color: #333;
        font-weight: 700;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }
    .quiz-option:hover {
        transform: translateY(-2px);
        border-color: rgba(243, 156, 18, 0.5);
        background: #fff8eb;
    }
    .quiz-option.is-correct {
        background: rgba(22, 163, 74, 0.12);
        border-color: rgba(22, 163, 74, 0.35);
        color: #166534;
    }
    .quiz-option.is-wrong {
        background: rgba(220, 38, 38, 0.08);
        border-color: rgba(220, 38, 38, 0.25);
        color: #b91c1c;
    }
</style>
@endpush

@section('content')
<section class="quiz-page">
    <div class="container">
        @if($questions->isEmpty())
            <div class="quiz-empty">
                <div style="font-size:2.8rem;">🧠</div>
                <h1 class="fw-bold mt-3 mb-2">Quiz Arena indisponible pour le moment</h1>
                <p class="text-muted mb-4">
                    Aucune question n'a encore ete trouvee pour ce niveau ou ce domaine. Vous pouvez revenir plus tard
                    ou essayer avec une autre combinaison.
                </p>
                <a href="{{ route('home') }}" class="btn-gold">Retour a l'accueil</a>
            </div>
        @else
            <div class="quiz-card">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                    <div>
                        <span class="section-badge mb-2">Quiz Arena</span>
                        <h1 class="fw-bold mb-1">Challenge de connaissances</h1>
                        <p class="text-muted mb-0">
                            Domaine: <strong>{{ ucfirst($domaine) }}</strong> · Niveau: <strong>{{ ucfirst($niveau) }}</strong>
                        </p>
                    </div>
                    <span class="mini-badge" style="background:rgba(243,156,18,0.12);color:#f39c12;padding:8px 14px;border-radius:999px;font-weight:800;">
                        {{ $questions->count() }} questions
                    </span>
                </div>

                <div id="quiz-steps">
                    @foreach($questions as $index => $question)
                        <div class="q-card" data-step="{{ $index }}" style="{{ $index > 0 ? 'display:none;' : '' }}">
                            <div class="mb-4">
                                <span class="section-badge mb-2">Question {{ $index + 1 }} / {{ $questions->count() }}</span>
                                <h2 class="fw-bold mb-0">{{ $question->enonce }}</h2>
                            </div>

                            <div class="d-grid gap-3">
                                @foreach($question->options as $option)
                                    <button
                                        type="button"
                                        class="quiz-option option-btn text-start"
                                        data-correct="{{ $option->est_correcte ? 1 : 0 }}"
                                    >
                                        {{ $option->texte }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="final-results" class="text-center py-4" style="display:none;">
                    <h2 class="fw-bold mb-2">Challenge termine</h2>
                    <p class="text-muted mb-3">Votre score final est maintenant calcule.</p>
                    <p class="fs-4 fw-bold">
                        Score: <span id="score-val">0</span> / {{ $questions->count() }}
                    </p>
                    <div class="d-flex justify-content-center gap-2 flex-wrap mt-4">
                        <a href="{{ route('quiz.play', ['domaine' => $domaine, 'niveau' => $niveau]) }}" class="btn-gold">
                            Rejouer ce quiz
                        </a>
                        <a href="{{ route('home') }}" class="btn-outline-gold">
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@if($questions->isNotEmpty())
@push('scripts')
<script>
let currentStep = 0;
let score = 0;
let locked = false;

document.querySelectorAll('.option-btn').forEach((btn) => {
    btn.addEventListener('click', function () {
        if (locked) return;
        locked = true;

        if (this.dataset.correct === '1') {
            score++;
            this.classList.add('is-correct');
        } else {
            this.classList.add('is-wrong');
        }

        setTimeout(() => {
            const currentCard = document.querySelector(`[data-step="${currentStep}"]`);
            if (currentCard) {
                currentCard.style.display = 'none';
            }

            currentStep++;

            const nextCard = document.querySelector(`[data-step="${currentStep}"]`);
            if (nextCard) {
                nextCard.style.display = 'block';
                locked = false;
                return;
            }

            document.getElementById('quiz-steps').style.display = 'none';
            document.getElementById('final-results').style.display = 'block';
            document.getElementById('score-val').textContent = score;
        }, 650);
    });
});
</script>
@endpush
@endif
@endsection
