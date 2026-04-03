@extends('admin.layout')
@section('title', 'TalentSync IA')
@section('content')

<div class="mb-4">
    <h4 class="fw-bold mb-1">TalentSync — Assistant IA</h4>
    <p class="text-muted small mb-0">Générez des CV, lettres de motivation, matchings et candidatures automatiques grâce à l'IA.</p>
</div>

{{-- Statut API --}}
<div class="admin-card p-3 mb-4 d-flex align-items-center gap-3" id="api-status-bar">
    <div id="api-dot" style="width:10px;height:10px;border-radius:50%;background:#aaa;flex-shrink:0;"></div>
    <span id="api-status-text" class="small fw-bold text-muted">Vérification de la connexion TalentSync...</span>
</div>

<div class="row g-4">

    {{-- Sélecteur de candidat --}}
    <div class="col-lg-4">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                Sélectionner un candidat
            </h6>
            <select id="candidature-select" class="form-select rounded-3 border-0 bg-light py-3 mb-3">
                <option value="">— Choisir un candidat —</option>
                @foreach($candidatures as $c)
                <option value="{{ $c->id }}"
                        data-nom="{{ $c->prenom }} {{ $c->nom }}"
                        data-expertise="{{ $c->expertise }}"
                        data-niveau="{{ $c->niveau }}"
                        data-pays="{{ $c->pays }}">
                    {{ $c->prenom }} {{ $c->nom }} — {{ $c->niveau }}
                </option>
                @endforeach
            </select>

            {{-- Infos candidat sélectionné --}}
            <div id="candidat-info" style="display:none;" class="p-3 rounded-3" style="background:#f8f9fa;">
                <p class="fw-bold mb-1 small" id="info-nom"></p>
                <p class="text-muted mb-1 small" id="info-expertise"></p>
                <p class="text-muted mb-0 small" id="info-niveau"></p>
            </div>

            @if($candidatures->isEmpty())
            <div class="text-center py-3 text-muted small">
                Aucune candidature reçue pour l'instant.
            </div>
            @endif
        </div>

        {{-- Candidature automatique --}}
        <div class="admin-card p-4 mt-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                Candidature automatique
            </h6>
            <div class="mb-3">
                <label class="form-label fw-bold small">Titre du poste</label>
                <input type="text" id="offre-titre" class="form-control rounded-3 border-0 bg-light py-2"
                       placeholder="Ex: Développeur Full-Stack">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small">URL de l'offre</label>
                <input type="url" id="offre-url" class="form-control rounded-3 border-0 bg-light py-2"
                       placeholder="https://...">
            </div>
            <button onclick="autoApply()" class="btn w-100 fw-bold py-2 rounded-3"
                    style="background:#222;color:white;font-size:0.88rem;">
                Postuler automatiquement
            </button>
        </div>
    </div>

    {{-- Actions IA --}}
    <div class="col-lg-8">
        <div class="row g-3 mb-4">
            <div class="col-sm-4">
                <button onclick="generateCV()" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                    Générer le CV
                </button>
            </div>
            <div class="col-sm-4">
                <button onclick="generateCoverLetter()" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:#222;color:white;">
                    Lettre de motivation
                </button>
            </div>
            <div class="col-sm-4">
                <button onclick="matchOpportunities()" class="btn w-100 fw-bold py-3 rounded-3"
                        style="background:#0284c7;color:white;">
                    Matching IA
                </button>
            </div>
        </div>

        {{-- Champ poste pour lettre --}}
        <div id="cover-letter-fields" class="admin-card p-3 mb-3" style="display:none;">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" id="poste-input" class="form-control rounded-3 border-0 bg-light py-2"
                           placeholder="Poste visé *">
                </div>
                <div class="col-md-6">
                    <input type="text" id="entreprise-input" class="form-control rounded-3 border-0 bg-light py-2"
                           placeholder="Entreprise (optionnel)">
                </div>
            </div>
        </div>

        {{-- Résultat IA --}}
        <div class="admin-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                    Résultat IA
                </h6>
                <button onclick="copyResult()" id="copy-btn" class="btn btn-sm rounded-3 fw-bold px-3"
                        style="background:#f8f9fa;color:#555;font-size:0.78rem;display:none;">
                    Copier
                </button>
            </div>

            <div id="ia-loading" style="display:none;" class="text-center py-4">
                <div class="spinner-grow spinner-grow-sm text-warning me-2"></div>
                <span class="text-muted small">TalentSync IA en cours de traitement...</span>
            </div>

            <div id="ia-result" class="p-3 rounded-3"
                 style="background:#f8f9fa;min-height:200px;font-size:0.9rem;line-height:1.7;white-space:pre-wrap;display:none;"></div>

            <div id="ia-placeholder" class="text-center py-5 text-muted">
                <div style="font-size:2.5rem;margin-bottom:12px;">🤖</div>
                <p class="small">Sélectionnez un candidat et choisissez une action IA</p>
            </div>

            {{-- Matches --}}
            <div id="matches-result" style="display:none;"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
const ROUTES = {
    cv:     '{{ route("admin.talentsync.cv") }}',
    letter: '{{ route("admin.talentsync.letter") }}',
    match:  '{{ route("admin.talentsync.match") }}',
    apply:  '{{ route("admin.talentsync.apply") }}',
    status: '{{ route("admin.talentsync.status") }}',
};
const CSRF = '{{ csrf_token() }}';

// Vérification statut API
fetch(ROUTES.status, { headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' } })
    .then(r => r.json())
    .then(d => {
        const dot  = document.getElementById('api-dot');
        const text = document.getElementById('api-status-text');
        if (d.success) {
            dot.style.background  = '#16a34a';
            text.textContent      = 'TalentSync IA connecté et opérationnel';
            text.style.color      = '#16a34a';
        } else {
            dot.style.background  = '#ef4444';
            text.textContent      = 'TalentSync IA non disponible actuellement';
            text.style.color      = '#ef4444';
        }
    }).catch(() => {
        document.getElementById('api-dot').style.background = '#f39c12';
        document.getElementById('api-status-text').textContent = 'Statut inconnu';
    });

// Sélecteur candidat
document.getElementById('candidature-select').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    const info = document.getElementById('candidat-info');
    if (this.value) {
        document.getElementById('info-nom').textContent       = opt.dataset.nom;
        document.getElementById('info-expertise').textContent = opt.dataset.expertise;
        document.getElementById('info-niveau').textContent    = opt.dataset.niveau + ' — ' + opt.dataset.pays;
        info.style.display = 'block';
        info.style.background = '#fff8eb';
        info.style.border = '1px solid rgba(243,156,18,0.2)';
        info.style.borderRadius = '10px';
    } else {
        info.style.display = 'none';
    }
});

function getCandidatureId() {
    const id = document.getElementById('candidature-select').value;
    if (!id) { alert('Veuillez sélectionner un candidat.'); return null; }
    return id;
}

function showLoading() {
    document.getElementById('ia-placeholder').style.display = 'none';
    document.getElementById('matches-result').style.display = 'none';
    document.getElementById('ia-result').style.display      = 'none';
    document.getElementById('ia-loading').style.display     = 'block';
    document.getElementById('copy-btn').style.display       = 'none';
}

function showResult(text) {
    document.getElementById('ia-loading').style.display = 'none';
    document.getElementById('ia-result').style.display  = 'block';
    document.getElementById('ia-result').textContent    = text;
    document.getElementById('copy-btn').style.display   = 'block';
}

function showError(msg) {
    document.getElementById('ia-loading').style.display = 'none';
    document.getElementById('ia-result').style.display  = 'block';
    document.getElementById('ia-result').style.color    = '#ef4444';
    document.getElementById('ia-result').textContent    = 'Erreur : ' + msg;
}

function copyResult() {
    const text = document.getElementById('ia-result').textContent;
    navigator.clipboard.writeText(text).then(() => {
        document.getElementById('copy-btn').textContent = 'Copié !';
        setTimeout(() => document.getElementById('copy-btn').textContent = 'Copier', 2000);
    });
}

async function callAPI(url, body) {
    const r = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body: JSON.stringify(body)
    });
    return r.json();
}

async function generateCV() {
    const id = getCandidatureId(); if (!id) return;
    showLoading();
    const d = await callAPI(ROUTES.cv, { candidature_id: id });
    d.success ? showResult(typeof d.cv === 'string' ? d.cv : JSON.stringify(d.cv, null, 2)) : showError(d.error);
}

async function generateCoverLetter() {
    const id = getCandidatureId(); if (!id) return;
    const fields = document.getElementById('cover-letter-fields');
    fields.style.display = fields.style.display === 'none' ? 'block' : 'block';
    const poste = document.getElementById('poste-input').value;
    if (!poste) { alert('Veuillez entrer le poste visé.'); return; }
    showLoading();
    const d = await callAPI(ROUTES.letter, {
        candidature_id: id,
        poste: poste,
        entreprise: document.getElementById('entreprise-input').value
    });
    d.success ? showResult(typeof d.lettre === 'string' ? d.lettre : JSON.stringify(d.lettre, null, 2)) : showError(d.error);
}

async function matchOpportunities() {
    const id = getCandidatureId(); if (!id) return;
    showLoading();
    const d = await callAPI(ROUTES.match, { candidature_id: id });
    if (d.success) {
        document.getElementById('ia-loading').style.display = 'none';
        const matches = d.matches;
        let html = '';
        if (Array.isArray(matches) && matches.length) {
            matches.forEach(m => {
                html += `<div class="p-3 mb-2 rounded-3" style="background:#fff8eb;border:1px solid rgba(243,156,18,0.2);">
                    <p class="fw-bold mb-1 small">${m.titre || m.title || JSON.stringify(m)}</p>
                    ${m.entreprise ? `<p class="text-muted mb-0 small">${m.entreprise}</p>` : ''}
                </div>`;
            });
        } else {
            html = '<p class="text-muted small text-center py-3">Aucune opportunité trouvée pour ce profil.</p>';
        }
        document.getElementById('matches-result').style.display = 'block';
        document.getElementById('matches-result').innerHTML = html;
    } else {
        showError(d.error);
    }
}

async function autoApply() {
    const id    = getCandidatureId(); if (!id) return;
    const titre = document.getElementById('offre-titre').value;
    const url   = document.getElementById('offre-url').value;
    if (!titre || !url) { alert('Remplissez le titre et l\'URL de l\'offre.'); return; }
    showLoading();
    const d = await callAPI(ROUTES.apply, { candidature_id: id, offre_titre: titre, offre_url: url });
    d.success ? showResult(JSON.stringify(d.result, null, 2)) : showError(d.error);
}
</script>
@endpush
