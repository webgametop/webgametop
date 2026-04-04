<?php

declare(strict_types=1);

namespace App\Services\Game;

use App\Http\Integrations\YandexGames\Requests\GetFeedRequest;
use App\Http\Integrations\YandexGames\YandexGamesConnector;

class YandexGameService
{
    public function __construct(
        private readonly YandexGamesConnector $connector
    )
    {
    }

    public function getGames()
    {
    }

    public function getFeed(?string $page_id = null): object
    {
        $res = $this->connector->send(new GetFeedRequest($page_id));
        $data = $res->object();
        $suggested = current(array_filter($data->feed, fn($item) => $item->type === 'suggested'));
        $games = $suggested->items;
        $pageInfo = $data->pageInfo;
        return (object)[
            'games' => $games,
            'pageInfo' => $pageInfo,
        ];
    }
}
