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
use Illuminate\Support\Carbon;

class VoteDailyStrategy extends VoteStrategy
{
    public function registerVote(Votable|Model $votable, User $user, CreatedViaEnum $via): Vote
    {
        $q = Vote::query();

        $q->where('user_id', $user->id);
        $q->whereDate('created_at', Carbon::today());

        if ($q->exists()) {
            throw new DailyVoteAlreadyCastException;
        }

        return $this->service->createVote($votable, Vote::make([
            'user_id' => $user->id,
            'type' => TypeEnum::DAILY,
            'created_via' => $via,
        ]));
    }
}
