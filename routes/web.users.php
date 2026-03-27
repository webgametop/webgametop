<?php

declare(strict_types=1);

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AuthRegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up', 'as' => 'register'], function () {
            Route::get('/', [AuthRegisterController::class, 'create']);
            Route::post('/', [AuthRegisterController::class, 'store'])->name('.store');
        }); # sign-up
        Route::group(['prefix' => 'sign-in', 'as' => 'login'], function () {
            Route::get('/', [AuthLoginController::class, 'create']);
            Route::post('/', [AuthLoginController::class, 'store'])->name('.store');
        }); # sign-in
    }); # users
}); # guest
