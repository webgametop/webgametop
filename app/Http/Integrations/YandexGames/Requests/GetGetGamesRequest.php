<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetGetGamesRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        public readonly array $app_ids,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/get_games';
    }

    protected function defaultBody(): array
    {
        return [
            'appIDs' => implode(',', $this->app_ids),
            'format' => 'long',
        ];
    }
}
