<?php

declare(strict_types=1);

use App\Enums\GameProvider as GameProviderEnum;
use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'developers', 'as' => 'developers'], function () {
    Route::get('/', [DeveloperController::class, 'showcase'])->name('.showcase');
    Route::get('/{provider}', [DeveloperController::class, 'index'])->whereIn('provider', GameProviderEnum::cases());
    Route::group(['prefix' => '{developer}'], function () {
        Route::get('/', [DeveloperController::class, 'redirect'])->name('.redirect');
        Route::group(['prefix' => '{slug}', 'middleware' => ['redirect.developerslug']], function () {
            Route::get('/', [DeveloperController::class, 'show'])->name('.show');
        });
    }); # developer
}); # developers
