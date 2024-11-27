<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\BookOwnershipMiddleware;
use App\Http\Middleware\CourseOwnershipMiddleware;
use App\Http\Middleware\CustomMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware Aliases

        $middleware->alias([
            'custom' => CustomMiddleware::class,
            'authmiddleware' => AuthMiddleware::class,
            'courseownershipmiddleware' => CourseOwnershipMiddleware::class,
            'bookownershipmiddleware' => BookOwnershipMiddleware::class,
            'localMiddleware' => SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
