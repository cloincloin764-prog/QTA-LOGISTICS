<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Driver;

class DriverTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-Driver-Token');

        if (! $token) {
            return response()->json([
                'message' => 'Driver token missing'
            ], 401);
        }

        $driver = Driver::where('api_token', $token)->first();

        if (! $driver || ! $driver->tokenIsValid($token)) {
            return response()->json([
                'message' => 'Invalid or expired token'
            ], 401);
        }

        // Attach driver to request (Laravel 11 way)
        $request->attributes->set('driver', $driver);

        return $next($request);
    }
}
