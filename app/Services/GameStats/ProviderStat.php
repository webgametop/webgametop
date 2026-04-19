<?php

declare(strict_types=1);

namespace App\Services\GameStats;

use App\Enums\GameProvider as GameProviderEnum;
use App\Repositories\Contracts\Repository;
use App\Repositories\DeveloperRepository;
use App\Repositories\GameRepository;
use Illuminate\Support\Facades\Cache;

class ProviderStat
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly DeveloperRepository $developerRepository
    )
    {
    }

    public function countDevelopers(): array
    {
        return $this->cacheCount($this->developerRepository, provider_developer_key());
    }

    public function countGames(): array
    {
        return $this->cacheCount($this->gameRepository, provider_game_key());
    }

    private function cacheCount(Repository $repository, string $key): array
    {
        /** @var string $cached */
        $cached = Cache::rememberForever($key, function () use ($repository) {
            $c = [];

            foreach (GameProviderEnum::cases() as $provider) {
                $c[$provider->value] = $repository->count($provider);
            }

            return json_encode($c);
        });

        return json_decode($cached, true);
    }
}
