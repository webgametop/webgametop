<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetLeaderboardsListRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $app_id,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/leaderboards_list';
    }

    protected function defaultQuery(): array
    {
        return [
            'appId' => $this->app_id,
        ];
    }
}
