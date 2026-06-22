<?php

declare(strict_types=1);

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require __DIR__ . '/api.views.php';
    require __DIR__ . '/api.votes.php';
});

Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('/me', [AuthController::class, 'me'])->name('api.me');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('api.refresh');
});
