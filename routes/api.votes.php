<?php

declare(strict_types=1);

use App\Http\Controllers\API\VoteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'votes', 'as' => 'api.votes'/*, 'middleware' => ['auth:sanctum']*/], function () {
    Route::post('/', [VoteController::class, 'store'])->name('.store');
}); # votes
