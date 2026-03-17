<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::group(['prefix' => 'sign-up', 'as' => 'register'], function () {
            Route::get('/', [UserRegistrationController::class, 'create']);
            Route::post('/', [UserRegistrationController::class, 'store'])->name('.store');
        }); # sign-up
        Route::group(['prefix' => 'sign-in', 'as' => 'login'], function () {
            Route::get('/', [UserAuthenticatedController::class, 'create']);
            Route::post('/', [UserAuthenticatedController::class, 'store'])->name('.store');
        }); # sign-in
    }); # users
}); # guest
