<?php

declare(strict_types=1);

use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'developers', 'as' => 'developers'], function () {
    Route::get('/', [DeveloperController::class, 'index']);
}); # users
