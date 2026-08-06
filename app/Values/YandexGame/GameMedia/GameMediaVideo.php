<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

readonly class GameMediaVideo
{
    public function __construct(
        public string $embed_url,
        public string $thumbnail_url,
        public string $thumbnail_url_prefix,
        public string $stream_url,
        public string $preview_url,
        public string $mp4_stream_url,
        public int $height,
        public int $width,
    )
    {
    }
}
