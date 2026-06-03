<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\VotePersistenceException;
use App\Models\Contracts\Votable;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;

class VoteService
{
    public function createVote(Votable|Model $votable, Vote $vote): Vote
    {
        /** @var false|Vote $saved */
        $saved = $votable->votes()->save($vote);

        throw_unless($saved, new VotePersistenceException);

        return $saved;
    }

    public function registerView()
    {
    }
}
