<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

class GameMediaIcon
{
    public function __construct(
        public readonly array $prefix_url,
        public readonly array $main_color,
    )
    {
    }
}
