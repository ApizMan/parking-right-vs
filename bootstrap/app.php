<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\AuthWithExpiration as UserWithExpiration;
use App\Http\Middleware\Admin\AuthWithExpiration;
use App\Http\Middleware\Admin\RememberTokenExpiration;
use App\Http\Middleware\RememberTokenExpiration as UserRememberTokenExpiration;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php', // Include your API routes here
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('user_with_expiration', [
            UserWithExpiration::class,
            UserRememberTokenExpiration::class,
        ]);
        $middleware->group('admin_with_expiration', [
            AuthWithExpiration::class,
            RememberTokenExpiration::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
