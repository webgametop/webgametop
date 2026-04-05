<?php

declare(strict_types=1);

namespace App\Http\Integrations\YandexGames\Requests;

use App\Values\YandexGame\FeedData;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetFeedRequest extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public readonly ?string $page_id,
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/feed';
    }

    protected function defaultQuery(): array
    {
        return [
            'lang' => 'ru',
            'tab' => 'new',
            'page_id' => $this->page_id,
        ];
    }

    public function createDtoFromResponse(Response $response): FeedData
    {
        return FeedData::fromSaloonResponse($response);
    }
}
