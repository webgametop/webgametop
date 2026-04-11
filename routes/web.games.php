<?php

declare(strict_types=1);

use App\Enums\GameProvider as GameProviderEnum;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'games', 'as' => 'games'], function () {
    Route::get('/', [GameController::class, 'showcase'])->name('.showcase');
    Route::get('/{provider}', [GameController::class, 'index'])->whereIn('provider', GameProviderEnum::cases());
}); # games
