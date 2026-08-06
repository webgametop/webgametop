<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

readonly class GameMediaScreenshot
{
    public function __construct(
        public string $prefix_url,
        public string $main_color,
        public string $orientation,
        public string $device, // mobile or desktop
    )
    {
    }
}
