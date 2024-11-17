<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        'IsAdmin' => IsAdminMiddleware::class
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();