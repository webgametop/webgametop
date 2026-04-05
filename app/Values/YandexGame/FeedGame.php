<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

class FeedGame
{
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly GameDeveloper $developer,
    )
    {
    }
}
