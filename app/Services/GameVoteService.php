<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Game;
use App\Models\User;
use App\Repositories\GameRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class GameVoteService
{
    public function __construct(
        readonly private GameRepository $repository,
    )
    {
    }

    public function createVote(Game $game)
    {
    }

    public function updateVote(array $data)
    {
    }

    public function deleteVote(int $id)
    {
    }

    public function payloadVote(Game $game, User $user): array
    {
        $payload = $this->cachePayload(
            $this->generatePayload($game, ['user' => ['id' => $user->id]])
        );

        return json_decode($payload, true);
    }

    private function cachePayload(array $payload): string
    {
        return Cache::remember(
            game_vote_key($payload['sub']),
            Carbon::createFromTimestamp($payload['exp']),
            static fn() => json_encode($payload),
        );
    }

    private function generatePayload(Game $game, array $data): array
    {
        return Arr::collapse([$this->basePayload($game), $data]);
    }

    private function basePayload(Game $game): array
    {
        $now = Carbon::now();
        $expiresAt = $now->copy()->addMinutes(7);

        return [
            'sub' => $game->id,
            'iat' => $now->timestamp,
            'exp' => $expiresAt->timestamp,
        ];
    }

    public function hasPayload(Game $game): bool
    {
        return Cache::has(game_vote_key($game->id));
    }
}
