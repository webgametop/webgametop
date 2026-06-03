<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Enums\VoteCreatedVia;
use App\Enums\VoteType;
use App\Models\Contracts\Votable;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;

class VoteDailyStrategy extends VoteStrategy
{
    public function registerVote(Votable|Model $votable, User $user): Vote
    {
        return $this->service->createVote($votable, Vote::make([
            'user_id' => $user->id,
            'type' => VoteType::DAILY,
            'created_via' => VoteCreatedVia::WEB,
        ]));
    }
}
