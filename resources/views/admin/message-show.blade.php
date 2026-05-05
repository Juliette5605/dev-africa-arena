@extends('admin.layout')
@section('title','Message #'.$message->id)
@section('page-title',' Message complet')
@section('content')
<a href="{{ route('admin.messages') }}" class="btn btn-outline-secondary rounded-pill mb-4"><i class="bi bi-arrow-left me-2"></i>Retour</a>
<div class="stat-card" style="max-width:700px;">
    <div class="mb-4">
        <span class="text-muted small">De</span>
        <h5 class="fw-bold mb-0">{{ $message->nom }}</h5>
        <a href="mailto:{{ $message->email }}" class="text-warning fw-bold small">{{ $message->email }}</a>
    </div>
    <div class="mb-4">
        <span class="text-muted small">Sujet</span>
        <p class="fw-bold mb-0 fs-5">{{ $message->sujet }}</p>
    </div>
    <div class="p-4 rounded-3" style="background:#f8f9fa;line-height:1.8;">{{ $message->message }}</div>
    <p class="text-muted small mt-3 mb-0"><i class="bi bi-clock me-1"></i>Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}</p>
    <div class="mt-4 d-flex gap-2">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->sujet }}" class="btn btn-warning fw-bold rounded-pill px-4">
            <i class="bi bi-reply-fill me-2"></i>Répondre
        </a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger rounded-pill px-4">Supprimer</button>
        </form>
    </div>
</div>
@endsection
