<?php

use App\Http\Controllers\API\GameVoteController;
use App\Http\Controllers\API\UserViewCountController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api'], function () {
    Route::group(['prefix' => 'games', 'as' => '.games'], function () {
        Route::group(['prefix' => '/{game}'], function () {
            Route::group(['prefix' => '/votes', 'as' => '.votes'], function () {
                Route::post('/', [GameVoteController::class, 'store'])->name('.store');
            }); # votes
        }); # game
    }); # games
    Route::group(['prefix' => 'users', 'as' => '.users'], function () {
        Route::group(['prefix' => '/{user}'], function () {
            Route::post('/views/increment', UserViewCountController::class)->name('.views.increment');
        });
    }); # users
}); # V1
