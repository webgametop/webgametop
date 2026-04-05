<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use App\Values\YandexGame\GameData;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class GetGameRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        public readonly int $app_id,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/get_game';
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
            'appID' => $this->app_id,
            'format' => 'long',
        ];
    }

    public function createDtoFromResponse(Response $response): GameData
    {
        return GameData::fromSaloonResponse($response);
    }
}
