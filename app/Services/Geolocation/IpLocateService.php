<?php

declare(strict_types=1);

namespace App\Services\Geolocation;

use App\Services\Geolocation\Contracts\GeolocationService;
use GuzzleHttp\ClientInterface;

class IpLocateService implements GeolocationService
{
    private const ENDPOINT = '/api/lookup/';

    public function __construct(
        private readonly ClientInterface $client,
    )
    {
    }

    public function locate(string $ip): array
    {
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \Exception("Invalid IP address: $ip");
        }

        $uri = env('IP_LOCATE_URL') . self::ENDPOINT . $ip;

        $response = $this->client->request('GET', $uri, [
            'headers' => ['Accept' => 'application/json'],
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            throw new \Exception("API returned status code: $statusCode");
        }

        /** @var array $data */
        $data = json_decode($response->getBody()->getContents(), true);
        if (! is_array($data)) {
            throw new \Exception("Invalid JSON response from API");
        }

        if (isset($data['error'])) {
            throw new \Exception("API error: {$data['error']}");
        }

        return $data;
    }
}
