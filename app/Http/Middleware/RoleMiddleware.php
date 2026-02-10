<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- THIS WAS MISSING
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is logged in AND if their role is in the allowed list
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized access. You do not have the required role.');
        }

        return $next($request);
    }
}