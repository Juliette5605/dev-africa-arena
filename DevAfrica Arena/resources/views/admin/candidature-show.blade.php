@extends('admin.layout')
@section('title', 'Candidature #' . $candidature->id)
@section('page-title', ' Dossier candidat')

@push('styles')
    <style>
        .star-btn {
            font-size: 1.6rem;
            cursor: pointer;
            color: #ddd;
            transition: 0.2s;
            background: none;
            border: none;
            padding: 2px;
        }

        .star-btn:hover,
        .star-btn.active {
            color: #f39c12;
        }

        .info-field label {
            font-size: 0.72rem;
            text-transform: uppercase;
            color: #888;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }

        .info-field p {
            font-weight: 600;
            margin: 0;
            font-size: 0.95rem;
        }

        .text-block {
            background: #f8f9fa;
            border-left: 3px solid #f39c12;
            padding: 14px 18px;
            border-radius: 0 12px 12px 0;
            line-height: 1.7;
            font-size: 0.95rem;
        }
    </style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert rounded-4 fw-bold border-0 mb-4" style="background:rgba(22,163,74,0.1);color:#16a34a;">
            {{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ route('admin.candidatures') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Retour
        </a>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('admin.candidatures.pdf', $candidature) }}" class="btn fw-bold rounded-3 px-3 py-2"
                style="background:#222;color:white;font-size:0.85rem;" target="_blank">
                <i class="bi bi-file-pdf me-1"></i> Export PDF
            </a>
            @if(auth('admin')->user()?->canManage())
                <form action="{{ route('admin.candidatures.finaliste', $candidature) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn fw-bold rounded-3 px-3 py-2" style="background:{{ $candidature->finaliste ? 'rgba(220,38,38,0.1)' : 'rgba(243,156,18,0.1)' }};
                                   color:{{ $candidature->finaliste ? '#dc2626' : '#f39c12' }};font-size:0.85rem;">
                        {{ $candidature->finaliste ? '✕ Retirer des finalistes' : ' Ajouter aux finalistes' }}
                    </button>
                </form>
                <form action="{{ route('admin.candidatures.destroy', $candidature) }}" method="POST"
                    onsubmit="return confirm('Supprimer définitivement cette candidature ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn fw-bold rounded-3 px-3 py-2"
                        style="background:rgba(220,38,38,0.08);color:#dc2626;font-size:0.85rem;">
                        <i class="bi bi-trash3"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="row g-4">

        {{-- COLONNE GAUCHE — Profil --}}
        <div class="col-lg-4">

            {{-- Carte identité --}}
            <div class="stat-card text-center mb-4">
                <div
                    style="width:72px;height:72px;background:linear-gradient(135deg,#f39c12,#e67e22);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.9rem;color:white;font-weight:800;">
                    {{ strtoupper(substr($candidature->prenom, 0, 1)) }}
                </div>
                <h4 class="fw-bold mb-1">{{ $candidature->prenom }} {{ $candidature->nom }}</h4>
                <span
                    class="badge fw-bold rounded-pill px-3 py-2 mb-2 {{ $candidature->niveau === 'Junior' ? 'badge-junior' : ($candidature->niveau === 'Senior' ? 'badge-senior' : 'badge-inter') }}">
                    {{ $candidature->niveau }}
                </span>
                @if($candidature->finaliste)
                    <div><span class="badge fw-bold rounded-pill px-3 py-2 mt-1"
                            style="background:rgba(243,156,18,0.1);color:#f39c12;"> Finaliste</span></div>
                @endif
                <hr>
                <div class="d-flex justify-content-around mt-3">
                    <div class="text-center">
                        <div class="fw-bold">{{ $candidature->age }}</div>
                        <div class="small text-muted">Ans</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold">{{ $candidature->pays }}</div>
                        <div class="small text-muted">Pays</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold">{{ $candidature->created_at->format('d/m') }}</div>
                        <div class="small text-muted">Inscrit</div>
                    </div>
                </div>
                <hr>
                <div class="text-start px-2">
                    <div class="info-field mb-2"><label>Email</label>
                        <p class="small">{{ $candidature->email }}</p>
                    </div>
                    <div class="info-field mb-2"><label>Expertise</label>
                        <p>{{ $candidature->expertise }}</p>
                    </div>
                    <div class="info-field"><label>Diplôme</label>
                        <p>{{ $candidature->diplome }}</p>
                    </div>
                </div>
            </div>

            {{-- Statut actuel --}}
            <div class="stat-card mb-4 text-center p-3">
                <div class="fw-bold mb-1" style="font-size:1.2rem;">{{ $candidature->statut_label }}</div>
                <div class="small text-muted">Statut de la candidature</div>
                @if($candidature->note)
                    <div class="mt-2" style="color:#f39c12;font-size:1.3rem;">
                        @for($i = 1; $i <= 5; $i++){{ $i <= $candidature->note ? '★' : '☆' }}@endfor
                    </div>
                @endif
            </div>

            {{-- Historique --}}
            <div class="stat-card p-3">
                <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                    Historique</h6>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Soumis le</span>
                    <span class="small fw-bold">{{ $candidature->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <span class="text-muted small">Lu le</span>
                    <span class="small fw-bold">{{ $candidature->read_at?->format('d/m/Y H:i') ?? '—' }}</span>
                </div>
                <div class="d-flex justify-content-between py-2">
                    <span class="text-muted small">Référence</span>
                    <span class="small fw-bold">#{{ str_pad($candidature->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE — Contenu + Évaluation --}}
        <div class="col-lg-8">

            {{-- Motivation --}}
            <div class="stat-card mb-4">
                <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                     Motivation</h6>
                <div class="text-block">{{ $candidature->motivation }}</div>
            </div>

            {{-- Vision --}}
            <div class="stat-card mb-4">
                <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                     Vision Tech</h6>
                <div class="text-block">{{ $candidature->vision }}</div>
            </div>

            {{-- Évaluation admin --}}
            @if(auth('admin')->user()?->canManage())
                <div class="stat-card">
                    <h6 class="fw-bold mb-4" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">⭐
                        Évaluation admin</h6>
                    <form action="{{ route('admin.candidatures.noter', $candidature) }}" method="POST">
                        @csrf @method('PATCH')

                        {{-- Étoiles --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Note (1 à 5 étoiles)</label>
                            <div class="d-flex gap-1" id="stars-container">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="star-btn {{ $i <= ($candidature->note ?? 0) ? 'active' : '' }}"
                                        data-val="{{ $i }}" onclick="setNote({{ $i }})">★</button>
                                @endfor
                            </div>
                            <input type="hidden" name="note" id="note-input" value="{{ $candidature->note ?? '' }}" required>
                            @error('note')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        {{-- Statut --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Statut de la candidature</label>
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach(['en_attente' => ' En attente', 'retenu' => '✅ Retenu', 'refuse' => ' ❌ Refusé'] as $val => $label)
                                    <label class="d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-bold small"
                                        style="cursor:pointer;border:2px solid {{ $candidature->statut === $val ? '#f39c12' : '#eee' }};background:{{ $candidature->statut === $val ? '#fff8eb' : '#fff' }};">
                                        <input type="radio" name="statut" value="{{ $val }}" {{ $candidature->statut === $val ? 'checked' : '' }}>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                            @error('statut')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        {{-- Commentaire --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold small">Commentaire interne (visible uniquement dans
                                l'admin)</label>
                            <textarea name="commentaire_admin" class="form-control rounded-3 border-0 bg-light py-3" rows="4"
                                placeholder="Notes sur le candidat, points forts, questions à poser...">{{ old('commentaire_admin', $candidature->commentaire_admin) }}</textarea>
                        </div>

                        <button type="submit" class="btn fw-bold py-3 px-5 rounded-3"
                            style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
                            Enregistrer l'évaluation
                        </button>
                    </form>
                </div>
            @elseif($candidature->note)
                {{-- Lecture seule --}}
                <div class="stat-card p-4">
                    <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.72rem;letter-spacing:1px;">
                        Évaluation</h6>
                    <div style="color:#f39c12;font-size:1.4rem;">
                        @for($i = 1; $i <= 5; $i++){{ $i <= $candidature->note ? '★' : '☆' }}@endfor</div>
                    @if($candidature->commentaire_admin)
                        <div class="text-block mt-3">{{ $candidature->commentaire_admin }}</div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setNote(val) {
            document.getElementById('note-input').value = val;
            document.querySelectorAll('.star-btn').forEach((btn, i) => {
                btn.classList.toggle('active', i < val);
            });
        }
    </script>
@endpush