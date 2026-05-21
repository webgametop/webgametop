<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\FavoriteableType;
use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Collection;

class DeveloperRepository extends Repository
{
    public function __construct(
        private readonly FavoriteRepository $favoriteRepository,
    )
    {
        parent::__construct();
    }

    public function getFavorites(User $user): Collection
    {
        return $this->favoriteRepository->getFavorites(FavoriteableType::DEVELOPER, $user);
    }

    public function countFavorites(User $user): int
    {
        return $this->getFavorites($user)->count();
    }

    public function countDevelopers(GameProviderEnum $provider = null): int
    {
        /** @var Game $q */
        $q = $this->modelClass::query();

        if ($provider) {
            $q->whereProvider($provider);
        }

        return $q->count();
    }
}
