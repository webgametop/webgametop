<?php

use App\Http\Controllers\API\GameVoteController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'api'], function () {
    Route::group(['prefix' => 'games', 'as' => '.games'], function () {
        Route::post('/{game}/votes', [GameVoteController::class, 'store'])->name('.votes.store');
    }); # games
}); # V1
