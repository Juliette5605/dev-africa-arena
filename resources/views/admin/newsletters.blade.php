@extends('admin.layout')
@section('title','Newsletter')
@section('page-title',' Abonnés Newsletter')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0"><strong>{{ $newsletters->total() }}</strong> abonnés enregistrés</p>
</div>
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Email</th><th>Nom</th><th>Statut</th><th>Date</th></tr></thead>
        <tbody>
        @forelse($newsletters as $n)
        <tr>
            <td class="text-muted small">{{ $n->id }}</td>
            <td class="fw-bold">{{ $n->email }}</td>
            <td>{{ $n->nom ?? '—' }}</td>
            <td>
                @if($n->confirmed)
                    <span class="badge rounded-pill fw-bold px-3" style="background:#d1fae5;color:#065f46;">Confirmé</span>
                @else
                    <span class="badge rounded-pill fw-bold px-3" style="background:#fef3c7;color:#92400e;">En attente</span>
                @endif
            </td>
            <td class="small text-muted">{{ $n->created_at->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted py-5">Aucun abonné</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $newsletters->links() }}</div>
</div>
@endsection
