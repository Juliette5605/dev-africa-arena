<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // Cette classe sera maintenant "utilisée"

class TeamWhitelistMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $teamEmails = explode(',', env('TEAM_EMAILS', ''));

        if (Auth::check()) {
            /** @var Admin $user */
            $user = Auth::user(); // On précise à l'éditeur que c'est un Admin

            if (in_array($user->email, $teamEmails)) {
                // Maintenant Intelephense reconnaîtra 'update' ou 'forceFill'
                if ($user->role !== 'admin') {
                    $user->update(['role' => 'admin']);
                }
            }
        }

        return $next($request);
    }
}