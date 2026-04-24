@extends('layouts.app')

@section('title', 'Forum Arena | DevAfricaArena')

@push('styles')
<style>
    .forum-page {
        min-height: calc(100vh - 90px);
        padding: 34px 0 52px;
        background:
            radial-gradient(circle at top right, rgba(243, 156, 18, 0.12), transparent 30%),
            linear-gradient(180deg, #fffaf3 0%, #ffffff 55%, #fff7eb 100%);
    }
    .forum-card {
        background: rgba(255,255,255,0.94);
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 28px;
        box-shadow: 0 18px 50px rgba(0,0,0,0.06);
        padding: 24px;
    }
    .thread-item {
        display: block;
        padding: 18px 0;
        border-top: 1px solid #f2f2f2;
        color: inherit;
        text-decoration: none;
    }
    .thread-item:first-child {
        border-top: none;
        padding-top: 0;
    }
    .thread-item:hover h4 {
        color: #f39c12;
    }
</style>
@endpush

@section('content')
<section class="forum-page">
    <div class="container">
        <div class="row g-3">
            <div class="col-lg-5">
                <div class="forum-card">
                    <span class="section-badge">Forum Arena</span>
                    <h1 class="fw-bold mb-2">Poser une question a la communaute</h1>
                    <p class="text-muted mb-4">
                        Ouvrez une discussion autour du quiz, des technologies, des candidatures ou des modules Arena.
                    </p>

                    <form action="{{ route('forum.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categorie</label>
                            <select name="categorie" class="form-select">
                                @foreach(['General', 'Quiz', 'Forum', 'Web', 'Mobile', 'IA', 'Design', 'Cyber'] as $category)
                                    <option value="{{ $category }}" {{ old('categorie') === $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Votre message</label>
                            <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn-submit">Creer la discussion</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="forum-card">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1" style="letter-spacing:1px;">Discussions</p>
                            <h3 class="fw-bold mb-0">Fils actifs</h3>
                        </div>
                        <span class="mini-badge" style="background:rgba(243,156,18,0.12);color:#f39c12;padding:8px 14px;border-radius:999px;font-weight:800;">
                            {{ $threads->total() }} sujet(s)
                        </span>
                    </div>

                    @forelse($threads as $thread)
                        <a href="{{ route('forum.show', $thread) }}" class="thread-item">
                            <div class="d-flex justify-content-between gap-3 flex-wrap">
                                <div>
                                    <div class="d-flex gap-2 align-items-center flex-wrap mb-2">
                                        @if($thread->est_epingle)
                                            <span class="mini-badge" style="background:rgba(2,132,199,0.12);color:#0284c7;padding:6px 12px;border-radius:999px;font-weight:800;">
                                                Epingle
                                            </span>
                                        @endif
                                        <span class="mini-badge" style="background:rgba(243,156,18,0.12);color:#f39c12;padding:6px 12px;border-radius:999px;font-weight:800;">
                                            {{ $thread->categorie }}
                                        </span>
                                    </div>
                                    <h4 class="fw-bold mb-1">{{ $thread->titre }}</h4>
                                    <p class="text-muted mb-2">{{ \Illuminate\Support\Str::limit($thread->message, 150) }}</p>
                                    <div class="small text-muted">
                                        Par {{ $thread->user?->name ?? 'Utilisateur' }} · {{ $thread->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="text-end small text-muted">
                                    <div>{{ $thread->comments_count }} reponse(s)</div>
                                    <div>{{ $thread->vues }} vue(s)</div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <div style="font-size:2.4rem;">💬</div>
                            <p class="mt-3 mb-0">Aucune discussion n'a encore ete creee.</p>
                        </div>
                    @endforelse

                    @if($threads->hasPages())
                        <div class="mt-4">
                            {{ $threads->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
