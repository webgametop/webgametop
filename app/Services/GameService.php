<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Carbon;

class GameService
{
    public function __construct(
        private readonly VoteService $voteService,
    )
    {
    }

    public function voteStatus(Game $game, User $user): array
    {
        $allowed = $this->voteService->canTodayVote($game, $user);

        $curr = Carbon::now();
        $next = $curr->copy()->addDay()->startOfDay();
        $diff = $curr->diff($next);

        return [
            'allowed' => $allowed,
            'next_in' => $diff->format('%H:%I:%S'),
            'next_at' => $next->timestamp,
        ];
    }
}
