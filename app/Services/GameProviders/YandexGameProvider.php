<?php

declare(strict_types=1);

namespace App\Services\GameProviders;

use App\Http\Integrations\YandexGames\Requests\GetFeedRequest;
use App\Http\Integrations\YandexGames\Requests\GetGamesListRequest;
use App\Http\Integrations\YandexGames\YandexGamesConnector;
use App\Services\GameProviders\Contracts\Provider;
use App\Values\YandexGame\FeedData;
use Illuminate\Support\Collection;

class YandexGameProvider implements Provider
{
    public function __construct(
        private readonly YandexGamesConnector $connector,
    )
    {
    }

    public function getGame(int $id)
    {
        //
    }

    public function getGames(array $ids): Collection
    {
        return $this->connector->send(new GetGamesListRequest($ids))->dto();
    }

    public function getFeed(?string $page_id = null): FeedData
    {
        return $this->connector->send(new GetFeedRequest($page_id))->dto();
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}
