<?php

declare(strict_types=1);

namespace App\Services\Geolocation;

use App\Http\Integrations\IpInfo\IpInfoConnector;
use App\Services\Geolocation\Contracts\GeolocationService;

class IpLocateService implements GeolocationService
{
    public function __construct(
        private readonly IpInfoConnector $connector,
    )
    {
    }

    public function getCountryCodeFromIp(string $ip): ?string
    {
        // TODO: Implement getCountryCodeFromIp() method.
    }
}
