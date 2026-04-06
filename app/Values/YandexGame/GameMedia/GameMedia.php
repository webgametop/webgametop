<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

use App\Values\YandexGame\GameMedia\GameMediaCover as Cover;
use App\Values\YandexGame\GameMedia\GameMediaIcon as Icon;
use App\Values\YandexGame\GameMedia\GameMediaScreenshot as Screenshot;
use App\Values\YandexGame\GameMedia\GameMediaVideo as Video;
use Illuminate\Support\Collection;

class GameMedia
{
    /**
     * @param Cover $cover
     * @param Icon $icon
     * @param Collection<Video> $videos
     * @param Collection<Screenshot> $screenshots
     */
    public function __construct(
        public readonly Cover $cover,
        public readonly Icon $icon,
        public readonly Collection $videos,
        public readonly Collection $screenshots,
    )
    {
    }
}
