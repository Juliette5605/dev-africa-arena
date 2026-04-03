<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable {
    use Notifiable;

    protected $guard = 'admin';
    protected $fillable = ['name', 'email', 'password', 'role', 'can_edit', 'created_by'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'can_edit'          => 'boolean', // Important pour le test true/false
    ];

    // ─── Helpers ──────────────────────────────────────────────
    public function isSuperAdmin(): bool { 
        return $this->role === 'super' || $this->role === 'super_admin'; 
    }

    public function isSubAdmin(): bool { 
        return $this->role === 'sub' || $this->role === 'admin'; 
    }

    // La méthode centrale pour la sécurité
    public function canManage(): bool {
        return $this->isSuperAdmin() || ($this->can_edit === true);
    }

    public function subAdmins() {
        return $this->hasMany(Admin::class, 'created_by');
    }
}