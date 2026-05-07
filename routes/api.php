<?php

use App\Http\Controllers\API\GameVoteController;
use App\Http\Controllers\API\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api'], function () {
    Route::group(['prefix' => 'games', 'as' => '.games'], function () {
        Route::group(['prefix' => '/{game}'], function () {
            Route::group(['prefix' => 'votes', 'as' => '.votes'], function () {
                Route::post('/', [GameVoteController::class, 'store'])->name('.store');
            }); # votes
        }); # game
    }); # games
    Route::group(['prefix' => 'views', 'as' => '.views'], function () {
        Route::post('/', [ViewController::class, 'store'])->name('.store');
    }); # views
}); # V1
