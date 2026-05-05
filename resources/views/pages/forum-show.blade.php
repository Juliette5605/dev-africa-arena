@extends('layouts.app')

@section('title', $thread->titre . ' | Forum Arena')

@push('styles')
<style>
    .forum-page {
        min-height: calc(100vh - 90px);
        padding: 34px 0 52px;
        background:
            radial-gradient(circle at top right, rgba(243, 156, 18, 0.12), transparent 30%),
            linear-gradient(180deg, #fffaf3 0%, #ffffff 55%, #fff7eb 100%);
    }
    .forum-card,
    .post-card {
        background: rgba(255,255,255,0.94);
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 28px;
        box-shadow: 0 18px 50px rgba(0,0,0,0.06);
    }
    .forum-card {
        padding: 26px;
    }
    .post-card {
        padding: 20px 22px;
    }
</style>
@endpush

@section('content')
<section class="forum-page">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="forum-card mb-3">
                    <div class="d-flex gap-2 align-items-center flex-wrap mb-3">
                        <a href="{{ route('forum.index') }}" class="btn-outline-gold" style="padding:10px 18px;">Retour au forum</a>
                        <span class="mini-badge" style="background:rgba(243,156,18,0.12);color:#f39c12;padding:6px 12px;border-radius:999px;font-weight:800;">
                            {{ $thread->categorie }}
                        </span>
                        <span class="small text-muted">{{ $thread->vues }} vue(s)</span>
                    </div>

                    <h1 class="fw-bold mb-2">{{ $thread->titre }}</h1>
                    <p class="text-muted mb-3">
                        Ouvert par {{ $thread->user?->name ?? 'Utilisateur' }} · {{ $thread->created_at->diffForHumans() }}
                    </p>
                    <div style="white-space:pre-wrap;line-height:1.75;">{{ $thread->message }}</div>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                    <div>
                        <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Reponses</p>
                        <h3 class="fw-bold mb-0">{{ $thread->posts->count() }} participation(s)</h3>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    @forelse($thread->posts as $post)
                        <div class="post-card">
                            <div class="d-flex justify-content-between gap-2 flex-wrap mb-2">
                                <strong>{{ $post->user?->name ?? 'Utilisateur' }}</strong>
                                <span class="small text-muted">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <div style="white-space:pre-wrap;line-height:1.75;">{{ $post->message }}</div>
                        </div>
                    @empty
                        <div class="post-card text-center text-muted">
                            Aucune reponse pour le moment. Soyez le premier a participer.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="col-lg-4">
                <div class="forum-card">
                    <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Participer</p>
                    <h4 class="fw-bold mb-3">Ajouter une reponse</h4>
                    <form action="{{ route('forum.reply', $thread) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Votre message</label>
                            <textarea name="message" class="form-control" rows="7" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-submit">Publier la reponse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
