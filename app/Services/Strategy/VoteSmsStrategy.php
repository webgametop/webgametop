<?php

declare(strict_types=1);

namespace App\Services\Strategy;

use App\Models\Contracts\Votable;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;

class VoteSmsStrategy extends VoteStrategy
{
    public function registerVote(Votable|Model $votable, User $user): Vote
    {
    }
}
