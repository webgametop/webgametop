<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\FavoriteableType;
use App\Enums\GameProvider as GameProviderEnum;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Collection;

class GameRepository extends Repository
{
    public function __construct(
        private readonly FavoriteRepository $favoriteRepository,
    )
    {
        parent::__construct();
    }

    public function getFavorites(User $user): Collection
    {
        return $this->favoriteRepository->getFavorites(FavoriteableType::GAME, $user);
    }

    public function countFavorites(User $user): int
    {
        return $this->getFavorites($user)->count();
    }

    public function countGames(GameProviderEnum $provider = null): int
    {
        $q = Game::query();

        if ($provider) {
            $q->whereProvider($provider);
        }

        return $q->count();
    }
}
