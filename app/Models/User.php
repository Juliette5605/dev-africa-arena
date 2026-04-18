<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}