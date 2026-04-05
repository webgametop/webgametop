<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

class FeedGameDeveloperData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    )
    {
    }
}
