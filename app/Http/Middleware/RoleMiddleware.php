<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        $user = Auth::user();

        if (! $user || $user->role !== $role) {
            abort(403, 'Accès non autorisé');
        }

        if ($user->is_active === false) {
            abort(403, 'Compte suspendu');
        }

        return $next($request);
    }
}
