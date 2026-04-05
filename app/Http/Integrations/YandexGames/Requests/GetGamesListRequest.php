<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use App\Values\YandexGame\GamesData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class GetGamesListRequest extends Request implements HasBody
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

    public function createDtoFromResponse(Response $response): GamesData
    {
        return GamesData::fromSaloonResponse($response);
    }
}
