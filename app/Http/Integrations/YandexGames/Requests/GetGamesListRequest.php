<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use App\Values\YandexGame\GamesListData;
use Illuminate\Support\Collection;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

class GetGamesListRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    /**
     * @param Collection<int> $appIds
     */
    public function __construct(
        public readonly Collection $appIds,
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
            'appIDs' => $this->appIds->values(),
            'format' => 'long',
        ];
    }

    public function createDtoFromResponse(Response $response): GamesListData
    {
        return GamesListData::fromSaloonResponse($response);
    }
}
