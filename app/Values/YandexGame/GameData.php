<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

use Illuminate\Contracts\Support\Arrayable;
use Saloon\Http\Response;

class GameData implements Arrayable
{
    public function __construct()
    {
    }

    public static function fromSaloonResponse(Response $response): self
    {
        $json = $response->json();

        return new self();
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}
