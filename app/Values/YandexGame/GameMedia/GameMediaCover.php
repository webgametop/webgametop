<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

readonly class GameMediaCover
{
    public function __construct(
        public string $prefix_url,
        public string $main_color,
    )
    {
    }
}
