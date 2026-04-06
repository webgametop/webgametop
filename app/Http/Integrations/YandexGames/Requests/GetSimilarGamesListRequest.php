<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetSimilarGamesListRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly int $app_id,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/similar_games';
    }

    protected function defaultQuery(): array
    {
        return [
            'app_id' => $this->app_id,
            'format' => 'long',
        ];
    }
}
