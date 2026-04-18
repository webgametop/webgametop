<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builders\GameBuilder;
use App\Enums\GameProvider as GameProviderEnum;

class GameRepository extends Repository
{
    public function countGames(GameProviderEnum $provider = null): int
    {
        /** @var GameBuilder $q */
        $q = $this->modelClass::query();

        if ($provider) {
            return $q->ofProvider($provider)->count();
        }

        return $q->count();
    }
}
