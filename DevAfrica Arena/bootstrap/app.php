<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'       => \App\Http\Middleware\AdminMiddleware::class,
            'super_admin' => \App\Http\Middleware\SuperAdminMiddleware::class,
            'can_manage'  => \App\Http\Middleware\CanManageMiddleware::class,
            'maintenance' => \App\Http\Middleware\MaintenanceMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            if (!$request->expectsJson()) return response()->view('errors.404', [], 404);
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            if (!$request->expectsJson()) return response()->view('errors.403', [], 403);
        });
        $exceptions->render(function (\Exception $e, $request) {
            if (!$request->expectsJson() && app()->environment('production')) {
                return response()->view('errors.500', [], 500);
            }
        });
    })->create();
