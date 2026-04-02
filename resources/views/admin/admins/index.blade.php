@extends('admin.layout')
@section('title', 'Gestion des Admins')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"> Gestion des Admins</h4>
        <p class="text-muted small mb-0">Maximum 2 sous-administrateurs. Vous seul pouvez leur accorder la délégation.</p>
    </div>
</div>

{{-- Alertes --}}
@if(session('success'))
    <div class="alert border-0 rounded-4 fw-bold mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert border-0 rounded-4 fw-bold mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;">
        {{ session('error') }}
    </div>
@endif

<div class="row g-4">

    {{-- ─── CRÉER UN SOUS-ADMIN ─── --}}
    @if($subAdmins->count() < 2)
    <div class="col-lg-5">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Créer un sous-admin
            </h6>
            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nom complet</label>
                    <input type="text" name="name" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('name') }}" placeholder="Ex: Alex WILSON" required>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Adresse email</label>
                    <input type="email" name="email" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('email') }}" placeholder="email@exemple.com" required>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Mot de passe</label>
                    <input type="password" name="password" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Minimum 8 caractères" required>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Répétez le mot de passe" required>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Créer le sous-admin
                </button>
            </form>
        </div>
    </div>
    @else
    <div class="col-lg-5">
        <div class="admin-card p-4 text-center">
            <div style="font-size:3rem;">🔒</div>
            <h6 class="fw-bold mt-3">Limite atteinte</h6>
            <p class="text-muted small">Vous avez déjà 2 sous-admins. Supprimez-en un pour en créer un nouveau.</p>
        </div>
    </div>
    @endif

    {{-- ─── LISTE DES SOUS-ADMINS ─── --}}
    <div class="col-lg-7">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Sous-administrateurs ({{ $subAdmins->count() }}/2)
            </h6>

            @forelse($subAdmins as $sub)
            <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-3"
                 style="background:#f8f9fa;border:1px solid #eee;">
                <div class="d-flex align-items-center gap-3">
                    {{-- Avatar initiales --}}
                    <div class="d-flex align-items-center justify-content-center fw-bold text-white rounded-circle"
                         style="width:44px;height:44px;background:linear-gradient(135deg,#f39c12,#e67e22);font-size:1rem;flex-shrink:0;">
                        {{ strtoupper(substr($sub->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-bold" style="font-size:0.95rem;">{{ $sub->name }}</div>
                        <div class="text-muted small">{{ $sub->email }}</div>
                        <div class="mt-1">
                            @if($sub->can_edit)
                                <span class="badge rounded-pill fw-bold px-3"
                                      style="background:rgba(22,163,74,0.12);color:#16a34a;font-size:0.7rem;">
                                     Délégation active — peut modifier
                                </span>
                            @else
                                <span class="badge rounded-pill fw-bold px-3"
                                      style="background:rgba(107,114,128,0.1);color:#6b7280;font-size:0.7rem;">
                                     Lecture seule
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-shrink-0">
                    {{-- Toggle délégation --}}
                    <form action="{{ route('admin.admins.delegate', $sub) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="btn btn-sm fw-bold rounded-3 px-3"
                                style="{{ $sub->can_edit
                                    ? 'background:rgba(220,38,38,0.1);color:#dc2626;border:1px solid rgba(220,38,38,0.2);'
                                    : 'background:rgba(22,163,74,0.1);color:#16a34a;border:1px solid rgba(22,163,74,0.2);' }}"
                                title="{{ $sub->can_edit ? 'Révoquer la délégation' : 'Accorder la délégation' }}">
                            {{ $sub->can_edit ? ' Révoquer' : ' Déléguer' }}
                        </button>
                    </form>

                    {{-- Supprimer --}}
                    <form action="{{ route('admin.admins.destroy', $sub) }}" method="POST"
                          onsubmit="return confirm('Supprimer ce sous-admin ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm fw-bold rounded-3 px-3"
                                style="background:rgba(220,38,38,0.08);color:#dc2626;border:1px solid rgba(220,38,38,0.15);">
                            🗑️
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-5 text-muted">
                <div style="font-size:2.5rem;">👤</div>
                <p class="mt-2 small">Aucun sous-admin créé pour l'instant.</p>
            </div>
            @endforelse
        </div>

        {{-- Info délégation --}}
        <div class="mt-3 p-3 rounded-4" style="background:#fff8eb;border:1px dashed rgba(243,156,18,0.4);">
            <p class="mb-0 small" style="color:#92400e;">
                <strong> Délégation :</strong> En temps normal les sous-admins sont en <strong>lecture seule</strong>.
                Si vous êtes indisponible, activez la délégation pour leur accorder temporairement les droits de modification.
                Révoquez-la dès votre retour.
            </p>
        </div>
    </div>

</div>
@endsection
