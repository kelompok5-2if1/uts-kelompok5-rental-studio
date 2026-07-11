<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        $role = strtolower((string) ($user->role ?? 'admin'));
        $role = $role === '' ? 'admin' : $role;

        if (empty($roles) || in_array($role, array_map('strtolower', $roles), true)) {
            return $next($request);
        }

        abort(403);
    }
}
