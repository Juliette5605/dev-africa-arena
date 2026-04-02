@extends('admin.layout')
@section('title', "Logs d'activité")
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="fw-bold mb-1">Logs d'activité</h4>
        <p class="text-muted small mb-0">{{ $total }} entrée(s) au total — Historique des actions dans le panel.</p>
    </div>

    {{-- Nettoyage en masse --}}
    @if(auth('admin')->user()?->isSuperAdmin())
    <div class="dropdown">
        <button class="btn fw-bold rounded-3 px-4 py-2 dropdown-toggle"
                style="background:#f8f9fa;color:#555;font-size:0.85rem;"
                data-bs-toggle="dropdown">
            Nettoyer les logs
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-2">
            @foreach(['7'=>'Supprimer les logs de + de 7 jours','30'=>'Supprimer les logs de + de 30 jours','90'=>'Supprimer les logs de + de 90 jours','all'=>'Tout supprimer'] as $val=>$label)
            <li>
                <form action="{{ route('admin.logs.clear') }}" method="POST"
                      onsubmit="return confirm('{{ $label }} — Confirmer ?')">
                    @csrf
                    <input type="hidden" name="periode" value="{{ $val }}">
                    <button type="submit" class="dropdown-item rounded-2 py-2 small fw-bold {{ $val==='all'?'text-danger':'' }}">
                        {{ $label }}
                    </button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

{{-- Filtres --}}
<form method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <select name="action" class="form-select rounded-3 border-0 bg-light">
            <option value="">Toutes les actions</option>
            @foreach(['créé','supprimé','modifié','lu','exporté','activé','connecté','déconnecté','testé','envoyé','uploadé','noté','sauvegardé'] as $a)
                <option value="{{ $a }}" {{ request('action')===$a?'selected':'' }}>{{ ucfirst($a) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <select name="subject" class="form-select rounded-3 border-0 bg-light">
            <option value="">Tous les sujets</option>
            @foreach(['Candidature','Message','Partenaire','Édition','Admin','Candidatures CSV','Configuration SMTP','Newsletter','Média','Base de données'] as $s)
                <option value="{{ $s }}" {{ request('subject')===$s?'selected':'' }}>{{ $s }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn w-100 fw-bold rounded-3"
                style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;">
            Filtrer
        </button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('admin.logs') }}" class="btn w-100 btn-light fw-bold rounded-3">Reset</a>
    </div>
</form>

<div class="admin-table">
    <table class="table mb-0">
        <thead>
            <tr>
                <th style="width:150px;">Date / Heure</th>
                <th>Admin</th>
                <th>Action</th>
                <th>Sujet</th>
                <th>Détail</th>
                <th>IP</th>
                <th style="width:60px;"></th>
            </tr>
        </thead>
        <tbody>
        @forelse($logs as $log)
        <tr>
            <td class="text-muted small">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
            <td class="fw-bold small">{{ $log->admin_name ?? '—' }}</td>
            <td>
                @php
                    $colors = [
                        'supprimé'=>'#dc2626','créé'=>'#16a34a','exporté'=>'#0284c7',
                        'activé'=>'#9333ea','lu'=>'#6b7280','connecté'=>'#f39c12',
                        'déconnecté'=>'#f97316','modifié'=>'#0891b2','testé'=>'#0284c7',
                        'envoyé'=>'#16a34a','uploadé'=>'#6366f1','noté'=>'#f59e0b',
                        'sauvegardé'=>'#059669',
                    ];
                    $c = $colors[$log->action] ?? '#888';
                @endphp
                <span class="badge rounded-pill fw-bold px-3"
                      style="background:{{ $c }}18;color:{{ $c }};font-size:0.72rem;">
                    {{ $log->action }}
                </span>
            </td>
            <td class="small fw-bold">{{ $log->subject }}</td>
            <td class="text-muted small">{{ $log->subject_detail ?? '—' }}</td>
            <td class="text-muted small" style="font-family:monospace;">{{ $log->ip ?? '—' }}</td>
            <td>
                @if(auth('admin')->user()?->isSuperAdmin())
                <form action="{{ route('admin.logs.destroy', $log) }}" method="POST"
                      onsubmit="return confirm('Supprimer cette entrée ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm rounded-2 px-2 py-1"
                            style="background:rgba(220,38,38,0.07);color:#dc2626;font-size:0.75rem;border:none;">
                        Suppr.
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted py-5">Aucune activité enregistrée</td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if($logs->hasPages())
<div class="mt-4">{{ $logs->withQueryString()->links() }}</div>
@endif

@endsection
