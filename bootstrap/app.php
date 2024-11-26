<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'cashier' => \App\Http\Middleware\Cashier::class,
            'manager' => \App\Http\Middleware\Manager::class,
            'dataentry' => \App\Http\Middleware\DataEntry::class,
            'usercheck' => \App\Http\Middleware\UserAuthCheck::class,
        ]);
        
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
