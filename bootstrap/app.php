<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Providers\AuthServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../app/Console/Commands',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
        $middleware->throttleApi();
    })
    ->withProviders([
        AuthServiceProvider::class,
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->view('errors.404', [], 404);
        });

        $exceptions->render(function (AccessDeniedHttpException $e) {
            return response()->view('errors.403', [], 403);
        });
    })
    ->create();
