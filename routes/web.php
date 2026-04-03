<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require __DIR__ . '/web.users.php';
});

Route::get('/', function (
    \App\Services\PasswordHasherService $passwordHasher,
    \App\Services\HasherService $hasher,
    \App\Services\HmacHasherService $hmacHasher,
    \App\Services\Geolocation\IpInfoService $ipInfoService,
) {
    $algo = \App\Enums\HashingAlgo::MD5;
    $format = \App\Enums\HashingFormat::BINARY;

    dd(
        $hash = $passwordHasher->hash('test'),
        $passwordHasher->verify('test', $hash),

        $algo->isSecure(),
        $algo->getHexLength(),

        $hash = $hasher->hash('test', $algo),
        $hasher->verify('test2', $hash, $algo) ,

        $hash = $hmacHasher->hash('test', $format),
        $hmacHasher->verify('test', $hash, $format),

        $ipInfoService->getCountryCodeFromIp('84.17.46.76'),
    );

    return view('welcome');

});
