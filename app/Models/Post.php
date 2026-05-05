<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'type', 'content', 'title',
        'cover_image', 'tech_stack', 'project_url',
        'github_url', 'visibility',
        'likes_count', 'comments_count', 'shares_count', 'views_count',
    ];

    protected $casts = [
        'likes_count'    => 'integer',
        'comments_count' => 'integer',
        'shares_count'   => 'integer',
        'views_count'    => 'integer',
    ];

    // ── RELATIONS ──────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(PostMedia::class)->orderBy('order');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->latest();
    }

    public function allComments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    // ── HELPERS ────────────────────────────────────────────────────────────

    /** Vérifie si l'utilisateur connecté a liké ce post */
    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    /** Icône selon le type de post */
    public function typeIcon(): string
    {
        return match($this->type) {
            'article' => 'bi-journal-text',
            'project' => 'bi-code-slash',
            'image'   => 'bi-image',
            'video'   => 'bi-play-circle',
            default   => 'bi-chat-square-text',
        };
    }

    /** Badge couleur selon le type */
    public function typeBadge(): string
    {
        return match($this->type) {
            'article' => '#6366f1',
            'project' => '#f39c12',
            'image'   => '#10b981',
            'video'   => '#ef4444',
            default   => '#6b7280',
        };
    }

    /** Extrait court pour prévisualisation */
    public function excerpt(int $length = 200): string
    {
        return strlen($this->content) > $length
            ? substr($this->content, 0, $length) . '...'
            : $this->content;
    }

    /** Incrémenter les vues */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
