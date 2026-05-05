@extends('layouts.app')

@section('title', 'Feed — DevAfrica Arena')

@push('styles')
<style>
/* ════════════════════════════════════════════════
   FEED — DevAfrica Arena
   Thème : dark pro, accents gold #f39c12
════════════════════════════════════════════════ */
.feed-root {
    min-height: 100vh;
    background: #0f0f0f;
    padding: 30px 0 80px;
}

/* ── GRID 3 COLONNES ────────────────────────── */
.feed-layout {
    display: grid;
    grid-template-columns: 260px 1fr 260px;
    gap: 22px;
    max-width: 1120px;
    margin: 0 auto;
    padding: 0 16px;
}
@media (max-width: 1024px) {
    .feed-layout { grid-template-columns: 1fr; }
    .feed-sidebar-left, .feed-sidebar-right { display: none; }
}

/* ── SIDEBARS ───────────────────────────────── */
.feed-sidebar-left, .feed-sidebar-right {
    position: sticky;
    top: 100px;
    height: fit-content;
}

/* ── CARTES SIDEBAR ─────────────────────────── */
.f-card {
    background: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 16px;
}
.f-card-header {
    padding: 18px 20px 12px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.f-card-title {
    font-size: 0.72rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.4);
}
.f-card-body { padding: 16px 20px; }

/* ── PROFIL CARD (sidebar gauche) ───────────── */
.profile-mini-cover {
    height: 60px;
    background: linear-gradient(135deg, #1a1a1a, #f39c12 200%);
}
.profile-mini-avatar {
    width: 56px; height: 56px;
    border-radius: 50%;
    border: 3px solid #0f0f0f;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 1.1rem; color: #fff;
    margin: -28px 0 0 16px;
    position: relative; z-index: 1;
    overflow: hidden;
}
.profile-mini-avatar img { width: 100%; height: 100%; object-fit: cover; }
.profile-mini-name {
    font-size: 0.92rem; font-weight: 800; color: #fff;
    margin: 10px 16px 2px;
}
.profile-mini-bio {
    font-size: 0.75rem; color: rgba(255,255,255,0.4);
    margin: 0 16px 14px;
    line-height: 1.4;
}
.profile-mini-stats {
    display: flex;
    border-top: 1px solid rgba(255,255,255,0.06);
}
.stat-cell {
    flex: 1; text-align: center;
    padding: 12px 8px;
    border-right: 1px solid rgba(255,255,255,0.06);
    cursor: pointer;
    transition: background 0.2s;
}
.stat-cell:last-child { border-right: none; }
.stat-cell:hover { background: rgba(255,255,255,0.03); }
.stat-num { font-size: 1rem; font-weight: 800; color: #f39c12; }
.stat-lbl { font-size: 0.65rem; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1px; }

/* ── SUGGESTIONS ────────────────────────────── */
.suggestion-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
}
.suggestion-item:last-child { border-bottom: none; }
.sug-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.8rem; color: #fff;
    flex-shrink: 0; overflow: hidden;
}
.sug-avatar img { width: 100%; height: 100%; object-fit: cover; }
.sug-info { flex: 1; min-width: 0; }
.sug-name { font-size: 0.82rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.sug-posts { font-size: 0.7rem; color: rgba(255,255,255,0.35); }
.btn-follow-sug {
    background: transparent;
    border: 1px solid rgba(243,156,18,0.4);
    color: #f39c12;
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.7rem;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
    white-space: nowrap;
}
.btn-follow-sug:hover { background: rgba(243,156,18,0.1); }

/* ── COMPOSER (écrire un post) ──────────────── */
.composer {
    background: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 20px;
    padding: 20px;
    margin-bottom: 20px;
}
.composer-top {
    display: flex; gap: 12px; align-items: flex-start;
}
.composer-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.88rem; color: #fff;
    flex-shrink: 0; overflow: hidden;
}
.composer-avatar img { width: 100%; height: 100%; object-fit: cover; }
.composer-input {
    flex: 1;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 25px;
    padding: 11px 18px;
    color: rgba(255,255,255,0.6);
    font-size: 0.88rem;
    cursor: pointer;
    transition: 0.2s;
}
.composer-input:hover {
    background: rgba(255,255,255,0.07);
    border-color: rgba(243,156,18,0.3);
}

.composer-actions {
    display: flex; gap: 6px;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,0.05);
    flex-wrap: wrap;
}
.composer-btn {
    display: flex; align-items: center; gap: 6px;
    padding: 8px 14px;
    border-radius: 10px;
    border: none;
    background: transparent;
    color: rgba(255,255,255,0.5);
    font-size: 0.78rem;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}
.composer-btn:hover { background: rgba(255,255,255,0.06); color: #fff; }
.composer-btn i { font-size: 1rem; }
.composer-btn.c-image:hover { color: #10b981; }
.composer-btn.c-video:hover { color: #ef4444; }
.composer-btn.c-article:hover { color: #6366f1; }
.composer-btn.c-project:hover { color: #f39c12; }

/* ── MODAL COMPOSER ─────────────────────────── */
.modal-composer {
    display: none;
    position: fixed; inset: 0; z-index: 8000;
    align-items: center; justify-content: center;
}
.modal-composer.open { display: flex; }
.mc-backdrop {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(6px);
}
.mc-card {
    position: relative; z-index: 1;
    background: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 24px;
    width: 100%; max-width: 580px;
    margin: 20px;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideUp 0.3s ease;
}
.mc-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.mc-title { font-size: 1rem; font-weight: 800; color: #fff; }
.mc-close {
    width: 32px; height: 32px; border-radius: 50%;
    background: rgba(255,255,255,0.08);
    border: none; color: rgba(255,255,255,0.5);
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    transition: 0.2s; font-size: 1.1rem;
}
.mc-close:hover { background: rgba(255,255,255,0.15); color: #fff; }
.mc-body { padding: 24px; }

/* Types de post */
.post-type-tabs {
    display: flex; gap: 6px; margin-bottom: 18px; flex-wrap: wrap;
}
.post-type-btn {
    padding: 7px 14px;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    background: transparent;
    color: rgba(255,255,255,0.4);
    font-size: 0.72rem; font-weight: 700;
    cursor: pointer; transition: 0.2s;
    display: flex; align-items: center; gap: 5px;
}
.post-type-btn.active {
    background: rgba(243,156,18,0.12);
    border-color: rgba(243,156,18,0.5);
    color: #f39c12;
}
.post-type-btn:hover:not(.active) { border-color: rgba(255,255,255,0.2); color: #fff; }

/* Champs form */
.mc-field { margin-bottom: 14px; }
.mc-label { font-size: 0.7rem; font-weight: 700; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 6px; display: block; }
.mc-input, .mc-textarea, .mc-select {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 12px 14px;
    color: #fff;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 0.88rem;
    outline: none;
    transition: 0.2s;
    resize: none;
}
.mc-input:focus, .mc-textarea:focus { border-color: #f39c12; background: rgba(243,156,18,0.04); }
.mc-textarea { min-height: 120px; }
.mc-input::placeholder, .mc-textarea::placeholder { color: rgba(255,255,255,0.2); }

/* Upload zone */
.upload-zone {
    border: 2px dashed rgba(255,255,255,0.1);
    border-radius: 14px;
    padding: 24px;
    text-align: center;
    cursor: pointer;
    transition: 0.2s;
}
.upload-zone:hover { border-color: rgba(243,156,18,0.4); background: rgba(243,156,18,0.03); }
.upload-zone i { font-size: 2rem; color: rgba(255,255,255,0.2); margin-bottom: 8px; display: block; }
.upload-zone p { font-size: 0.8rem; color: rgba(255,255,255,0.35); margin: 0; }

/* Preview médias */
.media-preview {
    display: flex; flex-wrap: wrap; gap: 8px; margin-top: 12px;
}
.media-thumb {
    width: 80px; height: 80px;
    border-radius: 10px; overflow: hidden;
    position: relative;
}
.media-thumb img, .media-thumb video {
    width: 100%; height: 100%; object-fit: cover;
}
.media-thumb-remove {
    position: absolute; top: 4px; right: 4px;
    width: 20px; height: 20px; border-radius: 50%;
    background: rgba(0,0,0,0.7);
    border: none; color: #fff; font-size: 0.7rem;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
}

/* Bouton publier */
.btn-publish {
    width: 100%;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: #fff; border: none;
    padding: 14px;
    border-radius: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 0.9rem; font-weight: 800;
    cursor: pointer; transition: 0.3s;
    margin-top: 18px;
    letter-spacing: 0.5px;
}
.btn-publish:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(243,156,18,0.3); }
.btn-publish:disabled { opacity: 0.5; transform: none; }

/* ── POSTS CARDS ────────────────────────────── */
.post-card {
    background: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 20px;
    margin-bottom: 16px;
    overflow: hidden;
    transition: border-color 0.2s;
}
.post-card:hover { border-color: rgba(255,255,255,0.1); }

.post-header {
    display: flex; align-items: flex-start;
    gap: 12px;
    padding: 18px 20px 14px;
}
.post-avatar {
    width: 44px; height: 44px; border-radius: 50%;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.9rem; color: #fff;
    flex-shrink: 0; overflow: hidden; cursor: pointer;
    text-decoration: none;
}
.post-avatar img { width: 100%; height: 100%; object-fit: cover; }
.post-meta { flex: 1; min-width: 0; }
.post-author {
    font-size: 0.88rem; font-weight: 800; color: #fff;
    text-decoration: none; display: block;
}
.post-author:hover { color: #f39c12; }
.post-time { font-size: 0.72rem; color: rgba(255,255,255,0.3); }

.post-type-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 20px;
    font-size: 0.65rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.8px;
    margin-left: 8px;
}

.post-menu-btn {
    background: none; border: none;
    color: rgba(255,255,255,0.3); font-size: 1.1rem;
    cursor: pointer; padding: 4px 8px; border-radius: 8px;
    transition: 0.2s;
}
.post-menu-btn:hover { background: rgba(255,255,255,0.06); color: #fff; }

/* Contenu post */
.post-title {
    font-size: 1.05rem; font-weight: 800; color: #fff;
    padding: 0 20px 8px; line-height: 1.3;
}
.post-content {
    padding: 0 20px 16px;
    font-size: 0.9rem; color: rgba(255,255,255,0.75);
    line-height: 1.65;
    white-space: pre-line;
}
.post-content.collapsed { max-height: 140px; overflow: hidden; position: relative; }
.post-content.collapsed::after {
    content: '';
    position: absolute; bottom: 0; left: 0; right: 0;
    height: 40px;
    background: linear-gradient(transparent, #1a1a1a);
}
.post-read-more {
    display: inline; margin-left: 4px;
    color: #f39c12; font-weight: 700; font-size: 0.82rem;
    cursor: pointer; background: none; border: none;
    padding: 0; font-family: inherit;
}
.post-read-more:hover { text-decoration: underline; }

/* Tech stack badge */
.tech-stack {
    padding: 0 20px 14px;
    display: flex; flex-wrap: wrap; gap: 6px;
}
.tech-badge {
    padding: 3px 10px;
    background: rgba(99,102,241,0.12);
    border: 1px solid rgba(99,102,241,0.25);
    border-radius: 20px;
    font-size: 0.7rem; font-weight: 700; color: #a5b4fc;
}

/* Liens projet */
.post-links {
    padding: 0 20px 16px;
    display: flex; gap: 10px; flex-wrap: wrap;
}
.post-link {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    color: rgba(255,255,255,0.6);
    font-size: 0.78rem; font-weight: 700;
    text-decoration: none;
    transition: 0.2s;
}
.post-link:hover { background: rgba(243,156,18,0.08); border-color: rgba(243,156,18,0.3); color: #f39c12; }

/* Médias */
.post-media { padding: 0 20px 16px; }
.media-grid {
    display: grid; gap: 4px; border-radius: 14px; overflow: hidden;
}
.media-grid.count-1 { grid-template-columns: 1fr; }
.media-grid.count-2 { grid-template-columns: 1fr 1fr; }
.media-grid.count-3 { grid-template-columns: 1fr 1fr; }
.media-grid.count-3 .media-item:first-child { grid-column: 1 / -1; }
.media-grid.count-4 { grid-template-columns: 1fr 1fr; }
.media-item {
    position: relative; overflow: hidden;
    background: #111;
}
.media-grid.count-1 .media-item { max-height: 400px; }
.media-grid:not(.count-1) .media-item { height: 200px; }
.media-item img, .media-item video {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.3s;
}
.media-item:hover img { transform: scale(1.02); }
.media-item video { cursor: pointer; }

/* Cover article */
.post-cover {
    width: 100%; max-height: 280px;
    object-fit: cover;
}

/* ── ACTIONS POST ────────────────────────────── */
.post-stats {
    display: flex; align-items: center;
    padding: 10px 20px;
    gap: 12px;
    border-top: 1px solid rgba(255,255,255,0.04);
}
.post-stat-pill {
    font-size: 0.72rem; color: rgba(255,255,255,0.3);
    cursor: pointer;
}
.post-stat-pill:hover { color: rgba(255,255,255,0.6); text-decoration: underline; }

.post-actions {
    display: flex;
    border-top: 1px solid rgba(255,255,255,0.04);
}
.post-action-btn {
    flex: 1;
    display: flex; align-items: center; justify-content: center; gap: 7px;
    padding: 12px 8px;
    background: none; border: none;
    color: rgba(255,255,255,0.4);
    font-size: 0.8rem; font-weight: 700;
    cursor: pointer; transition: 0.2s;
    border-right: 1px solid rgba(255,255,255,0.04);
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.post-action-btn:last-child { border-right: none; }
.post-action-btn:hover { background: rgba(255,255,255,0.04); }
.post-action-btn.liked { color: #f39c12; }
.post-action-btn.liked i { animation: likePoP 0.3s ease; }
@keyframes likePoP { 0% { transform: scale(1); } 50% { transform: scale(1.5); } 100% { transform: scale(1); } }
.post-action-btn i { font-size: 1rem; }
.post-action-btn:hover.like-btn { color: #f39c12; }
.post-action-btn:hover.comment-btn { color: #60a5fa; }
.post-action-btn:hover.share-btn { color: #34d399; }

/* ── COMMENTAIRES ────────────────────────────── */
.comments-section {
    padding: 0 20px 16px;
    display: none;
    border-top: 1px solid rgba(255,255,255,0.04);
    padding-top: 14px;
}
.comments-section.open { display: block; }

.comment-input-row {
    display: flex; gap: 10px; margin-bottom: 16px;
}
.comment-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 0.72rem; color: #fff;
    flex-shrink: 0; overflow: hidden;
}
.comment-avatar img { width: 100%; height: 100%; object-fit: cover; }
.comment-input-wrap { flex: 1; }
.comment-input {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 25px;
    padding: 9px 16px;
    color: #fff;
    font-size: 0.82rem;
    outline: none;
    transition: 0.2s;
    font-family: 'Plus Jakarta Sans', sans-serif;
}
.comment-input:focus { border-color: rgba(243,156,18,0.4); background: rgba(243,156,18,0.03); }
.comment-input::placeholder { color: rgba(255,255,255,0.2); }

.comment-item {
    display: flex; gap: 10px; margin-bottom: 12px;
}
.comment-content {
    flex: 1;
    background: rgba(255,255,255,0.04);
    border-radius: 14px; padding: 10px 14px;
}
.comment-author { font-size: 0.78rem; font-weight: 800; color: #fff; margin-bottom: 3px; }
.comment-text { font-size: 0.82rem; color: rgba(255,255,255,0.65); line-height: 1.5; }
.comment-time { font-size: 0.68rem; color: rgba(255,255,255,0.25); margin-top: 4px; }

/* ── TENDANCES (sidebar droite) ──────────────── */
.trend-item {
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    cursor: pointer;
    transition: 0.2s;
}
.trend-item:last-child { border-bottom: none; }
.trend-item:hover .trend-tag { color: #f39c12; }
.trend-label { font-size: 0.65rem; color: rgba(255,255,255,0.25); text-transform: uppercase; letter-spacing: 1px; }
.trend-tag { font-size: 0.85rem; font-weight: 800; color: #fff; margin: 2px 0; }
.trend-count { font-size: 0.7rem; color: rgba(255,255,255,0.3); }

/* ── PAGINATION ──────────────────────────────── */
.feed-pagination {
    display: flex; justify-content: center; gap: 8px;
    margin-top: 24px;
}
.page-btn {
    width: 38px; height: 38px;
    background: #1a1a1a;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px; color: rgba(255,255,255,0.5);
    font-size: 0.85rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: 0.2s; text-decoration: none;
}
.page-btn:hover, .page-btn.active {
    background: #f39c12; border-color: #f39c12; color: #fff;
}

/* ── EMPTY STATE ─────────────────────────────── */
.feed-empty {
    text-align: center; padding: 60px 20px;
}
.feed-empty i { font-size: 3.5rem; color: rgba(255,255,255,0.08); display: block; margin-bottom: 16px; }
.feed-empty h3 { font-size: 1.1rem; font-weight: 800; color: rgba(255,255,255,0.5); margin-bottom: 8px; }
.feed-empty p { font-size: 0.85rem; color: rgba(255,255,255,0.25); }

@keyframes slideUp {
    from { transform: translateY(30px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
}
</style>
@endpush

@section('content')
<div class="feed-root">
<div class="feed-layout">

    {{-- ═══ SIDEBAR GAUCHE — Profil ══════════════════════════════════════ --}}
    <aside class="feed-sidebar-left">
        <div class="f-card">
            <div class="profile-mini-cover"></div>
            <div class="profile-mini-avatar">
                @if(auth()->user()->avatarUrl())
                    <img src="{{ auth()->user()->avatarUrl() }}" alt="">
                @else
                    {{ auth()->user()->initials() }}
                @endif
            </div>
            <div class="profile-mini-name">{{ auth()->user()->fullName() }}</div>
            <div class="profile-mini-bio">{{ auth()->user()->bio ?? 'Talent numérique · DevAfrica Arena' }}</div>
            <div class="profile-mini-stats">
                <div class="stat-cell">
                    <div class="stat-num">{{ auth()->user()->posts()->count() }}</div>
                    <div class="stat-lbl">Posts</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-num">{{ auth()->user()->followersCount() }}</div>
                    <div class="stat-lbl">Followers</div>
                </div>
                <div class="stat-cell">
                    <div class="stat-num">{{ auth()->user()->followingCount() }}</div>
                    <div class="stat-lbl">Following</div>
                </div>
            </div>
        </div>

        <div class="f-card">
            <div class="f-card-header"><div class="f-card-title">Mes accès rapides</div></div>
            <div class="f-card-body">
                <div style="display:flex;flex-direction:column;gap:4px;">
                    <a href="{{ route('dashboard') }}" style="display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:10px;color:rgba(255,255,255,0.55);font-size:0.82rem;font-weight:600;text-decoration:none;transition:0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.55)'">
                        <i class="bi bi-grid" style="color:#f39c12;font-size:0.95rem;"></i> Dashboard
                    </a>
                    <a href="{{ route('quiz.play') }}" style="display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:10px;color:rgba(255,255,255,0.55);font-size:0.82rem;font-weight:600;text-decoration:none;transition:0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.55)'">
                        <i class="bi bi-lightning" style="color:#6366f1;font-size:0.95rem;"></i> Quiz Arena
                    </a>
                    <a href="{{ route('vote.leaderboard') }}" style="display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:10px;color:rgba(255,255,255,0.55);font-size:0.82rem;font-weight:600;text-decoration:none;transition:0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.55)'">
                        <i class="bi bi-trophy" style="color:#f59e0b;font-size:0.95rem;"></i> Votes
                    </a>
                </div>
            </div>
        </div>
    </aside>

    {{-- ═══ FEED PRINCIPAL ════════════════════════════════════════════════ --}}
    <main>

        {{-- COMPOSER --}}
        <div class="composer">
            <div class="composer-top">
                <div class="composer-avatar">
                    @if(auth()->user()->avatarUrl())
                        <img src="{{ auth()->user()->avatarUrl() }}" alt="">
                    @else
                        {{ auth()->user()->initials() }}
                    @endif
                </div>
                <div class="composer-input" onclick="openComposer('text')">
                    Partagez vos projets, articles ou réflexions...
                </div>
            </div>
            <div class="composer-actions">
                <button class="composer-btn c-image" onclick="openComposer('image')">
                    <i class="bi bi-image"></i> Photo
                </button>
                <button class="composer-btn c-video" onclick="openComposer('video')">
                    <i class="bi bi-camera-video"></i> Vidéo
                </button>
                <button class="composer-btn c-article" onclick="openComposer('article')">
                    <i class="bi bi-journal-text"></i> Article
                </button>
                <button class="composer-btn c-project" onclick="openComposer('project')">
                    <i class="bi bi-code-slash"></i> Projet
                </button>
            </div>
        </div>

        {{-- POSTS --}}
        @if($posts->count() === 0)
            <div class="f-card">
                <div class="feed-empty">
                    <i class="bi bi-broadcast"></i>
                    <h3>Votre fil est vide</h3>
                    <p>Publiez votre premier post ou suivez d'autres membres pour voir leurs publications.</p>
                </div>
            </div>
        @endif

        @foreach($posts as $post)
        <article class="post-card" data-post="{{ $post->id }}">

            {{-- Header --}}
            <div class="post-header">
                <a href="{{ route('feed.profile', $post->user) }}" class="post-avatar">
                    @if($post->user->avatarUrl())
                        <img src="{{ $post->user->avatarUrl() }}" alt="">
                    @else
                        {{ $post->user->initials() }}
                    @endif
                </a>
                <div class="post-meta">
                    <a href="{{ route('feed.profile', $post->user) }}" class="post-author">
                        {{ $post->user->fullName() }}
                        <span class="post-type-badge" style="background:{{ $post->typeBadge() }}20;color:{{ $post->typeBadge() }};border:1px solid {{ $post->typeBadge() }}40;">
                            <i class="bi {{ $post->typeIcon() }}" style="font-size:0.6rem;"></i>
                            {{ ucfirst($post->type) }}
                        </span>
                    </a>
                    <div class="post-time">{{ $post->created_at->diffForHumans() }}</div>
                </div>
                @if($post->user_id === auth()->id())
                <button class="post-menu-btn" onclick="deletePost({{ $post->id }}, this)" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
                @endif
            </div>

            {{-- Cover (articles) --}}
            @if($post->cover_image)
            <img src="{{ asset('storage/'.$post->cover_image) }}" class="post-cover" alt="{{ $post->title }}">
            @endif

            {{-- Titre (articles/projets) --}}
            @if($post->title)
            <div class="post-title">{{ $post->title }}</div>
            @endif

            {{-- Contenu --}}
            <div class="post-content {{ strlen($post->content) > 300 ? 'collapsed' : '' }}" id="content-{{ $post->id }}">{{ $post->content }}</div>
            @if(strlen($post->content) > 300)
            <div style="padding: 0 20px 10px;">
                <button class="post-read-more" onclick="expandPost({{ $post->id }})">Voir plus</button>
            </div>
            @endif

            {{-- Tech stack --}}
            @if($post->tech_stack)
            <div class="tech-stack">
                @foreach(explode(',', $post->tech_stack) as $tech)
                    <span class="tech-badge">{{ trim($tech) }}</span>
                @endforeach
            </div>
            @endif

            {{-- Liens projet --}}
            @if($post->project_url || $post->github_url)
            <div class="post-links">
                @if($post->project_url)
                <a href="{{ $post->project_url }}" target="_blank" class="post-link">
                    <i class="bi bi-box-arrow-up-right"></i> Voir le projet
                </a>
                @endif
                @if($post->github_url)
                <a href="{{ $post->github_url }}" target="_blank" class="post-link">
                    <i class="bi bi-github"></i> GitHub
                </a>
                @endif
            </div>
            @endif

            {{-- Médias --}}
            @if($post->media->count() > 0)
            <div class="post-media">
                <div class="media-grid count-{{ min($post->media->count(), 4) }}">
                    @foreach($post->media->take(4) as $media)
                    <div class="media-item">
                        @if($media->type === 'video')
                            <video src="{{ $media->url() }}" onclick="this.paused ? this.play() : this.pause()" muted loop></video>
                        @else
                            <img src="{{ $media->url() }}" alt="" loading="lazy">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Stats --}}
            @if($post->likes_count > 0 || $post->comments_count > 0)
            <div class="post-stats">
                @if($post->likes_count > 0)
                <span class="post-stat-pill">👍 {{ $post->likes_count }}</span>
                @endif
                @if($post->comments_count > 0)
                <span class="post-stat-pill ms-auto" onclick="toggleComments({{ $post->id }})">
                    {{ $post->comments_count }} commentaire{{ $post->comments_count > 1 ? 's' : '' }}
                </span>
                @endif
            </div>
            @endif

            {{-- Actions --}}
            <div class="post-actions">
                <button class="post-action-btn like-btn {{ $post->isLikedBy(auth()->user()) ? 'liked' : '' }}"
                        onclick="likePost({{ $post->id }}, this)">
                    <i class="bi bi-hand-thumbs-up{{ $post->isLikedBy(auth()->user()) ? '-fill' : '' }}"></i>
                    <span id="likes-{{ $post->id }}">J'aime</span>
                </button>
                <button class="post-action-btn comment-btn" onclick="toggleComments({{ $post->id }})">
                    <i class="bi bi-chat"></i> Commenter
                </button>
                <button class="post-action-btn share-btn" onclick="sharePost({{ $post->id }})">
                    <i class="bi bi-share"></i> Partager
                </button>
            </div>

            {{-- Zone commentaires --}}
            <div class="comments-section" id="comments-{{ $post->id }}">
                <div class="comment-input-row">
                    <div class="comment-avatar">
                        @if(auth()->user()->avatarUrl())
                            <img src="{{ auth()->user()->avatarUrl() }}" alt="">
                        @else
                            {{ auth()->user()->initials() }}
                        @endif
                    </div>
                    <div class="comment-input-wrap">
                        <input type="text" class="comment-input" placeholder="Écrire un commentaire..."
                               onkeydown="if(event.key==='Enter')submitComment({{ $post->id }}, this)">
                    </div>
                </div>
                <div id="comments-list-{{ $post->id }}">
                    @foreach($post->comments->take(3) as $comment)
                    <div class="comment-item">
                        <div class="comment-avatar">
                            @if($comment->user->avatarUrl())
                                <img src="{{ $comment->user->avatarUrl() }}" alt="">
                            @else
                                {{ $comment->user->initials() }}
                            @endif
                        </div>
                        <div class="comment-content">
                            <div class="comment-author">{{ $comment->user->fullName() }}</div>
                            <div class="comment-text">{{ $comment->content }}</div>
                            <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </article>
        @endforeach

        {{-- Pagination --}}
        @if($posts->hasPages())
        <div class="feed-pagination">
            @if($posts->onFirstPage())
                <span class="page-btn" style="opacity:0.3;cursor:default;"><i class="bi bi-chevron-left"></i></span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" class="page-btn"><i class="bi bi-chevron-left"></i></a>
            @endif

            @for($i = 1; $i <= $posts->lastPage(); $i++)
                <a href="{{ $posts->url($i) }}" class="page-btn {{ $posts->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
            @endfor

            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" class="page-btn"><i class="bi bi-chevron-right"></i></a>
            @else
                <span class="page-btn" style="opacity:0.3;cursor:default;"><i class="bi bi-chevron-right"></i></span>
            @endif
        </div>
        @endif

    </main>

    {{-- ═══ SIDEBAR DROITE — Suggestions + Tendances ══════════════════════ --}}
    <aside class="feed-sidebar-right">
        @if($suggestions->count() > 0)
        <div class="f-card">
            <div class="f-card-header"><div class="f-card-title">À suivre</div></div>
            <div class="f-card-body">
                @foreach($suggestions as $sug)
                <div class="suggestion-item">
                    <div class="sug-avatar">
                        @if($sug->avatarUrl())
                            <img src="{{ $sug->avatarUrl() }}" alt="">
                        @else
                            {{ $sug->initials() }}
                        @endif
                    </div>
                    <div class="sug-info">
                        <div class="sug-name">{{ $sug->fullName() }}</div>
                        <div class="sug-posts">{{ $sug->posts_count }} post{{ $sug->posts_count > 1 ? 's' : '' }}</div>
                    </div>
                    <button class="btn-follow-sug" onclick="followUser({{ $sug->id }}, this)">
                        + Suivre
                    </button>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="f-card">
            <div class="f-card-header"><div class="f-card-title">Tendances Tech</div></div>
            <div class="f-card-body">
                @foreach([['#Laravel','142 posts'],['#ReactJS','98 posts'],['#IA','210 posts'],['#DevAfrica','76 posts'],['#Cybersécurité','54 posts']] as [$tag, $count])
                <div class="trend-item">
                    <div class="trend-label">Technologie</div>
                    <div class="trend-tag">{{ $tag }}</div>
                    <div class="trend-count">{{ $count }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="f-card" style="background:linear-gradient(135deg,#1a1a1a,rgba(243,156,18,0.06));border-color:rgba(243,156,18,0.15);">
            <div class="f-card-body" style="text-align:center;padding:20px;">
                <i class="bi bi-trophy-fill" style="font-size:1.8rem;color:#f39c12;margin-bottom:10px;display:block;"></i>
                <div style="font-size:0.85rem;font-weight:800;color:#fff;margin-bottom:6px;">DevAfrica Arena</div>
                <div style="font-size:0.75rem;color:rgba(255,255,255,0.4);margin-bottom:14px;">Edition #1 · Sept. 2026 · Lomé</div>
                <a href="{{ route('criteres') }}" style="display:block;background:linear-gradient(135deg,#f39c12,#e67e22);color:#fff;padding:10px;border-radius:12px;font-size:0.8rem;font-weight:800;text-decoration:none;transition:0.2s;">
                    Candidater maintenant
                </a>
            </div>
        </div>
    </aside>

</div>{{-- /feed-layout --}}
</div>{{-- /feed-root --}}

{{-- ═══════════════ MODAL COMPOSER ═══════════════════════════════════════ --}}
<div class="modal-composer" id="modalComposer">
    <div class="mc-backdrop" onclick="closeComposer()"></div>
    <div class="mc-card">
        <div class="mc-header">
            <div class="mc-title">Nouvelle publication</div>
            <button class="mc-close" onclick="closeComposer()"><i class="bi bi-x"></i></button>
        </div>
        <div class="mc-body">
            <form action="{{ route('feed.store') }}" method="POST" enctype="multipart/form-data" id="feedForm">
                @csrf
                <input type="hidden" name="type" id="postType" value="text">

                {{-- Sélecteur de type --}}
                <div class="post-type-tabs">
                    <button type="button" class="post-type-btn active" data-type="text" onclick="selectType('text', this)">
                        <i class="bi bi-chat-square-text"></i> Texte
                    </button>
                    <button type="button" class="post-type-btn" data-type="image" onclick="selectType('image', this)">
                        <i class="bi bi-image"></i> Photo
                    </button>
                    <button type="button" class="post-type-btn" data-type="video" onclick="selectType('video', this)">
                        <i class="bi bi-camera-video"></i> Vidéo
                    </button>
                    <button type="button" class="post-type-btn" data-type="article" onclick="selectType('article', this)">
                        <i class="bi bi-journal-text"></i> Article
                    </button>
                    <button type="button" class="post-type-btn" data-type="project" onclick="selectType('project', this)">
                        <i class="bi bi-code-slash"></i> Projet
                    </button>
                </div>

                {{-- Titre (article/projet) --}}
                <div class="mc-field" id="field-title" style="display:none;">
                    <label class="mc-label">Titre</label>
                    <input type="text" name="title" class="mc-input" placeholder="Titre de votre article ou projet">
                </div>

                {{-- Contenu --}}
                <div class="mc-field">
                    <label class="mc-label">Contenu</label>
                    <textarea name="content" class="mc-textarea" placeholder="Partagez vos idées, projets, découvertes..." required id="postContent"></textarea>
                </div>

                {{-- Upload médias --}}
                <div class="mc-field" id="field-media" style="display:none;">
                    <label class="mc-label">Médias</label>
                    <div class="upload-zone" onclick="document.getElementById('mediaInput').click()">
                        <i class="bi bi-cloud-upload"></i>
                        <p>Cliquez pour sélectionner des images ou vidéos</p>
                        <p style="font-size:0.72rem;margin-top:4px;opacity:0.7;">JPG, PNG, GIF, WebP, MP4 · Max 50MB</p>
                    </div>
                    <input type="file" id="mediaInput" name="media[]" multiple accept="image/*,video/*" style="display:none" onchange="previewMedia(this)">
                    <div class="media-preview" id="mediaPreview"></div>
                </div>

                {{-- Cover image article --}}
                <div class="mc-field" id="field-cover" style="display:none;">
                    <label class="mc-label">Image de couverture</label>
                    <div class="upload-zone" onclick="document.getElementById('coverInput').click()">
                        <i class="bi bi-image"></i>
                        <p>Ajouter une image de couverture</p>
                    </div>
                    <input type="file" id="coverInput" name="cover_image" accept="image/*" style="display:none" onchange="previewCover(this)">
                    <div id="coverPreview"></div>
                </div>

                {{-- Tech stack --}}
                <div class="mc-field" id="field-tech" style="display:none;">
                    <label class="mc-label">Stack technique</label>
                    <input type="text" name="tech_stack" class="mc-input" placeholder="Laravel, React, TailwindCSS (séparés par des virgules)">
                </div>

                {{-- Liens projet --}}
                <div id="field-links" style="display:none;">
                    <div class="mc-field">
                        <label class="mc-label">URL du projet</label>
                        <input type="url" name="project_url" class="mc-input" placeholder="https://mon-projet.com">
                    </div>
                    <div class="mc-field">
                        <label class="mc-label">GitHub</label>
                        <input type="url" name="github_url" class="mc-input" placeholder="https://github.com/...">
                    </div>
                </div>

                {{-- Visibilité --}}
                <div class="mc-field">
                    <label class="mc-label">Visibilité</label>
                    <select name="visibility" class="mc-input mc-select">
                        <option value="public">🌍 Public — Tout le monde</option>
                        <option value="members">🔒 Membres — Candidats uniquement</option>
                    </select>
                </div>

                <button type="submit" class="btn-publish" id="btnPublish">
                    <i class="bi bi-send me-2"></i> Publier
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── MODAL COMPOSER ─────────────────────────────────────────────────
function openComposer(type) {
    document.getElementById('modalComposer').classList.add('open');
    document.body.style.overflow = 'hidden';
    selectType(type, document.querySelector(`.post-type-btn[data-type="${type}"]`));
}
function closeComposer() {
    document.getElementById('modalComposer').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeComposer(); });

function selectType(type, btn) {
    // Onglets
    document.querySelectorAll('.post-type-btn').forEach(b => b.classList.remove('active'));
    if (btn) btn.classList.add('active');
    document.getElementById('postType').value = type;

    // Champs conditionnels
    document.getElementById('field-title').style.display   = ['article','project'].includes(type) ? 'block' : 'none';
    document.getElementById('field-media').style.display   = ['image','video'].includes(type) ? 'block' : 'none';
    document.getElementById('field-cover').style.display   = type === 'article' ? 'block' : 'none';
    document.getElementById('field-tech').style.display    = type === 'project' ? 'block' : 'none';
    document.getElementById('field-links').style.display   = type === 'project' ? 'block' : 'none';

    // Placeholder textarea
    const placeholders = {
        text: 'Partagez vos idées, découvertes, réflexions...',
        image: 'Décrivez cette photo...',
        video: 'Décrivez cette vidéo...',
        article: 'Rédigez votre article...',
        project: 'Décrivez votre projet, les challenges rencontrés, ce que vous avez appris...',
    };
    document.getElementById('postContent').placeholder = placeholders[type] || '';
}

// ── PREVIEW MÉDIAS ──────────────────────────────────────────────────
function previewMedia(input) {
    const preview = document.getElementById('mediaPreview');
    preview.innerHTML = '';
    Array.from(input.files).slice(0, 4).forEach((file, i) => {
        const url = URL.createObjectURL(file);
        const thumb = document.createElement('div');
        thumb.className = 'media-thumb';
        thumb.innerHTML = file.type.startsWith('video/')
            ? `<video src="${url}" muted></video>`
            : `<img src="${url}" alt="">`;
        thumb.innerHTML += `<button class="media-thumb-remove" onclick="removeMedia(${i})"><i class="bi bi-x"></i></button>`;
        preview.appendChild(thumb);
    });
}
function previewCover(input) {
    if (!input.files[0]) return;
    const url = URL.createObjectURL(input.files[0]);
    document.getElementById('coverPreview').innerHTML = `<img src="${url}" style="width:100%;border-radius:10px;margin-top:8px;max-height:180px;object-fit:cover;">`;
}

// ── LIKE ─────────────────────────────────────────────────────────────
async function likePost(postId, btn) {
    try {
        const res = await fetch(`/feed/${postId}/like`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
        });
        const data = await res.json();
        btn.classList.toggle('liked', data.liked);
        const icon = btn.querySelector('i');
        icon.className = data.liked ? 'bi bi-hand-thumbs-up-fill' : 'bi bi-hand-thumbs-up';
    } catch(e) { console.error(e); }
}

// ── COMMENTAIRES ──────────────────────────────────────────────────────
function toggleComments(postId) {
    const section = document.getElementById(`comments-${postId}`);
    section.classList.toggle('open');
    if (section.classList.contains('open')) {
        section.querySelector('.comment-input')?.focus();
    }
}

async function submitComment(postId, input) {
    const content = input.value.trim();
    if (!content) return;
    try {
        const res = await fetch(`/feed/${postId}/comment`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
            body: JSON.stringify({ content }),
        });
        const data = await res.json();
        if (data.success) {
            const c = data.comment;
            const list = document.getElementById(`comments-list-${postId}`);
            const el = document.createElement('div');
            el.className = 'comment-item';
            el.innerHTML = `
                <div class="comment-avatar">${c.avatar_url ? `<img src="${c.avatar_url}">` : c.user_init}</div>
                <div class="comment-content">
                    <div class="comment-author">${c.user_name}</div>
                    <div class="comment-text">${c.content}</div>
                    <div class="comment-time">${c.created_at}</div>
                </div>`;
            list.prepend(el);
            input.value = '';
        }
    } catch(e) { console.error(e); }
}

// ── SUIVRE UN UTILISATEUR ─────────────────────────────────────────────
async function followUser(userId, btn) {
    try {
        const res = await fetch(`/feed/follow/${userId}`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' },
        });
        const data = await res.json();
        btn.textContent = data.following ? '✓ Suivi' : '+ Suivre';
        btn.style.background = data.following ? 'rgba(243,156,18,0.15)' : 'transparent';
    } catch(e) { console.error(e); }
}

// ── SUPPRIMER UN POST ─────────────────────────────────────────────────
async function deletePost(postId, btn) {
    if (!confirm('Supprimer cette publication ?')) return;
    try {
        const res = await fetch(`/feed/${postId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': CSRF },
        });
        if (res.ok) {
            const card = btn.closest('.post-card');
            card.style.transition = '0.4s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(() => card.remove(), 400);
        }
    } catch(e) { console.error(e); }
}

// ── VOIR PLUS ─────────────────────────────────────────────────────────
function expandPost(postId) {
    const el = document.getElementById(`content-${postId}`);
    el.classList.remove('collapsed');
    el.nextElementSibling?.remove();
}

// ── PARTAGER ─────────────────────────────────────────────────────────
function sharePost(postId) {
    const url = window.location.origin + '/feed/post/' + postId;
    if (navigator.share) {
        navigator.share({ title: 'DevAfrica Arena', url });
    } else {
        navigator.clipboard.writeText(url).then(() => alert('Lien copié !'));
    }
}
</script>
@endpush
