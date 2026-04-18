@extends('admin.layout')

@section('title', 'Dashboard de ' . $candidat->prenom)
@section('page-title', 'Tableau de Bord Candidat')

@push('styles')
    <style>
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: minmax(150px, auto);
            gap: 20px;
        }
        .bento-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .bento-card:hover { transform: translateY(-5px); }
        .card-indigo { background: #1e1b4b; color: white; }
        .card-gold { background: linear-gradient(135deg, #f39c12, #e67e22); color: white; }
        
        .stat-value { font-size: 2.5rem; font-weight: 800; margin: 10px 0; }
        .label-caps { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">{{ $candidat->prenom }} {{ $candidat->nom }}</h2>
            <p class="text-muted">Candidat #{{ str_pad($candidat->id, 4, '0', STR_PAD_LEFT) }} • {{ $candidat->expertise }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.candidatures.show', $candidat->id) }}" class="btn btn-outline-dark rounded-pill px-4">
                <i class="bi bi-eye me-2"></i>Voir le Dossier
            </a>
            <a href="{{ route('admin.candidatures.pdf', $candidat->id) }}" class="btn btn-dark rounded-pill px-4">
                <i class="bi bi-download me-2"></i>PDF
            </a>
        </div>
    </div>

    <div class="bento-grid">
        <div class="bento-card card-gold col-span-1" style="grid-column: span 1;">
            <span class="label-caps">Score d'Adéquation IA</span>
            <div class="stat-value">{{ $candidat->note ? ($candidat->note * 20) : '--' }}%</div>
            <p class="small mb-0">Basé sur l'expertise {{ $candidat->niveau }}</p>
        </div>

        <div class="bento-card card-indigo" style="grid-column: span 1;">
            <span class="label-caps">Statut Actuel</span>
            <div class="mt-3">
                @if($candidat->statut === 'retenu')
                    <span class="badge bg-success p-2 w-100">Candidat Retenu</span>
                @elseif($candidat->statut === 'refuse')
                    <span class="badge bg-danger p-2 w-100">Candidature Refusée</span>
                @else
                    <span class="badge bg-warning text-dark p-2 w-100">En Attente</span>
                @endif
            </div>
            <p class="small mt-3 opacity-75">Dernière mise à jour : {{ $candidat->updated_at->format('d/m/Y') }}</p>
        </div>

        <div class="bento-card" style="grid-column: span 2;">
            <span class="label-caps text-muted">Contact & Localisation</span>
            <div class="mt-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-envelope me-3 text-warning"></i>
                    <span>{{ $candidat->email }}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-telephone me-3 text-warning"></i>
                    <span>{{ $candidat->telephone ?? 'Non renseigné' }}</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-geo-alt me-3 text-warning"></i>
                    <span>Lomé, {{ $candidat->pays }}</span>
                </div>
            </div>
        </div>

        <div class="bento-card" style="grid-column: span 3; grid-row: span 2;">
            <span class="label-caps text-muted">Aperçu de la Motivation</span>
            <hr>
            <p style="font-style: italic; color: #444; line-height: 1.8;">
                "{{ Str::limit($candidat->motivation, 600) }}"
            </p>
            <div class="mt-4">
                <h6 class="fw-bold">Compétences clés identifiées :</h6>
                <div class="d-flex gap-2 flex-wrap mt-2">
                    @foreach(explode(',', $candidat->expertise) as $skill)
                        <span class="badge border text-dark rounded-pill px-3">{{ trim($skill) }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bento-card text-center d-flex flex-column justify-content-center">
            <span class="label-caps text-muted">Évaluation Admin</span>
            <div class="display-4 fw-bold text-warning">{{ $candidat->note ?? '?' }}<span class="fs-5 text-muted">/5</span></div>
            <div class="mt-2 text-warning">
                @for($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star{{ $i <= $candidat->note ? '-fill' : '' }}"></i>
                @endfor
            </div>
        </div>

        <div class="bento-card {{ $candidat->finaliste ? 'bg-light border-warning' : '' }} text-center d-flex flex-column justify-content-center" style="border: 2px dashed #ddd;">
            @if($candidat->finaliste)
                <i class="bi bi-trophy-fill text-warning fs-1"></i>
                <span class="fw-bold text-warning mt-2">SÉLECTIONNÉ FINALISTE</span>
            @else
                <i class="bi bi-hourglass text-muted fs-1"></i>
                <span class="text-muted mt-2">En lice pour la finale</span>
            @endif
        </div>
    </div>
@endsection 