<?php

declare(strict_types=1);

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'games', 'as' => 'games'], function () {
    Route::get('/', [GameController::class, 'index']);
}); # users
