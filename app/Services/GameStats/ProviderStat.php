<?php

declare(strict_types=1);

namespace App\Services\GameStats;

use App\Enums\GameProvider as GameProviderEnum;
use App\Repositories\GameRepository;
use Illuminate\Support\Facades\Cache;

class ProviderStat
{
    public function __construct(
        private readonly GameRepository $repository,
    )
    {
    }

    public function generateCount(): array
    {
        return $this->cacheCount();
    }

    private function cacheCount(): array
    {
        $key = provider_game_key();

        /** @var string $cached */
        $cached = Cache::rememberForever($key, function () {
            $c = [];

            foreach (GameProviderEnum::cases() as $provider) {
                $c[$provider->value] = $this->repository->countGames($provider);
            }

            return json_encode($c);
        });

        return json_decode($cached, true);
    }
}
