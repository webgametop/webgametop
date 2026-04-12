<?php

use App\Http\Middleware\DeveloperEnsureCorrectRedirect;
use App\Http\Middleware\GameEnsureCorrectRedirect;
use App\Http\Middleware\UserEnsureCorrectRedirect;
use App\Http\Middleware\UserEnsureEditOnlySelfAccount;
use App\Http\Middleware\UserHeartbeat;
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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('web', UserHeartbeat::class);
        $middleware->alias([
            'redirect.developerslug' => DeveloperEnsureCorrectRedirect::class,
            'redirect.gameslug' => GameEnsureCorrectRedirect::class,
            'redirect.username' => UserEnsureCorrectRedirect::class,
            'access.edit' => UserEnsureEditOnlySelfAccount::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
