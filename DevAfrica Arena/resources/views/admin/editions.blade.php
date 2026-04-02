@extends('admin.layout')
@section('title', 'Éditions')
@section('page-title', ' Éditions DevAfrica Arena')
@section('content')
    <div class="row g-4">
        {{-- Formulaire création --}}
        <div class="col-lg-4">
            <div class="stat-card">
                <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                    Nouvelle édition</h6>
                <form method="POST" action="{{ route('admin.editions.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nom</label>
                        <input type="text" name="nom" class="form-control rounded-3" placeholder="Édition #1 — Saison 2026"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Date Sélection (Jour 1)</label>
                        <input type="date" name="date_selection" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Date Finale (Jour 2)</label>
                        <input type="date" name="date_finale" class="form-control rounded-3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Lieu</label>
                        <input type="text" name="lieu" class="form-control rounded-3" value="Lomé, Togo">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="active" value="1" id="activeCheck">
                        <label class="form-check-label fw-bold" for="activeCheck">Activer immédiatement</label>
                    </div>
                    <button type="submit" class="btn btn-warning fw-bold rounded-pill w-100">Créer l'édition</button>
                </form>
            </div>
        </div>

        {{-- Liste --}}
        <div class="col-lg-8">
            <div class="admin-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Édition</th>
                            <th>Sélection</th>
                            <th>Finale</th>
                            <th>Lieu</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($editions as $e)
                            <tr>
                                <td class="fw-bold">{{ $e->nom }}</td>
                                <td class="small">{{ $e->date_selection->format('d/m/Y') }}</td>
                                <td class="small">{{ $e->date_finale->format('d/m/Y') }}</td>
                                <td class="small text-muted">{{ $e->lieu }}</td>
                                <td>
                                    @if($e->active)
                                        <span class="badge rounded-pill fw-bold px-3" style="background:#d1fae5;color:#065f46;">●
                                            Active</span>
                                    @else
                                        <span class="badge rounded-pill fw-bold px-3"
                                            style="background:#f3f4f6;color:#888;">Inactive</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-1">
                                    @if(!$e->active)
                                        <form method="POST" action="{{ route('admin.editions.activate', $e) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-warning rounded-pill fw-bold">Activer</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.editions.destroy', $e) }}"
                                        onsubmit="return confirm('Supprimer ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill">✕</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Aucune édition créée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection