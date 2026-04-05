<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetGetGamesRequest extends Request implements HasBody
{
    use HasJsonBody;

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

    protected function defaultQuery(): array
    {
        return [
            'lang' => 'ru',
            'draft' => 'false',
        ];
    }

    protected function defaultBody(): array
    {
        return [
            'appIDs' => $this->app_ids,
            'format' => 'long',
        ];
    }
}
