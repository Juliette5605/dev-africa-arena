<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = ['admin_id', 'admin_name', 'action', 'subject', 'subject_detail', 'ip'];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    // Helper statique pour loguer facilement
    public static function log(string $action, string $subject, string $detail = null): void
    {
        $admin = Auth::guard('admin')->user();
        static::create([
            'admin_id'       => $admin?->id,
            'admin_name'     => $admin?->name ?? 'Système',
            'action'         => $action,
            'subject'        => $subject,
            'subject_detail' => $detail,
            'ip'             => Request::ip(),
        ]);
    }
}
