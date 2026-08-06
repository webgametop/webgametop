<?php

declare(strict_types=1);

namespace App\Values\YandexGame;

readonly class FeedDataPageInfo
{
    public function __construct(
        public string $next_page_id,
        public string $rtx_req_id,
        public bool $is_first_page,
        public bool $has_next_page,
    )
    {
    }
}
