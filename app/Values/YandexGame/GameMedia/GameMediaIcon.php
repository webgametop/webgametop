<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

class GameMediaIcon
{
    public function __construct(
        public readonly string $prefix_url,
        public readonly string $main_color,
    )
    {
    }
}
