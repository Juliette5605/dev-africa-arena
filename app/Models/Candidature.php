<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model {
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'email', 'age', 'niveau', 'pays', 'expertise',
        'diplome', 'motivation', 'vision', 'read_at',
        'note', 'commentaire_admin', 'finaliste', 'statut',
        'score_ia',   //  AJOUTÉ : Pour autoriser l'enregistrement du score
        'analyse_ia'  //  AJOUTÉ : Pour autoriser l'enregistrement de l'analyse
    ];

    protected $casts = [
        'age'       => 'integer',
        'read_at'   => 'datetime',
        'note'      => 'integer',
        'finaliste' => 'boolean',
        'score_ia'  => 'integer', //  AJOUTÉ : Pour traiter le score comme un nombre
    ];

    public function isRead(): bool  { return !is_null($this->read_at); }
    
    public function markAsRead(): void { 
        if (!$this->isRead()) $this->update(['read_at' => now()]); 
    }

    public function scopeUnread($q)     { return $q->whereNull('read_at'); }
    public function scopeFinalistes($q) { return $q->where('finaliste', true); }

    public function getStatutColorAttribute(): string {
        return match($this->statut) {
            'retenu'    => '#16a34a',
            'refuse'    => '#dc2626',
            default     => '#f39c12',
        };
    }

    public function getStatutLabelAttribute(): string {
        return match($this->statut) {
            'retenu'    => ' Retenu',
            'refuse'    => ' Refusé',
            default     => ' En attente',
        };
    }
}