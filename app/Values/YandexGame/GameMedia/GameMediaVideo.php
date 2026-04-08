<?php

declare(strict_types=1);

namespace App\Values\YandexGame\GameMedia;

class GameMediaVideo
{
    public function __construct(
        public readonly string $embed_url,
        public readonly string $thumbnail_url,
        public readonly string $thumbnail_url_prefix,
        public readonly string $stream_url,
        public readonly string $preview_url,
        public readonly string $mp4_stream_url,
        public readonly int $height,
        public readonly int $width,
    )
    {
    }
}
