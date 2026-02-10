<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // If request has driver token header, DO NOT TOUCH IT
        if ($request->headers->has('X-Driver-Token')) {
            return $next($request);
        }

        // If user is not authenticated, stop here
        if (! auth()->check()) {
            return response()->json([
                'message' => 'Unauthenticated',
            ], 401);
        }

        // If authenticated but not admin
        if (! auth()->user()->isAdmin()) {
            return response()->json([
                'message' => 'Unauthorized. Admin only.',
            ], 403);
        }

        return $next($request);
    }
}
