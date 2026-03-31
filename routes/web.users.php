<?php

declare(strict_types=1);

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\AuthRegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
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

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::post('sign-out', [AuthLoginController::class, 'destroy'])->name('logout');
    });
}); # auth

Route::group(['prefix' => 'users', 'as' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::group(['prefix' => '{user:id}'], function () {
        Route::get('/', [UserProfileController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '{username}'], function () {
            Route::group(['as' => '.show'], function () {
                Route::get('/', [UserProfileController::class, 'show']);
            });
        }); # show
    }); # profile
});
