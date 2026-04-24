<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'domaine',
        'sous_domaine',
        'niveau',
        'type',
        'enonce',
        'contenu',
        'explication',
        'points',
    ];

    protected $casts = [
        'contenu' => 'array',
        'points' => 'integer',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class);
    }
}
