<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\GameVoteLimitExceededException;
use App\Exceptions\GameVoteNotFoundException;
use App\Models\Game;
use App\Models\GameVote as Vote;
use App\Models\User;
use App\Repositories\GameRepository;
use App\Values\Game\VoteCreateData;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class GameVoteService
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly UserService $userService,
    )
    {
    }

    public function createVote(VoteCreateData $dto): Vote
    {
        $vote = Vote::make($dto->toArray());

        /** @var ?Game $game */
        $game = $this->gameRepository->findOne($vote->game_id);
        throw_if(! $game, new GameVoteNotFoundException);

        $check = $this->userService->hasVotedToday($vote->user_id);
        throw_if($check, new GameVoteLimitExceededException);

        /** @var false|Vote $saved */
        $saved = $game->votes()->save($vote);
        throw_if(! $saved, new \Exception('test'));

        return $saved;
    }

    public function updateVote(array $data)
    {
    }

    public function deleteVote(int $id)
    {
    }

    /**
     * @param Game $game
     * @param ?User $user
     * @return array{
     *     allowed: bool,
     *     next_in: string,
     *     next_at: int,
     * }
     */
    public function processVote(Game $game, ?User $user): array
    {
        if ($has_voted_today = $this->userService->hasVotedToday($user?->id)) {
            $this->generatePayload($game, $user);
        }

        $now = Carbon::now();
        $nextVoteAt = $now->copy()->addDay()->startOfDay();
        $diff = $now->diff($nextVoteAt);

        return [
            'allowed' => !$has_voted_today,
            'next_in' => $diff->format('%H:%I:%S'),
            'next_at' => $nextVoteAt->timestamp,
        ];
    }

    public function generatePayload(Game $game, ?User $user): ?array
    {
        if (! $user instanceof User) {
            return null;
        }

        $payload = $this->cachePayload(
            $this->buildPayload($game, ['user' => ['id' => $user->id]])
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

    private function buildPayload(Game $game, array $data): array
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
