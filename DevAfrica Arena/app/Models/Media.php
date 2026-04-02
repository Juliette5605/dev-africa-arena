<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {
    protected $fillable = ['name','filename','path','type','size','category','uploaded_by'];

    public function uploader() { return $this->belongsTo(Admin::class, 'uploaded_by'); }

    public function getSizeFormattedAttribute(): string {
        if ($this->size < 1024) return $this->size.' B';
        if ($this->size < 1048576) return round($this->size/1024,1).' KB';
        return round($this->size/1048576,1).' MB';
    }

    public function getUrlAttribute(): string {
        return asset('storage/'.$this->path);
    }
}
