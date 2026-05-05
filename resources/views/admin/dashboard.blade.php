@php use Illuminate\Support\Str; @endphp
@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Tableau de Bord')

@push('styles')
    <style>
        /* ── VARIABLES & GLOBAL ── */
        :root {
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        /* ── CARTES PREMIUM ── */
        .stat-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover { transform: translateY(-5px); }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 16px;
        }

        .stat-value { font-size: 1.8rem; font-weight: 800; line-height: 1; }
        .stat-label { font-size: 0.85rem; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── COMPOSANTS SPÉCIFIQUES ── */
        .unread-dot {
            position: absolute; top: 20px; right: 20px;
            width: 10px; height: 10px; background: #ef4444;
            border-radius: 50%; box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
            animation: pulse 2s infinite;
        }

        .admin-table {
            background: #fff; border-radius: 24px; border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-sm); overflow: hidden;
        }

        .partner-row {
            padding: 18px; border-radius: 18px; transition: 0.2s;
            border: 1px solid transparent;
        }
        .partner-row:hover { background: #fff; border-color: var(--glass-border); transform: scale(1.02); }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(1.3); }
        }

        .chart-container { position: relative; height: 250px; width: 100%; }
    </style>
@endpush

@section('content')

    {{-- ── STAT CARDS ── --}}
    <div class="row g-4 mb-4">
        {{-- Candidatures --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                @if($stats['candidatures_unread'] > 0)<div class="unread-dot"></div>@endif
                <div class="stat-icon" style="background: linear-gradient(135deg, #fff3e0, #ffe0b2); color:#f39c12;">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-value text-dark">{{ $stats['candidatures'] }}</div>
                <div class="stat-label">Candidatures</div>
            </div>
        </div>
        {{-- Partenaires --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #e0f2fe, #bae6fd); color:#0284c7;">
                    <i class="bi bi-building"></i>
                </div>
                <div class="stat-value text-dark">{{ $stats['partenaires'] }}</div>
                <div class="stat-label">Partenaires</div>
            </div>
        </div>
        {{-- Messages --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                @if($stats['messages_unread'] > 0)<div class="unread-dot"></div>@endif
                <div class="stat-icon" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7); color:#16a34a;">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
                <div class="stat-value text-dark">{{ $stats['messages'] }}</div>
                <div class="stat-label">Messages</div>
            </div>
        </div>
        {{-- Abonnés --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #fdf4ff, #fae8ff); color:#9333ea;">
                    <i class="bi bi-envelope-fill"></i>
                </div>
                <div class="stat-value text-dark">{{ $stats['newsletters'] }}</div>
                <div class="stat-label">Abonnés</div>
            </div>
        </div>
    </div>

    {{-- ── GRAPHIQUES ── --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0 text-muted">CROISSANCE DES TALENTS</h6>
                    <span class="badge rounded-pill px-3 py-2" style="background:rgba(243,156,18,0.1); color:#f39c12;">
                        +{{ $stats['candidatures'] }} Total
                    </span>
                </div>
                <div class="chart-container">
                    <canvas id="chartCandidatures"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="stat-card h-100 d-flex flex-column justify-content-between">
                <h6 class="fw-bold mb-4 text-muted">RÉPARTITION PAR NIVEAU</h6>
                <div class="chart-container" style="height:200px;">
                    <canvas id="chartNiveaux"></canvas>
                </div>
                <div class="mt-4 d-flex justify-content-around text-center">
                    <div><div class="fw-bold" style="color:#f39c12;">{{ $stats['juniors'] }}</div><small>Jr</small></div>
                    <div><div class="fw-bold" style="color:#0284c7;">{{ $stats['intermediaires'] }}</div><small>Int</small></div>
                    <div><div class="fw-bold" style="color:#16a34a;">{{ $stats['seniors'] }}</div><small>Sr</small></div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── TABLEAUX ── --}}
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="stat-card h-100">
                <h6 class="fw-bold mb-4 text-muted">ÉCOSYSTÈME PARTENAIRES</h6>
                <div class="d-flex flex-column gap-3">
                    <div class="partner-row d-flex align-items-center justify-content-between shadow-sm" style="background:#fffaf0;">
                        <span class="fw-bold"><i class="bi bi-cash-stack me-2 text-warning"></i> Financiers</span>
                        <span class="badge bg-warning rounded-pill">{{ $stats['financiers'] }}</span>
                    </div>
                    <div class="partner-row d-flex align-items-center justify-content-between shadow-sm" style="background:#f0f9ff;">
                        <span class="fw-bold"><i class="bi bi-cpu me-2 text-info"></i> Techniques</span>
                        <span class="badge bg-info rounded-pill">{{ $stats['techniques'] }}</span>
                    </div>
                    <div class="partner-row d-flex align-items-center justify-content-between shadow-sm" style="background:#fdf4ff;">
                        <span class="fw-bold"><i class="bi bi-star-fill me-2 text-primary"></i> Sponsors</span>
                        <span class="badge bg-primary rounded-pill">{{ $stats['sponsors'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="admin-table">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light">
                    <h6 class="fw-bold mb-0">Dernières Activités Candidats</h6>
                    <a href="{{ route('admin.candidatures') }}" class="btn btn-sm btn-dark rounded-pill px-3">Voir tout</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-muted small uppercase">
                            <tr>
                                <th class="ps-4">Candidat</th>
                                <th>Niveau</th>
                                <th>Statut</th>
                                <th class="pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['recent_candidatures'] as $c)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $c->prenom }} {{ $c->nom }}</div>
                                        <div class="small text-muted">{{ $c->pays }}</div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border rounded-pill">{{ $c->niveau }}</span></td>
                                    <td>
                                        @if($c->isRead())
                                            <span class="badge bg-success-subtle text-success rounded-pill">Lu</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger rounded-pill">Nouveau</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-muted small">{{ $c->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-5 text-muted">En attente de nouveaux talents...</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        /* global Chart */
        /* eslint-disable */
        // ── Graphique LISSÉ (Area Chart) ──
        // @ts-ignore
        const weeklyData = @json($stats['weekly_candidatures'] ?? []);
        const labels = weeklyData.map(w => 'Sem ' + w.week);
        const values = weeklyData.map(w => w.total);

        const ctx = document.getElementById('chartCandidatures').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 250);
        gradient.addColorStop(0, 'rgba(243, 156, 18, 0.3)');
        gradient.addColorStop(1, 'rgba(243, 156, 18, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    data: values,
                    borderColor: '#f39c12',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false },
                    x: { grid: { display: false }, ticks: { color: '#bbb', font: { size: 10 } } }
                }
            }
        });

        // ── Donut LEVELS ──
        // @ts-ignore
        new Chart(document.getElementById('chartNiveaux'), {
            type: 'doughnut',
            data: {
                labels: ['Junior', 'Intermédiaire', 'Senior'],
                datasets: [{
                    // @ts-ignore
                    data: [{{ $stats['juniors'] }}, {{ $stats['intermediaires'] }}, {{ $stats['seniors'] }}],
                    backgroundColor: ['#f39c12', '#0284c7', '#16a34a'],
                    borderWidth: 5,
                    borderColor: '#fff',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '75%',
                plugins: { legend: { display: false } }
            }
        });
        /* eslint-enable */
    </script>
@endpush