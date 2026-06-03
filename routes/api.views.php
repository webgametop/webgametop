<?php

declare(strict_types=1);

use App\Http\Controllers\API\ViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'views', 'as' => 'api.views'/*, 'middleware' => ['auth:sanctum']*/], function () {
    Route::post('/', [ViewController::class, 'store'])->name('.store');
}); # views
