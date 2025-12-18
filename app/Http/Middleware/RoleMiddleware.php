<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole($role)) {
            abort(403);
        }

        return $next($request);
    }
}
