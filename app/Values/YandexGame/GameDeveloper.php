<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

readonly class GameDeveloper
{
    public function __construct(
        public int $id,
        public string $name,
    )
    {
    }
}
