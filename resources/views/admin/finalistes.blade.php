@extends('admin.layout')
@section('title', 'Finalistes')
@section('page-title', ' Finalistes Sélectionnés')

@section('content')
    @if(session('success'))
        <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
            {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;">
            {{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted small mb-0">
                {{ $finalistes->count() }}/{{ $max }} finalistes sélectionnés
                <span class="ms-2" style="color:#f39c12;">●</span>
                Triés par note décroissante
            </p>
        </div>
        <a href="{{ route('admin.candidatures') }}" class="btn fw-bold rounded-3 px-4"
            style="background:#f8f9fa;color:#555;">← Retour aux candidatures</a>
    </div>

    @if($finalistes->isEmpty())
        <div class="text-center py-5">
            <div style="font-size:4rem;"></div>
            <h5 class="fw-bold mt-3">Aucun finaliste sélectionné</h5>
            <p class="text-muted">Ouvrez une candidature et cliquez sur "Ajouter aux finalistes".</p>
            <a href="{{ route('admin.candidatures') }}" class="btn fw-bold rounded-3 px-4 py-2 mt-2"
                style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">Voir les candidatures</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($finalistes as $i => $c)
                <div class="col-md-6 col-lg-4">
                    <div class="admin-card p-4" style="border-top:3px solid {{ ['#f39c12', '#888', '#b87333'][$i] ?? '#eee' }};">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                                style="width:48px;height:48px;background:linear-gradient(135deg,#f39c12,#e67e22);font-size:1.1rem;flex-shrink:0;">
                                {{ $i + 1 }}
                            </div>
                            <div>
                                <p class="fw-bold mb-0">{{ $c->prenom }} {{ $c->nom }}</p>
                                <p class="text-muted mb-0 small">{{ $c->expertise }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small text-muted">Niveau</span>
                            <span
                                class="badge rounded-pill fw-bold px-3 {{ $c->niveau === 'Junior' ? 'badge-junior' : ($c->niveau === 'Senior' ? 'badge-senior' : 'badge-inter') }}">
                                {{ $c->niveau }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small text-muted">Pays</span>
                            <span class="small fw-bold">{{ $c->pays }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="small text-muted">Note</span>
                            <span class="fw-bold" style="color:#f39c12;">
                                @for($s = 1; $s <= 5; $s++){{ $s <= $c->note ? '★' : '☆' }}@endfor
                                ({{ $c->note }}/5)
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.candidatures.show', $c) }}"
                                class="btn btn-sm rounded-3 fw-bold flex-grow-1 text-center py-2"
                                style="background:#f8f9fa;color:#555;font-size:0.8rem;">Voir le dossier</a>
                            <form action="{{ route('admin.candidatures.finaliste', $c) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm rounded-3 fw-bold py-2 px-3"
                                    style="background:rgba(220,38,38,0.08);color:#dc2626;font-size:0.8rem;"
                                    onclick="return confirm('Retirer des finalistes ?')">✕</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection