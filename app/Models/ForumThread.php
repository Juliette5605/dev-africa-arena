<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'message',
        'categorie',
        'user_id',
        'vues',
        'est_epingle',
    ];

    protected $casts = [
        'vues' => 'integer',
        'est_epingle' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(ForumPost::class)->latest();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ForumPost::class);
    }
}
