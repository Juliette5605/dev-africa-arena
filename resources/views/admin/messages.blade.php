@extends('admin.layout')
@section('title','Messages')
@section('page-title',' Messages de contact')
@section('content')
<div class="admin-table">
    <table class="table">
        <thead><tr><th>#</th><th>Expéditeur</th><th>Email</th><th>Sujet</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($messages as $m)
        <tr>
            <td class="text-muted small">{{ $m->id }}</td>
            <td class="fw-bold">{{ $m->nom }}</td>
            <td class="small text-muted">{{ $m->email }}</td>
            <td class="small">{{ Str::limit($m->sujet, 50) }}</td>
            <td class="small text-muted">{{ $m->created_at->format('d/m/Y H:i') }}</td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-dark rounded-pill">Lire</a>
                <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted py-5">Aucun message</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $messages->links() }}</div>
</div>
@endsection
