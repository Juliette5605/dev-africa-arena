@extends('admin.layout')
@section('title','Nouveau mot de passe')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5">
        <div class="admin-card p-5">
            <div class="text-center mb-4">
                <div style="font-size:3rem;">🔒</div>
                <h4 class="fw-bold mt-2">Nouveau mot de passe</h4>
                <p class="text-muted small">Choisissez un mot de passe sécurisé (min. 8 caractères).</p>
            </div>
            @if($errors->has('token'))
                <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(220,38,38,0.1);color:#dc2626;">
                    {{ $errors->first('token') }}
                </div>
            @endif
            <form action="{{ route('admin.password.reset.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="mb-3">
                    <label class="form-label fw-bold small">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Minimum 8 caractères" required>
                    @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="Répéter le mot de passe" required>
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Réinitialiser le mot de passe
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
