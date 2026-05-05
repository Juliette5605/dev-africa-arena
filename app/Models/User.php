<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'name', 'email',
        'password', 'birthday',
        'bio', 'avatar', 'headline', 'website',  // Champs profil public Feed
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'birthday'          => 'date',
    ];

    // ── RELATIONS EXISTANTES ───────────────────────────────────────────────

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class, 'email', 'email');
    }

    public function latestCandidature(): HasOne
    {
        return $this->hasOne(Candidature::class, 'email', 'email')->latestOfMany();
    }

    // ── RELATIONS FEED ─────────────────────────────────────────────────────

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    /** Personnes que cet utilisateur suit */
    public function followings(): HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    /** Personnes qui suivent cet utilisateur */
    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    // ── HELPERS ────────────────────────────────────────────────────────────

    /** Nom complet */
    public function fullName(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''))
            ?: ($this->name ?? 'Anonyme');
    }

    /** Initiales pour l'avatar */
    public function initials(): string
    {
        $parts = explode(' ', $this->fullName());
        return strtoupper(
            substr($parts[0] ?? 'A', 0, 1) .
            substr($parts[1] ?? '', 0, 1)
        );
    }

    /** URL avatar (ou null si pas d'avatar → on affiche les initiales) */
    public function avatarUrl(): ?string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : null;
    }

    /** Est-ce que l'utilisateur connecté suit ce profil ? */
    public function isFollowedBy(?User $user): bool
    {
        if (!$user) return false;
        return Follow::where('follower_id', $user->id)
                     ->where('following_id', $this->id)
                     ->exists();
    }

    /** Nombre de followers */
    public function followersCount(): int
    {
        return $this->followers()->count();
    }

    /** Nombre de personnes suivies */
    public function followingCount(): int
    {
        return $this->followings()->count();
    }
}
