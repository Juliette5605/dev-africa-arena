@extends('admin.layout')
@section('title','Réinitialisation mot de passe')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5">
        <div class="admin-card p-5">
            <div class="text-center mb-4">
                <div style="font-size:3rem;">🔑</div>
                <h4 class="fw-bold mt-2">Mot de passe oublié ?</h4>
                <p class="text-muted small">Entrez votre email admin pour obtenir un lien de réinitialisation.</p>
            </div>

            @if(session('success'))
                <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
                    {{ session('success') }}
                </div>
                @if(session('reset_link'))
                <div class="p-3 rounded-3 mb-4" style="background:#f8f9fa;border:1px dashed #ccc;word-break:break-all;">
                    <p class="small fw-bold mb-1"> Votre lien (valable 30 min) :</p>
                    <a href="{{ session('reset_link') }}" class="small" style="color:#f39c12;">{{ session('reset_link') }}</a>
                </div>
                @endif
            @endif

            <form action="{{ route('admin.password.request.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold small">Adresse email admin</label>
                    <input type="email" name="email" class="form-control rounded-3 border-0 bg-light py-3"
                           placeholder="admin@devafrica.arena" value="{{ old('email') }}" required>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Envoyer le lien de réinitialisation
                </button>
                <div class="text-center mt-3">
                    <a href="{{ route('admin.login') }}" class="small text-muted">← Retour à la connexion</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
