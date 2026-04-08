<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Http\Response;

class GameData implements Arrayable
{
    public function __construct(
        public readonly GameDataItem $game
    )
    {
    }

    public static function fromSaloonResponse(Response $response): self
    {
        $json = $response->json();

        /**
         * @var array $item
         */
        $item = $json['game'];

        return new self(GameDataItem::make($item));
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
