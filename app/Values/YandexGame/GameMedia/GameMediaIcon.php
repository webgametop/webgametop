<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

readonly class GameMediaIcon
{
    public function __construct(
        public string $prefix_url,
        public string $main_color,
    )
    {
    }
}
