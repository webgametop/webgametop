<?php

declare(strict_types=1);

use App\Enums\GameProvider as GameProviderEnum;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameVoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'games', 'as' => 'games'], function () {
    Route::get('/', [GameController::class, 'showcase'])->name('.showcase');
    Route::get('/{provider}', [GameController::class, 'index'])->whereIn('provider', GameProviderEnum::cases());
    Route::group(['prefix' => '{game}'], function () {
        Route::get('/', [GameController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '{slug}', 'middleware' => ['redirect.gameslug']], function () {
            Route::get('/', [GameController::class, 'show'])->name('.show');
            Route::group(['prefix' => 'votes', 'as' => '.votes', 'middleware' => ['auth']], function () {
                Route::get('/', [GameVoteController::class, 'index']);
                Route::post('/', [GameVoteController::class, 'store'])->name('.store');
            });
        }); # votes
    }); # game
}); # games
