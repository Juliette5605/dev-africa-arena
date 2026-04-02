<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model {
    protected $fillable = ['nom', 'email', 'sujet', 'message', 'read_at'];
    protected $casts    = ['read_at' => 'datetime'];

    public function isRead(): bool  { return !is_null($this->read_at); }
    public function markAsRead(): void {
        if (!$this->isRead()) $this->update(['read_at' => now()]);
    }
    public function scopeUnread($q) { return $q->whereNull('read_at'); }
}
