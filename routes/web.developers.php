<?php

declare(strict_types=1);

use App\Enums\GameProvider as GameProviderEnum;
use App\Http\Controllers\DeveloperCommentController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DeveloperGameController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'developers', 'as' => 'developers'], function () {
    Route::get('/', [DeveloperController::class, 'showcase'])->name('.showcase');
    Route::get('/{provider}', [DeveloperController::class, 'index'])->whereIn('provider', GameProviderEnum::cases());
    Route::group(['prefix' => '{developer}'], function () {
        Route::get('/', [DeveloperController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '{slug}', 'middleware' => ['redirect.developerslug']], function () {
            Route::get('/', [DeveloperController::class, 'show'])->name('.show');
            Route::get('/games', [DeveloperGameController::class, 'index'])->name('.games');
            Route::group(['prefix' => 'comments', 'as' => '.comments'], function () {
                Route::get('/', [DeveloperCommentController::class, 'index']);
                Route::post('/', [DeveloperCommentController::class, 'store'])->name('.store');
            }); # comments
        });
    }); # developer
}); # developers
