<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // Assure-toi que c'est importé

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        // Maintenant Intelephense va reconnaître isSuperAdmin() sans broncher
        if (!$admin || !$admin->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')
                ->with('error', ' Accès réservé à l\'administrateur principal.');
        }

        return $next($request);
    }
}