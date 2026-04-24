<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    // Ajoute ici tes nouveaux champs pour que Laravel les accepte
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'birthday', // La date de naissance
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthday' => 'date', // On dit à Laravel que c'est une date
    ];

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class, 'email', 'email');
    }

    public function latestCandidature(): HasOne
    {
        return $this->hasOne(Candidature::class, 'email', 'email')->latestOfMany();
    }
}
