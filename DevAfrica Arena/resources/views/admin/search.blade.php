@extends('admin.layout')
@section('title', 'Recherche')
@section('page-title', ' Recherche globale')

@section('content')
<div class="row justify-content-center mb-4">
    <div class="col-lg-8">
        <form method="GET" action="{{ route('admin.search') }}">
            <div class="input-group" style="box-shadow:0 4px 20px rgba(0,0,0,0.08);border-radius:16px;overflow:hidden;">
                <span class="input-group-text border-0 bg-white ps-4" style="font-size:1.2rem;"></span>
                <input type="text" name="q" class="form-control border-0 py-3"
                       value="{{ $q }}" placeholder="Rechercher un candidat, message, partenaire..."
                       autofocus style="font-size:1rem;">
                <button type="submit" class="btn fw-bold px-4"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;border-radius:0;">
                    Rechercher
                </button>
            </div>
        </form>
    </div>
</div>

@if($q)
<div class="mb-3">
    <p class="text-muted small">
        @if($total > 0)
            <strong>{{ $total }}</strong> résultat(s) pour "<strong>{{ $q }}</strong>"
        @else
            Aucun résultat pour "<strong>{{ $q }}</strong>"
        @endif
    </p>
</div>

@forelse($results as $r)
<a href="{{ $r['url'] }}" class="d-block text-decoration-none mb-2">
    <div class="admin-card p-3 d-flex align-items-center gap-3"
         style="transition:0.2s;" onmouseover="this.style.borderColor='#f39c12'" onmouseout="this.style.borderColor='#eee'">
        <div style="width:40px;height:40px;border-radius:12px;background:{{ $r['color'] }}20;color:{{ $r['color'] }};display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
            {{ $r['icon'] }}
        </div>
        <div class="flex-grow-1">
            <p class="fw-bold mb-0 small" style="color:#222;">{{ $r['title'] }}</p>
            <p class="text-muted mb-0" style="font-size:0.78rem;">{{ $r['sub'] }}</p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <span class="badge rounded-pill fw-bold px-3" style="background:{{ $r['color'] }}20;color:{{ $r['color'] }};font-size:0.68rem;">
                {{ $r['type'] }}
            </span>
            <span class="text-muted" style="font-size:0.72rem;">{{ $r['date'] }}</span>
        </div>
    </div>
</a>
@empty
<div class="text-center py-5">
    <div style="font-size:3rem;"></div>
    <h5 class="fw-bold mt-3">Aucun résultat</h5>
    <p class="text-muted">Essayez un autre terme de recherche.</p>
</div>
@endforelse
@else
<div class="text-center py-5 text-muted">
    <div style="font-size:3rem;"></div>
    <p class="mt-3">Tapez au moins 2 caractères pour lancer la recherche.</p>
    <p class="small">Recherche dans : candidatures, messages, partenaires, newsletters</p>
</div>
@endif
@endsection
