<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DriverTokenMiddleware;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api([
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
                    'admin' => AdminMiddleware::class,
        ]);
    $middleware->alias([
        'admin'       => AdminMiddleware::class,
        'driver.token'=> DriverTokenMiddleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
                // ADD THIS PART TO REGISTER THE ROLE ALIAS

        
    ]);
    
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
