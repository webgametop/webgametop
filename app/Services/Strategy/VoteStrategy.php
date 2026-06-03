<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Services\VoteService;
use App\Services\Strategy\Contracts\VoteStrategy as Contract;

abstract class VoteStrategy implements Contract
{
    public function __construct(
        protected readonly VoteService $service,
    )
    {
    }
}
