<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

class GameMediaCover
{
    public function __construct(
        public readonly string $prefix_url,
        public readonly string $main_color,
    )
    {
    }
}
