@extends('admin.layout')
@section('title', 'Backup BDD')
@section('page-title', ' Backup Base de Donnees')

@section('content')
<div class="row g-4">
    <div class="col-lg-7">
        <div class="admin-card p-4 h-100">
            <h5 class="fw-bold mb-3">Sauvegarde de la base</h5>
            <p class="text-muted mb-4">
                Cette section a maintenant sa propre page. Le telechargement automatique de la base n'est pas encore branche,
                mais le menu "Backup BDD" ne renvoie plus vers le dashboard.
            </p>

            <div class="p-3 rounded-3 mb-3" style="background:#fff8eb;border:1px solid rgba(243,156,18,0.2);">
                <p class="fw-bold mb-1">Etat actuel</p>
                <p class="small text-muted mb-0">
                    Prepare pour accueillir une exportation SQL ou un dump automatise selon votre workflow serveur.
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.logs') }}" class="btn btn-outline-dark rounded-pill px-4">Voir les logs</a>
                <a href="{{ route('admin.settings') }}" class="btn btn-warning rounded-pill px-4">Parametres</a>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="admin-card p-4">
            <h6 class="fw-bold mb-3" style="color:#888;text-transform:uppercase;font-size:0.75rem;letter-spacing:1px;">
                Apercu des donnees
            </h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Candidatures</span>
                    <span class="fw-bold">{{ $stats['candidatures'] }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Messages</span>
                    <span class="fw-bold">{{ $stats['messages'] }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Partenaires</span>
                    <span class="fw-bold">{{ $stats['partenaires'] }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Newsletters</span>
                    <span class="fw-bold">{{ $stats['newsletters'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
