<?php
// ════════════════════════════════════════════════
// app/Models/PostMedia.php
// ════════════════════════════════════════════════
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMedia extends Model
{
    protected $fillable = ['post_id', 'type', 'path', 'thumbnail', 'order'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function url(): string
    {
        return asset('storage/' . $this->path);
    }
}
