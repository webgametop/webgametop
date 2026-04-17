<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\GameVoteExpiredException;
use App\Exceptions\GameVoteLimitExceededException;
use App\Exceptions\GameVoteMismatchException;
use App\Exceptions\GameVoteNotFoundException;
use App\Exceptions\GameVotePersistenceException;
use App\Models\Game;
use App\Models\GameVote as Vote;
use App\Models\User;
use App\Repositories\GameRepository;
use App\Values\Game\VoteCreateData;
use App\Values\Game\VoteRegisterData;
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

        $checked = $this->userService->hasVotedToday($vote->user_id);
        throw_if($checked, new GameVoteLimitExceededException);

        /** @var false|Vote $saved */
        $saved = $game->votes()->save($vote);
        throw_if(! $saved, new GameVotePersistenceException);

        return $saved;
    }

    public function registerVote(VoteRegisterData $dto): ?Vote
    {
        /** @var $cached ?string */
        $cached = Cache::pull($dto->key());
        throw_if(! $cached, new GameVoteExpiredException);

        /**
         * @var array{
         *     sub: int,
         *     iat: int,
         *     exp: int,
         *     user: array{
         *         id: int,
         *     }
         * } $payload
         */
        $payload = json_decode($cached, true);

        $checked = $payload['sub'] === $dto->sub();
        throw_if(! $checked, new GameVoteMismatchException);

        $dto = VoteCreateData::make(
            $payload['sub'],
            $payload['user']['id'],
            $dto->via(),
        );

        return $this->createVote($dto);
    }

    public function updateVote(array $data)
    {
    }

    public function deleteVote(int $id)
    {
    }

    /**
     * @param Game $game
     * @param User $user
     * @return array{
     *     allowed: bool,
     *     next_in: string,
     *     next_at: int,
     * }
     */
    public function processVote(Game $game, User $user): array
    {
        if ($can_voted_today = $this->userService->canVotedToday($user->id)) {
            $this->generatePayload($game, $user);
        }

        $now = Carbon::now();
        $nextVoteAt = $now->copy()->addDay()->startOfDay();
        $diff = $now->diff($nextVoteAt);

        return [
            'allowed' => $can_voted_today,
            'next_in' => $diff->format('%H:%I:%S'),
            'next_at' => $nextVoteAt->timestamp,
        ];
    }

    public function generatePayload(Game $game, User $user): array
    {
        return $this->cachePayload(
            $this->buildPayload($game, ['user' => ['id' => $user->id]])
        );
    }

    /**
     * @param array{
     *     sub: int,
     *     iat: int,
     *     exp: int,
     *     user: array{
     *         id: int,
     *     }
     * } $payload
     * @return array
     */
    private function cachePayload(array $payload): array
    {
        $key = game_vote_key($payload['user']['id']);

        /** @var ?string $cached */
        if ($cached = Cache::get($key)) {
            /** @var array $old */
            $old = json_decode($cached, true);
            if ($old['sub'] === $payload['sub']) {
                return $old;
            }
        }

        Cache::put($key, json_encode($payload), Carbon::createFromTimestamp($payload['exp']));

        return $payload;
    }

    private function buildPayload(Game $game, array $data): array
    {
        return Arr::collapse([$this->basePayload($game), $data]);
    }

    /**
     * @param Game $game
     * @return array{
     *     sub: int,
     *     iat: int,
     *     exp: int,
     * }
     */
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

    public function hasPayload(int $user_id): bool
    {
        return Cache::has(game_vote_key($user_id));
    }
}
