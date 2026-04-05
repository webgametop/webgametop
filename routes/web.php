<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    require __DIR__ . '/web.users.php';
});

Route::get('/', function (
    \App\Services\Security\PasswordHasherService $passwordHasher,
    \App\Services\Security\HasherService $hasher,
    \App\Services\Security\HmacHasherService $hmacHasher,
    \App\Services\Geolocation\IpInfoService $ipInfoService,
    \App\Services\GameProviders\YandexGameProvider $yandexGameProvider,
) {
    $algo = \App\Enums\HashingAlgo::MD5;
    $format = \App\Enums\HashingFormat::BINARY;

    $feed = $yandexGameProvider->getFeed();

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

        $feed
    );

    return view('welcome');

});
