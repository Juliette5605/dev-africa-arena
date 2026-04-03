@extends('admin.layout')
@section('title', 'Candidatures')
@section('page-title', ' Candidatures')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill"
                style="width:220px;" placeholder=" Nom, expertise...">
            <select name="niveau" class="form-select rounded-pill" style="width:170px;">
                <option value="">Tous les niveaux</option>
                <option {{ request('niveau') == 'Junior' ? 'selected' : '' }}>Junior</option>
                <option {{ request('niveau') == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                <option {{ request('niveau') == 'Senior' ? 'selected' : '' }}>Senior</option>
            </select>
            <button class="btn btn-dark rounded-pill px-4 fw-bold">Filtrer</button>
            @if(request()->hasAny(['search', 'niveau']))
                <a href="{{ route('admin.candidatures') }}" class="btn btn-outline-secondary rounded-pill">✕ Reset</a>
            @endif
        </form>
        <a href="{{ route('admin.export.candidatures') }}" class="btn btn-warning fw-bold rounded-pill px-4">
            <i class="bi bi-download me-2"></i>Export CSV
        </a>
    </div>

    <div class="admin-table">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Candidat</th>
                    <th>Niveau</th>
                    <th>Expertise</th>
                    <th>Pays</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidatures as $c)
                    <tr>
                        <td class="text-muted small">{{ $c->id }}</td>
                        <td>
                            <span class="fw-bold">{{ $c->prenom }} {{ $c->nom }}</span>
                            <br><small class="text-muted">{{ $c->age }} ans · {{ $c->diplome }}</small>
                        </td>
                        <td>
                            <span
                                class="badge fw-bold rounded-pill px-3 {{ $c->niveau === 'Junior' ? 'badge-junior' : ($c->niveau === 'Senior' ? 'badge-senior' : 'badge-inter') }}">
                                {{ $c->niveau }}
                            </span>
                        </td>
                        <td class="small text-muted">{{ $c->expertise }}</td>
                        <td class="small">{{ $c->pays }}</td>
                        <td class="small text-muted">{{ $c->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.candidatures.show', $c) }}"
                                class="btn btn-sm btn-outline-dark rounded-pill me-1">Voir</a>
                            <form method="POST" action="{{ route('admin.candidatures.destroy', $c) }}" class="d-inline"
                                onsubmit="return confirm('Supprimer cette candidature ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">Aucune candidature</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-3">{{ $candidatures->links() }}</div>
    </div>
@endsection