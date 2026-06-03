<?php

declare(strict_types=1);

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'votes', 'as' => 'votes'], function () {
    Route::post('/', [VoteController::class, 'store'])->name('.store')->middleware('auth');
}); # votes
