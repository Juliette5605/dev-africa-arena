<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanManageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin || !$admin->canManage()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Accès refusé'], 403);
            }
            return back()->with('error', ' Action refusée. Vous êtes en mode lecture seule.');
        }

        return $next($request);
    }
}