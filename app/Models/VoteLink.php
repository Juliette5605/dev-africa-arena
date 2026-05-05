<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class VoteLink extends Model
{
    protected $fillable = ['candidature_id', 'slug', 'tiktok_url', 'is_active'];

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public static function generateSlug(string $nom, string $prenom): string
    {
        $base = Str::slug($prenom . '-' . $nom);
        $suffix = strtolower(Str::random(4));
        return $base . '-' . $suffix;
    }

    public function getPublicUrl(): string
    {
        return route('vote.profil', $this->slug);
    }
}
