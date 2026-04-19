<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builders\GameBuilder;
use App\Enums\GameProvider as GameProviderEnum;

class DeveloperRepository extends Repository
{
    public function count(GameProviderEnum $provider = null): int
    {
        /** @var GameBuilder $q */
        $q = $this->modelClass::query();

        if ($provider) {
            return $q->ofProvider($provider)->count();
        }

        return $q->count();
    }
}
