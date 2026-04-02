@extends('admin.layout')
@section('title', 'Paramètres')
@section('page-title', ' Paramètres du site')

@section('content')
@if(session('success'))
<div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST">
@csrf @method('PATCH')
<div class="row g-4">

    {{-- Informations générales --}}
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Informations générales</h6>
            @foreach(['site_name'=>'Nom du site','site_slogan'=>'Slogan','site_email'=>'Email de contact','site_phone'=>'Téléphone','site_address'=>'Adresse'] as $key=>$label)
            <div class="mb-3">
                <label class="form-label fw-bold small">{{ $label }}</label>
                <input type="{{ $key==='site_email'?'email':'text' }}" name="{{ $key }}"
                       class="form-control rounded-3 border-0 bg-light py-3"
                       value="{{ old($key, $settings[$key]->value ?? '') }}" required>
                @error($key)<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            @endforeach
        </div>
    </div>

    {{-- Compétition --}}
    <div class="col-lg-6">
        <div class="admin-card p-4 mb-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">🏆 Compétition</h6>
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label fw-bold small">Cash Prize (FCFA)</label>
                    <input type="text" name="cash_prize" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('cash_prize', $settings['cash_prize']->value ?? '350 000') }}">
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold small">Max candidats/édition</label>
                    <input type="number" name="max_candidats" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('max_candidats', $settings['max_candidats']->value ?? '100') }}" min="1">
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold small">Nombre de finalistes</label>
                    <input type="number" name="nb_finalistes" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('nb_finalistes', $settings['nb_finalistes']->value ?? '6') }}" min="1">
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold small">Jours de compétition</label>
                    <input type="number" name="nb_jours" class="form-control rounded-3 border-0 bg-light py-3"
                           value="{{ old('nb_jours', $settings['nb_jours']->value ?? '2') }}" min="1">
                </div>
            </div>
        </div>

        {{-- Réseaux sociaux --}}
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Réseaux sociaux</h6>
            @foreach(['facebook'=>' Facebook','linkedin'=>' LinkedIn','instagram'=>' Instagram','twitter'=>' Twitter/X'] as $key=>$label)
            <div class="mb-3">
                <label class="form-label fw-bold small">{{ $label }}</label>
                <input type="url" name="{{ $key }}" class="form-control rounded-3 border-0 bg-light py-3"
                       value="{{ old($key, $settings[$key]->value ?? '') }}"
                       placeholder="https://...">
            </div>
            @endforeach
        </div>
    </div>

    {{-- Newsletter --}}
    <div class="col-lg-6">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Newsletter par défaut</h6>
            <div class="mb-3">
                <label class="form-label fw-bold small">Objet par défaut des newsletters</label>
                <input type="text" name="newsletter_subject" class="form-control rounded-3 border-0 bg-light py-3"
                       value="{{ old('newsletter_subject', $settings['newsletter_subject']->value ?? '') }}">
            </div>
        </div>
    </div>

    {{-- Mode maintenance --}}
    <div class="col-lg-6">
        <div class="admin-card p-4" style="{{ ($settings['maintenance_mode']->value??'0')==='1'?'border:2px solid #ef4444;':'' }}">
            <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;"> Mode Maintenance</h6>
            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded-3" style="background:#fff5f5;border:1px solid rgba(239,68,68,0.2);">
                <div>
                    <p class="fw-bold mb-0 small">Activer le mode maintenance</p>
                    <p class="text-muted mb-0" style="font-size:0.78rem;">Le site public affichera un message de maintenance. Le panel admin reste accessible.</p>
                </div>
                <div class="form-check form-switch ms-auto">
                    <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maint"
                           {{ ($settings['maintenance_mode']->value??'0')==='1'?'checked':'' }} style="width:48px;height:24px;cursor:pointer;">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small">Message affiché pendant la maintenance</label>
                <textarea name="maintenance_msg" class="form-control rounded-3 border-0 bg-light py-3" rows="3">{{ old('maintenance_msg', $settings['maintenance_msg']->value ?? '') }}</textarea>
            </div>
        </div>
    </div>

</div>

<div class="mt-4">
    <button type="submit" class="btn px-5 fw-bold py-3 rounded-3"
            style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;font-size:1rem;">
         Sauvegarder tous les paramètres
    </button>
</div>
</form>
@endsection
