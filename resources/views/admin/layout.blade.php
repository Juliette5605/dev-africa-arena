<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — DevAfricaArena</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root { --gold:#f39c12; --sidebar-w:260px; }
        *{box-sizing:border-box;}
        body { font-family:'Plus Jakarta Sans',sans-serif; background:#f5f5f7; margin:0; overflow-x:hidden; }

        /* SIDEBAR */
        .sidebar { position:fixed;left:0;top:0;height:100vh;width:var(--sidebar-w);background:#111;overflow:hidden;z-index:200;display:flex;flex-direction:column; }
        .sidebar-brand { padding:24px 20px 16px;border-bottom:1px solid rgba(255,255,255,0.05);position:sticky;top:0;background:#111;z-index:3; }
        .sidebar-brand h2 { color:#fff;font-size:1.1rem;font-weight:800;margin:0; }
        .sidebar-brand p { color:rgba(255,255,255,0.3);font-size:0.65rem;text-transform:uppercase;letter-spacing:2px;margin:4px 0 0; }
        .sidebar-search { padding:12px 15px;position:sticky;top:74px;background:#111;z-index:3; }
        .sidebar-search input { width:100%;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:8px 12px;color:#fff;font-size:0.8rem;font-family:inherit; }
        .sidebar-search input::placeholder{color:rgba(255,255,255,0.3);}
        .sidebar-search input:focus{outline:none;border-color:rgba(243,156,18,0.4);background:rgba(255,255,255,0.08);}
        .sidebar-scroll { flex:1; overflow-y:auto; overflow-x:hidden; padding-bottom:12px; }
        .sidebar-scroll::-webkit-scrollbar{width:4px;}
        .sidebar-scroll::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.1);border-radius:4px;}
        .sidebar-section { padding:12px 15px 4px; }
        .sidebar-label { font-size:0.62rem;font-weight:800;color:rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:2px;padding:0 8px 8px; }
        .sidebar-link { display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;color:rgba(255,255,255,0.55);font-size:0.82rem;font-weight:600;text-decoration:none;transition:0.2s;width:100%; }
        .sidebar-link i { font-size:0.95rem;width:18px;text-align:center;flex-shrink:0; }
        .sidebar-link:hover { background:rgba(255,255,255,0.06);color:#fff; }
        .sidebar-link.active { background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff; }
        .sidebar-badge { margin-left:auto;background:rgba(255,255,255,0.12);color:rgba(255,255,255,0.7);padding:2px 8px;border-radius:20px;font-size:0.65rem;font-weight:800; }
        .sidebar-link.active .sidebar-badge { background:rgba(255,255,255,0.2);color:#fff; }
        .sidebar-footer { margin-top:auto;padding:12px 15px 20px;border-top:1px solid rgba(255,255,255,0.05);position:sticky;bottom:0;background:#111;z-index:3; }

        /* MAIN */
        .main-content { margin-left:var(--sidebar-w);min-height:100vh; }
        .topbar { background:#fff;border-bottom:1px solid #eee;padding:16px 28px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:0 2px 10px rgba(0,0,0,0.04); }
        .topbar-title { font-weight:800;font-size:1.1rem; }
        .page-body { padding:28px; }

        /* CARDS */
        .stat-card { background:#fff;border-radius:18px;padding:24px;border:1px solid #eee;transition:0.3s; }
        .stat-card:hover { box-shadow:0 8px 24px rgba(0,0,0,0.06); }
        .stat-icon { width:46px;height:46px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:16px; }
        .stat-value { font-size:2rem;font-weight:800;line-height:1; }
        .stat-label { color:#888;font-size:0.8rem;margin-top:6px; }
        .admin-card { background:#fff;border-radius:18px;border:1px solid #eee; }
        .admin-table { background:#fff;border-radius:18px;border:1px solid #eee;overflow:hidden; }
        .admin-table .table { margin:0; }
        .admin-table .table th { font-size:0.72rem;text-transform:uppercase;letter-spacing:1px;color:#888;border-bottom:1px solid #f0f0f0;font-weight:800;padding:14px 16px; }
        .admin-table .table td { padding:14px 16px;vertical-align:middle;border-bottom:1px solid #f8f9fa;font-size:0.88rem; }
        .badge-junior { background:rgba(243,156,18,0.1);color:#f39c12; }
        .badge-senior { background:rgba(22,163,74,0.1);color:#16a34a; }
        .badge-inter  { background:rgba(2,132,199,0.1);color:#0284c7; }
        .alert-admin  { border-radius:12px;border:none;padding:14px 18px;font-size:0.88rem; }

        /* MAINTENANCE BANNER */
        @php $maintenanceOn = \App\Models\Setting::get('maintenance_mode') === '1'; @endphp
        @if($maintenanceOn ?? false)
        .maintenance-banner { background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;text-align:center;padding:10px;font-weight:700;font-size:0.85rem;position:sticky;top:0;z-index:300; }
        @endif

        @media(max-width:991px){.sidebar{transform:translateX(-100%);}.main-content{margin-left:0;}}
    </style>
    @stack('styles')
</head>
<body>

@php
    $unread_candidatures = \App\Models\Candidature::unread()->count();
    $unread_messages     = \App\Models\ContactMessage::unread()->count();
    $maintenanceOn       = \App\Models\Setting::get('maintenance_mode') === '1';
@endphp

@if($maintenanceOn)
<div style="background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;text-align:center;padding:8px;font-weight:700;font-size:0.82rem;position:fixed;top:0;left:0;right:0;z-index:999;">
    🚧 MODE MAINTENANCE ACTIF — Le site public est inaccessible pour les visiteurs.
    <a href="{{ route('admin.settings') }}" style="color:rgba(255,255,255,0.8);margin-left:8px;text-decoration:underline;">Désactiver →</a>
</div>
<div style="height:34px;"></div>
@endif

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <h2> DevAfricaArena</h2>
        <p>Admin Panel</p>
    </div>

    {{-- Recherche globale --}}
    <div class="sidebar-search">
        <form action="{{ route('admin.search') }}" method="GET">
            <input type="text" name="q" placeholder="🔍 Recherche globale..." value="{{ request('q') }}">
        </form>
    </div>

    <div class="sidebar-scroll">
        <div class="sidebar-section">
            <div class="sidebar-label">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-fill"></i> Dashboard
            </a>
            <a href="{{ route('admin.candidatures') }}" class="sidebar-link {{ request()->routeIs('admin.candidatures*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Candidatures
                @if($unread_candidatures > 0)
                    <span class="sidebar-badge" style="background:#ef4444;color:white;">{{ $unread_candidatures }} new</span>
                @else
                    <span class="sidebar-badge">{{ \App\Models\Candidature::count() }}</span>
                @endif
            </a>
            <a href="{{ route('admin.finalistes') }}" class="sidebar-link {{ request()->routeIs('admin.finalistes') ? 'active' : '' }}">
                <i class="bi bi-trophy-fill"></i> Finalistes
                <span class="sidebar-badge">{{ \App\Models\Candidature::where('finaliste',true)->count() }}/{{ \App\Models\Setting::get('nb_finalistes',6) }}</span>
            </a>
            <a href="{{ route('admin.partenaires') }}" class="sidebar-link {{ request()->routeIs('admin.partenaires*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Partenaires
                <span class="sidebar-badge">{{ \App\Models\Partenaire::count() }}</span>
            </a>
            <a href="{{ route('admin.messages') }}" class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots-fill"></i> Messages
                @if($unread_messages > 0)
                    <span class="sidebar-badge" style="background:#ef4444;color:white;">{{ $unread_messages }} new</span>
                @else
                    <span class="sidebar-badge">{{ \App\Models\ContactMessage::count() }}</span>
                @endif
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Événement</div>
            <a href="{{ route('admin.editions') }}" class="sidebar-link {{ request()->routeIs('admin.editions*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event-fill"></i> Éditions
            </a>
            <a href="{{ route('admin.newsletters') }}" class="sidebar-link {{ request()->routeIs('admin.newsletters*') ? 'active' : '' }}">
                <i class="bi bi-envelope-fill"></i> Newsletter
                <span class="sidebar-badge">{{ \App\Models\Newsletter::count() }}</span>
            </a>
            @if(auth('admin')->user()?->isSuperAdmin())
            <a href="{{ route('admin.newsletter.broadcast') }}" class="sidebar-link {{ request()->routeIs('admin.newsletter.broadcast*') ? 'active' : '' }}">
                <i class="bi bi-send-fill"></i> Envoyer newsletter
            </a>
            @endif
        </div>

        <div class="sidebar-section">
            <div class="sidebar-label">Outils</div>
            @if(auth('admin')->user()?->canManage())
            <a href="{{ route('admin.export.candidatures') }}" class="sidebar-link">
                <i class="bi bi-download"></i> Export CSV
            </a>
            <a href="{{ route('admin.backup.database') }}" class="sidebar-link">
                <i class="bi bi-database-fill-down"></i> Backup BDD
            </a>
            <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Médiathèque
            </a>
            @endif
            <a href="{{ route('admin.logs') }}" class="sidebar-link {{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Logs d'activité
            </a>
        <a href="{{ route('admin.devafricaarena') }}" class="sidebar-link {{ request()->routeIs('admin.devafricaarena*') ? 'active' : '' }}">
            DevAfricaArena
        </a>
            <a href="{{ route('admin.qrcode') }}" class="sidebar-link {{ request()->routeIs('admin.qrcode') ? 'active' : '' }}">
                <i class="bi bi-qr-code"></i> QR Code
            </a>
            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="bi bi-box-arrow-up-right"></i> Voir le site
            </a>
        </div>

        @if(auth('admin')->user()?->isSuperAdmin())
        <div class="sidebar-section">
            <div class="sidebar-label">Administration</div>
            <a href="{{ route('admin.admins.index') }}" class="sidebar-link {{ request()->routeIs('admin.admins*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock-fill"></i> Gérer les admins
                <span class="sidebar-badge">{{ \App\Models\Admin::where('role','sub')->count() }}/2</span>
            </a>
            <a href="{{ route('admin.smtp') }}" class="sidebar-link {{ request()->routeIs('admin.smtp*') ? 'active' : '' }}">
                <i class="bi bi-envelope-gear-fill"></i> Config. Email
            </a>
            <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="bi bi-gear-fill"></i> Paramètres
                @if($maintenanceOn)<span class="sidebar-badge" style="background:#ef4444;color:white;">🚧</span>@endif
            </a>
        </div>
        @endif
    </div>

    <div class="sidebar-footer">
        <div class="px-2 mb-3">
            @if(auth('admin')->user()?->isSuperAdmin())
                <span class="badge w-100 py-2 rounded-3 fw-bold" style="background:rgba(243,156,18,0.15);color:#f39c12;font-size:0.68rem;">
                    👑 Super Administrateur
                </span>
            @else
                <span class="badge w-100 py-2 rounded-3 fw-bold" style="background:rgba(107,114,128,0.15);color:#9ca3af;font-size:0.68rem;">
                    {{ auth('admin')->user()?->can_edit ? '✅ Délégation active' : '🔒 Lecture seule' }}
                </span>
            @endif
        </div>
        <a href="{{ route('admin.profile') }}" class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Mon profil
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="mt-1">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0" style="background:rgba(239,68,68,0.1);color:#ef4444;cursor:pointer;">
                <i class="bi bi-power"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="main-content">
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <div class="d-flex align-items-center gap-3">
            @if($unread_candidatures + $unread_messages > 0)
            <a href="{{ route('admin.candidatures', ['lu'=>'non']) }}" class="text-decoration-none">
                <span class="badge rounded-pill fw-bold px-3 py-2" style="background:rgba(239,68,68,0.1);color:#ef4444;">
                    <i class="bi bi-bell-fill me-1"></i>{{ $unread_candidatures + $unread_messages }} non lus
                </span>
            </a>
            @endif
            <span class="small text-muted d-none d-md-block">{{ auth('admin')->user()?->name }}</span>
        </div>
    </div>

    <div class="page-body">
        @if(session('success'))
            <div class="alert alert-success alert-admin mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-admin mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({duration:600,once:true});</script>
@stack('scripts')
</body>
</html>
