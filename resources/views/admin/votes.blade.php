@extends('admin.layout')

@section('title', 'Gestion des votes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Système de vote</h4>
    <a href="{{ route('admin.votes.export') }}" class="btn btn-sm btn-outline-warning">
        Exporter CSV
    </a>
</div>

{{-- Stats globales --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card bg-dark border-secondary text-center p-3">
            <div style="font-size:24px;font-weight:700;color:#f39c12">{{ number_format($stats['total_points']) }}</div>
            <div class="text-secondary small">Total points</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border-secondary text-center p-3">
            <div style="font-size:24px;font-weight:700;color:#2ecc71">{{ number_format($stats['total_montant']) }} F</div>
            <div class="text-secondary small">Montant collecté</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border-secondary text-center p-3">
            <div style="font-size:24px;font-weight:700;color:#3498db">{{ $stats['total_votes'] }}</div>
            <div class="text-secondary small">Votes confirmés</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-dark border-secondary text-center p-3">
            <div style="font-size:14px;font-weight:600;color:#ccc;line-height:1.8">
                Public: <strong style="color:#f39c12">{{ $stats['votes_public'] }}</strong><br>
                Sponsor: <strong style="color:#f39c12">{{ $stats['votes_sponsor'] }}</strong><br>
                Jury: <strong style="color:#f39c12">{{ $stats['votes_jury'] }}</strong>
            </div>
        </div>
    </div>
</div>

{{-- Classement --}}
<div class="card bg-dark border-secondary mb-4">
    <div class="card-header border-secondary">
        <h6 class="mb-0">Classement des candidats</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-dark table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Candidat</th>
                    <th>Points</th>
                    <th>Votes</th>
                    <th>Lien de vote</th>
                    <th>TikTok</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classement as $i => $c)
                <tr>
                    <td>
                        @if($i === 0) 🥇
                        @elseif($i === 1) 🥈
                        @elseif($i === 2) 🥉
                        @else {{ $i + 1 }}
                        @endif
                    </td>
                    <td>
                        <strong>{{ $c->prenom ?? '' }} {{ $c->nom ?? $c->nomcomplet ?? '—' }}</strong>
                        <div class="text-secondary small">{{ $c->domaine ?? $c->expertise ?? '' }}</div>
                    </td>
                    <td><strong style="color:#f39c12">{{ number_format($c->total_points ?? 0) }}</strong></td>
                    <td>{{ $c->total_votes ?? 0 }}</td>
                    <td>
                        @if($c->voteLink)
                            <div class="d-flex align-items-center gap-2">
                                <code style="font-size:11px;color:#aaa">/vote/{{ $c->voteLink->slug }}</code>
                                <button class="btn btn-xs btn-outline-secondary" style="font-size:10px;padding:2px 8px"
                                    onclick="navigator.clipboard.writeText('{{ route('vote.profil', $c->voteLink->slug) }}')">
                                    Copier
                                </button>
                                <form method="POST" action="{{ route('admin.votes.toggle', $c->id) }}" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-xs {{ $c->voteLink->is_active ? 'btn-outline-danger' : 'btn-outline-success' }}" style="font-size:10px;padding:2px 8px">
                                        {{ $c->voteLink->is_active ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <form method="POST" action="{{ route('admin.votes.generate-link', $c->id) }}" class="d-flex gap-1">
                                @csrf
                                <input type="url" name="tiktok_url" class="form-control form-control-sm bg-dark text-white border-secondary" placeholder="TikTok URL (optionnel)" style="width:180px;font-size:12px">
                                <button type="submit" class="btn btn-sm btn-outline-warning" style="font-size:12px">
                                    Générer
                                </button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($c->voteLink?->tiktok_url)
                            <a href="{{ $c->voteLink->tiktok_url }}" target="_blank" class="text-info small">TikTok</a>
                        @else
                            <span class="text-secondary small">—</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.candidatures.show', $c->id) }}" class="btn btn-xs btn-outline-secondary" style="font-size:10px;padding:2px 8px">
                            Dossier
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-secondary py-4">Aucun candidat avec des votes pour l'instant.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Derniers votes --}}
<div class="card bg-dark border-secondary">
    <div class="card-header border-secondary">
        <h6 class="mb-0">Derniers votes reçus</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-dark table-hover mb-0 table-sm">
            <thead>
                <tr>
                    <th>Candidat</th>
                    <th>Votant</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Points</th>
                    <th>Méthode</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentVotes as $v)
                <tr>
                    <td>{{ $v->candidature->nom ?? '—' }}</td>
                    <td>
                        {{ $v->voter_name }}
                        @if($v->voter_email)
                            <div class="text-secondary small">{{ $v->voter_email }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $v->voter_type === 'jury' ? 'bg-danger' : ($v->voter_type === 'sponsor' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                            {{ $v->voter_type }}
                        </span>
                    </td>
                    <td>{{ number_format($v->amount) }} F</td>
                    <td style="color:#f39c12;font-weight:600">+{{ $v->points }}</td>
                    <td>{{ $v->payment_method === 'flooz' ? 'Flooz' : 'T-Money' }}</td>
                    <td class="text-secondary small">{{ $v->created_at->format('d/m H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
