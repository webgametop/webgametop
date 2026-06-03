<?php

declare(strict_types=1);

use App\Http\Controllers\API\GameVoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'games', 'as' => 'api.games'/*, 'middleware' => ['auth:sanctum']*/], function () {
    Route::group(['prefix' => '/{game}'], function () {
        Route::group(['prefix' => 'votes', 'as' => '.votes'], function () {
            Route::post('/', [GameVoteController::class, 'store'])->name('.store');
        }); # votes
    }); # entity
}); # games
