<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Game;

class DeveloperRepository extends Repository
{
    public function count(GameProviderEnum $provider = null): int
    {
        /** @var Game $q */
        $q = $this->modelClass::query();

        if ($provider) {
            $q->ofProvider($provider);
        }

        return $q->count();
    }
}
