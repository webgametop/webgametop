<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\GameProviderEnum;
use App\Enums\HashingFormat;
use App\Models\Developer;
use App\Models\Game;
use App\Services\GameProviders\YandexGameProvider;
use App\Services\Security\HmacHasherService;
use App\Values\YandexGame\GameDataItem;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gameprovider:yandexgame:grabber:run';

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
        $provider_name = GameProviderEnum::YANDEXGAMES->value;
        $dedup_template = "dedup,$provider_name,identity,:id";

        $gameCache = Game::all(['dedup_hash'])->collect();
        $developerCache = Developer::all(['id', 'dedup_hash'])->collect();

        $feedGameIds = new Collection;

        /** @var ?string $next_page_id */
        $next_page_id = null;

        do {
            $feed = $provider->getFeed($next_page_id);

            /** @var Collection<GameDataItem> $games */
            $games = $feed->games;

            /** @var GameDataItem $game */
            foreach ($games as $game) {
                /** @var string $dedup_key */
                $dedup_key = Str::replace(':id', $game->id, $dedup_template);
                $dedup_hash = $hasher->hash($dedup_key, HashingFormat::BINARY);
                if (! $gameCache->contains('dedup_hash', $dedup_hash)) {
                    $feedGameIds->push($game->id);
                }
            }

            $page_info = $feed->page_info;

            $next_page_id = $page_info->next_page_id;
        } while ($page_info->has_next_page);

        $chunk = $feedGameIds->unique()->chunk(20);

        /** @var Collection<int> $ids */
        foreach ($chunk as $ids) {
            /** @var Collection<GameDataItem> $games */
            $games = $provider->getGames($ids);

            /** @var Collection<GameDataItem> $data */
            $data = new Collection;

            foreach ($games as $game) {
                /** @var string $dedup_key */
                $dedup_key = Str::replace(':id', $game->developer->id, $dedup_template);
                $dedup_hash = $hasher->hash($dedup_key, HashingFormat::BINARY);

                $modelDeveloper = Developer::firstOrCreate(
                    ['dedup_hash' => $dedup_hash],
                    [
                        'provider' => $provider_name,
                        'identity' => $game->developer->id,
                        'username' => uniqid(),
                        'nickname' => $game->developer->name,
                    ],
                );

                $dedup_key = Str::replace(':id', $game->id, $dedup_template);
                $dedup_hash = $hasher->hash($dedup_key, HashingFormat::BINARY);

                $modelGame = Game::make([
                    'developer_id' => $modelDeveloper->id,
                    'identity' => $game->id,
                    'dedup_hash' => $dedup_hash,
                    'title' => $game->title,
                    'description' => $game->description,
                ]);

                $modelGame->updateTimestamps();

                $data->push($modelGame);
                $gameCache->push($modelGame->only(['dedup_hash']));
            }

            if (! $data->isEmpty()) {
                Game::insert(
                    $data->map(fn(Game $item) => array_merge($item->toArray(), [
                        'created_at' => $item->created_at->toDateTimeString(),
                        'updated_at' => $item->updated_at->toDateTimeString(),
                    ]))->toArray()
                );
            }
        }
    }
}
