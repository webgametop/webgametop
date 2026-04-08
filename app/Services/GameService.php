<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\GameRepository;

class GameService
{
    public function __construct(
        readonly private GameRepository $repository,
    )
    {
    }

    public function createGame(array $data)
    {
    }

    public function updateGame(array $data)
    {
    }

    public function deleteGame(int $id)
    {
    }
}
