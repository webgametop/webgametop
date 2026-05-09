<?php

declare(strict_types=1);

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'comments', 'as' => 'comments'], function () {
    Route::group(['prefix' => '/{comment}'], function () {
        Route::get('/', [CommentController::class, 'show'])->name('.show');
    }); # comment
    Route::post('/', [CommentController::class, 'store'])->name('.store')->middleware('auth');
}); # comments
