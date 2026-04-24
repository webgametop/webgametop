<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Game;

class GameRepository extends Repository
{
    public function count(GameProviderEnum $provider = null): int
    {
        $q = Game::query();

        return $provider ? $q->ofProvider($provider)->count() : $q->count();
    }
}
