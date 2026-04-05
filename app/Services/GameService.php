<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Game;
use App\Repositories\GameRepository;

class GameService
{
    public function __construct(
        readonly private GameRepository $repository,
    )
    {
    }

    public function createGame(array $data): Game
    {
        $game = Game::make($data);

        $game->save();

        return $game;
    }

    public function updateGame(array $data)
    {
    }

    public function deleteGame(int $id)
    {
    }
}
