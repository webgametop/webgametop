<?php

declare(strict_types=1);

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'favorites', 'as' => 'favorites'], function () {
    Route::post('/toggle', [FavoriteController::class, 'toggle'])->name('.toggle')->middleware('auth');
}); # favorites
