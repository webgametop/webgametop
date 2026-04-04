<?php

declare(strict_types=1);

namespace App\Services\Geolocation;

use App\Http\Integrations\IpInfo\IpInfoConnector;
use App\Http\Integrations\IpInfo\Requests\GetLiteDataRequest;
use App\Services\Geolocation\Contracts\GeolocationService;
use App\Values\IpInfoLiteData;
use Illuminate\Support\Facades\Cache;

class IpInfoService implements GeolocationService
{
    public function __construct(
        private readonly IpInfoConnector $connector,
    )
    {
    }

    public static function used(): bool
    {
        return (bool) config('services.ipinfo.token');
    }

    public function getCountryCodeFromIp(string $ip): ?string
    {
        if (! static::used()) {
            return null;
        }

        return Cache::rememberForever(cache_key('IP to country code', $ip), function () use ($ip) {
            /** @var IpInfoLiteData $dto */
            $dto = $this->connector->send(new GetLiteDataRequest($ip))->dto();

            return $dto->bogon ? 'ZZ' : $dto->countryCode;
        });
    }
}
