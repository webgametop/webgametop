<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetLeaderboardRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $app_id,
        public readonly string $name,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/leaderboard';
    }

    protected function defaultQuery(): array
    {
        return [
            'appId' => $this->app_id,
            'name' => $this->name,
        ];
    }
}
