<?php

use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Http\Middleware; // No es necesaria esta importación para este caso
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Exceptions\Exceptions;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        // Middleware globales (si los tienes) van aquí, por ejemplo:
        // $middleware->web(append: \App\Http\Middleware\AlgunMiddlewareGlobal::class); 
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('users:deactivate-expired')->dailyAt('00:00');
    })
    ->withExceptions(function ($exceptions) {
        //
    })->create();