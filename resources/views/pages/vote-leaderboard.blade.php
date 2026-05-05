@extends('layouts.app')

@section('title', 'Vote du public — DevAfrica Arena')

@push('styles')
<style>
.lb-hero {
    background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
    min-height: 100vh;
    padding: 60px 0 80px;
}
.lb-title {
    text-align: center;
    margin-bottom: 48px;
}
.lb-title h1 {
    font-size: 36px;
    font-weight: 800;
    color: #f39c12;
    margin: 0 0 8px;
    letter-spacing: -0.5px;
}
.lb-title p { color: #888; font-size: 15px; margin: 0; }
.lb-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
    max-width: 900px;
    margin: 0 auto;
}
.candidat-tile {
    background: #222;
    border: 1px solid rgba(243,156,18,0.15);
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.2s, border-color 0.2s;
    text-decoration: none;
    display: block;
}
.candidat-tile:hover {
    transform: translateY(-3px);
    border-color: rgba(243,156,18,0.5);
}
.tile-top {
    padding: 24px 20px 16px;
    text-align: center;
    position: relative;
}
.tile-rang {
    position: absolute;
    top: 12px;
    left: 12px;
    font-size: 11px;
    font-weight: 700;
    color: #f39c12;
    background: rgba(243,156,18,0.15);
    padding: 3px 8px;
    border-radius: 20px;
}
.tile-rang.gold   { background: rgba(243,156,18,0.3); color: #f39c12; }
.tile-rang.silver { background: rgba(192,192,192,0.2); color: #ccc; }
.tile-rang.bronze { background: rgba(205,127,50,0.2);  color: #cd7f32; }
.tile-photo {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    border: 3px solid rgba(243,156,18,0.4);
    object-fit: cover;
    margin: 0 auto 12px;
    display: block;
    background: #333;
}
.tile-placeholder {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    border: 3px solid rgba(243,156,18,0.4);
    background: rgba(243,156,18,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: 700;
    color: #f39c12;
    margin: 0 auto 12px;
}
.tile-name  { font-size: 15px; font-weight: 700; color: #fff; margin: 0 0 4px; }
.tile-projet { font-size: 12px; color: #888; margin: 0; }
.tile-bottom {
    border-top: 1px solid rgba(243,156,18,0.1);
    padding: 12px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.tile-pts { font-size: 18px; font-weight: 800; color: #f39c12; }
.tile-pts-lab { font-size: 10px; color: #666; }
.tile-vote-btn {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
}
.empty-state {
    text-align: center;
    color: #666;
    padding: 60px 20px;
    grid-column: 1 / -1;
}
.empty-state p { font-size: 16px; }
</style>
@endpush

@section('content')
<div class="lb-hero">
    <div class="container">
        <div class="lb-title">
            <h1>Classement des candidats</h1>
            <p>Votez pour votre candidat favori — les votes sont payants, chaque franc compte</p>
        </div>

        <div class="lb-grid">
            @forelse($candidats as $i => $candidat)
            @php
                $rang = $i + 1;
                $rangClass = $rang === 1 ? 'gold' : ($rang === 2 ? 'silver' : ($rang === 3 ? 'bronze' : ''));
                $pts = $candidat->total_points ?? 0;
                $slug = $candidat->voteLink->slug ?? null;
            @endphp
            @if($slug)
            <a href="{{ route('vote.profil', $slug) }}" class="candidat-tile">
                <div class="tile-top">
                    <span class="tile-rang {{ $rangClass }}">#{{ $rang }}</span>

                    @if($candidat->photo ?? false)
                        <img src="{{ asset('storage/' . $candidat->photo) }}" class="tile-photo" alt="">
                    @else
                        <div class="tile-placeholder">
                            {{ strtoupper(substr($candidat->prenom ?? $candidat->nom ?? 'C', 0, 1)) }}
                        </div>
                    @endif

                    <div class="tile-name">{{ $candidat->prenom ?? '' }} {{ $candidat->nom ?? $candidat->nomcomplet ?? 'Candidat' }}</div>
                    <div class="tile-projet">{{ $candidat->domaine ?? $candidat->expertise ?? '' }}</div>
                </div>
                <div class="tile-bottom">
                    <div>
                        <div class="tile-pts">{{ number_format($pts) }}</div>
                        <div class="tile-pts-lab">points</div>
                    </div>
                    <span class="tile-vote-btn">Voter</span>
                </div>
            </a>
            @endif
            @empty
            <div class="empty-state">
                <p>Les candidats apparaîtront ici dès l'ouverture des votes.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
