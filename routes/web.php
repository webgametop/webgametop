<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require_once __DIR__ . '/web.users.php';
});

Route::get('/', function (
    \App\Services\Contracts\PasswordHasherInterface $passwordHasher,
    \App\Services\Contracts\DataHasherInterface $dataHasher
) {
    $algo = \App\Enums\HashingAlgo::MD5;

    dd(
        $hash = $passwordHasher->hash('test'),
        $passwordHasher->verify('test', $hash),

        $algo->isSecure(),
        $algo->getHexLength(),

        $dataHasher->hash('test'),
    );

    return view('welcome');

});
