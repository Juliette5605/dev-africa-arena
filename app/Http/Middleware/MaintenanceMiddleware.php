<?php
namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ne pas bloquer le panel admin
        if ($request->is('admin*') || $request->is('api*')) {
            return $next($request);
        }

        if (Setting::get('maintenance_mode') === '1') {
            $msg = Setting::get('maintenance_msg', 'Site en maintenance. Revenez bientôt !');
            return response()->view('errors.maintenance', ['message' => $msg], 503);
        }

        return $next($request);
    }
}
