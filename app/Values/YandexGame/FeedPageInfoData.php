<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

class FeedPageInfoData
{
    public function __construct(
        public readonly string $next_page_id,
        public readonly string $rtx_req_id,
        public readonly bool $is_first_page,
        public readonly bool $has_next_page,
    )
    {
    }
}
