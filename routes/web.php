<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require_once __DIR__ . '/web.users.php';
});

Route::get('/', function (
    \App\Services\PasswordHasherService $passwordHasher,
    \App\Services\HasherService $hasher,
    \App\Services\HmacHasherService $hmacHasher,
) {
    $algo = \App\Enums\HashingAlgo::MD5;

    dd(
        $hash = $passwordHasher->hash('test'),
        $passwordHasher->verify('test', $hash),

        $algo->isSecure(),
        $algo->getHexLength(),

        $hash = $hasher->hash('test', $algo),
        $hasher->verify('test2', $hash, $algo) ,

        $hash = $hmacHasher->hash('test'),
        $hmacHasher->verify('test', $hash)
    );

    return view('welcome');

});
