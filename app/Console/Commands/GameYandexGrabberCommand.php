<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\GameProvider;
use App\Enums\HashingFormat;
use App\Models\Developer;
use App\Models\Game;
use App\Services\GameProviders\YandexGameProvider;
use App\Services\Security\HmacHasherService;
use App\Values\YandexGame\GameDataItem;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class GameYandexGrabberCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:yandex:grabber';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(
        YandexGameProvider $provider,
        HmacHasherService $hasher,
    ) : void
    {
        $provider_name = GameProvider::YANDEXGAMES->value;

        $dedup_game = "dedup,$provider_name,game,:identity";
        $dedup_developer = "dedup,$provider_name,developer,:identity";

        $gameCache = Game::all(['dedup_hash'])->keyBy('dedup_hash');
        $developerCache = Developer::all(['id', 'dedup_hash'])->collect();

        $feedGameIds = new Collection;

        /** @var ?string $next_page_id */
        $next_page_id = null;

        do {
            $feed = $provider->getFeed($next_page_id);

            /** @var Collection<GameDataItem> $games */
            $games = $feed->games;

            $pageInfo = $feed->pageInfo;

            $next_page_id = $pageInfo->next_page_id;

            /** @var GameDataItem $game */
            foreach ($games as $game) {
                /** @var string $dedup_key */
                $dedup_key = Str::replace(':identity', $game->id, $dedup_game);
                $dedup_hash = $hasher->hash($dedup_key, HashingFormat::BINARY);

                if (! $gameCache->has($dedup_hash)) {
                    $feedGameIds->add($game->id);
                }
            }
        } while ($pageInfo->has_next_page);

        $chunk = $feedGameIds->unique()->chunk(20);

        /** @var Collection<int> $ids */
        foreach ($chunk as $ids) {
            /** @var Collection<GameDataItem> $games */
            $games = $provider->getGames($ids);

            /** @var Collection<GameDataItem> $data */
            $data = new Collection;

            foreach ($games as $game) {
                /** @var string $dedup_key */
                $dedup_key = Str::replace(':identity', $game->developer->id, $dedup_developer);
                $dedup_hash = $hasher->hash($dedup_key, HashingFormat::BINARY);

                /** @var ?Developer $modelDeveloper */
                $modelDeveloper = $developerCache->first(
                    static fn(Developer $item) => $item->dedup_hash === $dedup_hash
                );

                if (! $modelDeveloper) {
                    $modelDeveloper = Developer::firstOrCreate(
                        ['dedup_hash' => $dedup_hash],
                        [
                            'provider' => $provider_name,
                            'identity' => $game->developer->id,
                            'slug' => uniqid(),
                            'name' => $game->developer->name,
                        ],
                    );

                    $developerCache->add($modelDeveloper);
                }

                $dedup_key = Str::replace(':identity', $game->id, $dedup_game);
                $dedup_hash = $hasher->hash($dedup_key, HashingFormat::BINARY);

                $modelGame = Game::make([
                    'developer_id' => $modelDeveloper->id,
                    'identity' => $game->id,
                    'dedup_hash' => $dedup_hash,
                    'slug' => uniqid(),
                    'title' => $game->title,
                    'description' => $game->description,
                    'released_at' => $game->first_published,
                ]);

                $modelGame->updateTimestamps();

                $data->add($modelGame);
                $gameCache->add($modelGame);
            }

            if (! $data->isEmpty()) {
                $data->transform(static fn(Game $item): array => [
                    ...$item->toArray(),
                    'created_at' => $item->created_at->toDateTimeString(),
                    'updated_at' => $item->updated_at->toDateTimeString(),
                    'released_at'=> $item->released_at->toDateTimeString(),
                ]);

                Game::insert($data->toArray());
            }
        }

        Cache::forget(provider_game_key());
        Cache::forget(provider_developer_key());
    }
}
