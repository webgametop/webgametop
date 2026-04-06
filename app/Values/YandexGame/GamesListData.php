<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Saloon\Http\Response;

class GamesListData implements Arrayable
{
    /**
     * @param Collection<GameDataItem> $games
     */
    public function __construct(
        public readonly Collection $games,
    )
    {
    }

    public static function fromSaloonResponse(Response $response): self
    {
        $games = new Collection;

        /**
         * @var array{
         *     games: array<array>,
         * } $json
         */
        $json = $response->json();

        /**
         * @var array<array> $items
         */
        $items = $json['games'];

        foreach ($items as $item) $games->add(
            GameDataItem::make($item)
        );

        return new self($games);
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
