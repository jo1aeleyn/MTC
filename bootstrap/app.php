<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php', // Console commands routing
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Define global middleware here (if needed)
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Define exception handling here (if needed)
    })
    ->create();
