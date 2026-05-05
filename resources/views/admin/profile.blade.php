@extends('admin.layout')
@section('title', 'Mon Profil')
@section('page-title', ' Mon Profil')

@section('content')
<div class="row g-4">

    {{-- Infos personnelles --}}
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Informations personnelles
            </h6>
            @if(session('success'))
            <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('admin.profile.update.info') }}" method="POST">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nom complet</label>
                    <input type="text" name="name" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('name', $admin->name) }}" required>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Adresse email</label>
                    <input type="email" name="email" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('email', $admin->email) }}" required>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4 p-3 rounded-3" style="background:#f8f9fa;">
                    <p class="small mb-1 text-muted">Rôle</p>
                    <span class="fw-bold">
                        @if($admin->isSuperAdmin())  Super Administrateur
                        @else  Sous-administrateur {{ $admin->can_edit ? '(délégation active)' : '(lecture seule)' }}
                        @endif
                    </span>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Mettre à jour les informations
                </button>
            </form>
        </div>
    </div>

    {{-- Changer mot de passe --}}
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Changer le mot de passe
            </h6>
            <form action="{{ route('admin.profile.update.password') }}" method="POST">
                @csrf @method('PATCH')
                <div class="mb-3">
                    <label class="form-label fw-bold small">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="••••••••" required>
                    @error('current_password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Minimum 8 caractères" required>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Répéter le mot de passe" required>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:#222;color:white;">
                    Changer le mot de passe
                </button>
            </form>
        </div>

        {{-- Info compte --}}
        <div class="admin-card p-4 mt-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                 Informations du compte
            </h6>
            <div class="d-flex justify-content-between py-2 border-bottom">
                <span class="text-muted small">Compte créé le</span>
                <span class="small fw-bold">{{ $admin->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom">
                <span class="text-muted small">Dernière mise à jour</span>
                <span class="small fw-bold">{{ $admin->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="d-flex justify-content-between py-2">
                <span class="text-muted small">ID Admin</span>
                <span class="small fw-bold">#{{ $admin->id }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
