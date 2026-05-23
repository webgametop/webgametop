<?php

declare(strict_types=1);

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ratings', 'as' => 'ratings'], function () {
    Route::post('/', [RatingController::class, 'store'])->name('.store')->middleware('auth');
}); # ratings
