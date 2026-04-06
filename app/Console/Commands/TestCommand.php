<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\GameProviderEnum;
use App\Models\Game;
use App\Services\GameProviders\YandexGameProvider;
use App\Values\YandexGame\GameDataItem;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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
    )
    {
        $feedGameIds = new Collection;

        $pull = Game::all(['provider', 'identity'])->collect();

        /** @var ?string $next_page_id */
        $next_page_id = null;

        do {
            $feed = $provider->getFeed($next_page_id);

            /** @var Collection<GameDataItem> $games */
            $games = $feed->games;

            /** @var GameDataItem $game */
            foreach ($games as $game) {
                if (! $pull->contains('identity', '=', $game->id)) {
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

            $data = $games->map(fn(GameDataItem $game): array => [
                'provider' => GameProviderEnum::YANDEXGAMES,
                'identity' => $game->id,
                'title' => $game->title,
                'description' => $game->description,
            ]);

            if (! $data->isEmpty()) {
                Game::insertOrIgnore($data->toArray());
            }
        }
    }
}
