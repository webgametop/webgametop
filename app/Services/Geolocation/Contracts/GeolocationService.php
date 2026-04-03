<?php

declare(strict_types=1);

namespace App\Services\Geolocation\Contracts;

interface GeolocationService
{
    public function getCountryCodeFromIp(string $ip): ?string;
}
