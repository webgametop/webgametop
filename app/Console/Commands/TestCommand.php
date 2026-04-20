<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\GameProvider;
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
    protected $signature = 'game:yandex:uploader';

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
    ) : void
    {
        $q = Game::query();

        $q->ofProvider(GameProvider::YANDEXGAMES);
        $q->select(['id', 'identity']);

        $q->chunk(20, function (Collection $chunk) use ($provider) {
            /** @var Collection<GameDataItem> $games */
            $games = $provider->getGames(
                $chunk->map(fn(Game $game) => (int)$game->identity)
            );

            $games->each(function (GameDataItem $item) use ($chunk) {
                $model = $chunk->first(
                    static fn(Game $game) => $game->identity == $item->id
                );

                dd($item, $model);
            });
        });
    }
}
