<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require_once __DIR__ . '/web.users.php';
});

Route::get('/', function () {
    $hasher = new \App\Services\DataHasherService;
    $algo = \App\Enums\HashingAlgo::MD5;

    dd(
        $hash = $hasher->hash('test'),
        $hasher->verify('test', $hash),

        $algo->isSecure(),
    );

    return view('welcome');

});
