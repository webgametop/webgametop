<?php

declare(strict_types=1);

namespace App\Services\GameProviders;

use App\Http\Integrations\YandexGames\Requests\GetFeedRequest;
use App\Http\Integrations\YandexGames\Requests\GetGameRequest;
use App\Http\Integrations\YandexGames\Requests\GetGamesListRequest;
use App\Http\Integrations\YandexGames\YandexGamesConnector;
use App\Services\GameProviders\Contracts\Provider;
use App\Values\YandexGame\FeedData;
use App\Values\YandexGame\GameData;
use App\Values\YandexGame\GameDataItem;
use App\Values\YandexGame\GamesListData;
use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

class YandexGameProvider implements Provider
{
    public function __construct(
        private readonly YandexGamesConnector $connector,
    )
    {
    }

    /**
     * @param int $id
     * @return GameDataItem
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getGame(int $id): GameDataItem
    {
        /** @var GameData $dto */
        $dto = $this->connector->send(new GetGameRequest($id))->dto();

        return $dto->game;
    }

    /**
     * @param Collection<int> $ids
     * @return Collection<GameDataItem>
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getGames(Collection $ids): Collection
    {
        /** @var GamesListData $dto */
        $dto = $this->connector->send(new GetGamesListRequest($ids))->dto();

        return $dto->games;
    }

    /**
     * @param ?string $page_id
     * @return FeedData
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getFeed(?string $page_id = null): FeedData
    {
        return $this->connector->send(new GetFeedRequest($page_id))->dto();
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }
}
