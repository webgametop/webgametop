<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Enums\VoteCreatedVia as CreatedViaEnum;
use App\Enums\VoteType as TypeEnum;
use App\Exceptions\DailyVoteAlreadyCastException;
use App\Models\Contracts\Votable;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;

class VoteDailyStrategy extends VoteStrategy
{
    public function registerVote(Votable|Model $votable, User $user, CreatedViaEnum $via): Vote
    {
        throw_unless(
            $this->service->canTodayVote($votable, $user),
            new DailyVoteAlreadyCastException
        );

        return $this->service->createVote($votable, Vote::make([
            'user_id' => $user->id,
            'type' => TypeEnum::DAILY,
            'created_via' => $via,
        ]));
    }
}
