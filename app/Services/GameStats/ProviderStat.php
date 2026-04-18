<?php

declare(strict_types=1);

namespace App\Services\GameStats;

use App\Repositories\GameRepository;

class ProviderStat
{
    public function __construct(
        private readonly GameRepository $repository,
    )
    {
    }
}
