@extends('admin.layout')
@section('title','Partenaires')
@section('page-title',' Partenaires & Sponsors')
@section('content')
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Responsable</th><th>Entreprise</th><th>Téléphone</th><th>Type</th><th>Détail</th><th>Date</th><th></th></tr></thead>
        <tbody>
        @forelse($partenaires as $p)
        <tr>
            <td class="text-muted small">{{ $p->id }}</td>
            <td class="fw-bold">{{ $p->responsable }}</td>
            <td>{{ $p->entreprise }}</td>
            <td class="small">{{ $p->telephone }}</td>
            <td>
                @if($p->type==='financier')
                    <span class="badge rounded-pill fw-bold px-3" style="background:#fff3e0;color:#f39c12;">Financier</span>
                @elseif($p->type==='technique')
                    <span class="badge rounded-pill fw-bold px-3" style="background:#e0f2fe;color:#0284c7;">Technique</span>
                @else
                    <span class="badge rounded-pill fw-bold px-3" style="background:#fdf4ff;color:#9333ea;">Sponsor</span>
                @endif
            </td>
            <td class="small text-muted">
                @if($p->pack) Pack {{ $p->pack }}
                @elseif($p->niveau_sponsor) {{ $p->niveau_sponsor }}
                @elseif($p->type_apport) {{ $p->type_apport }}
                @endif
            </td>
            <td class="small text-muted">{{ $p->created_at->format('d/m/Y') }}</td>
            <td>
                <form method="POST" action="{{ route('admin.partenaires.destroy', $p) }}" onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted py-5">Aucun partenaire</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $partenaires->links() }}</div>
</div>
@endsection
