<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\VoteCreatedVia as CreatedViaEnum;
use App\Enums\VoteType as Strategy;
use App\Exceptions\VotePersistenceException;
use App\Models\Contracts\Votable;
use App\Models\User;
use App\Models\Vote;
use App\Services\Strategy\Contracts\VoteStrategy;
use Illuminate\Database\Eloquent\Model;

class VoteService
{
    public function __construct(
        private ?Strategy $strategy = null,
    )
    {
    }

    public function setStrategy(Strategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function createVote(Votable|Model $votable, Vote $vote): Vote
    {
        /** @var false|Vote $saved */
        $saved = $votable->votes()->save($vote);

        throw_unless($saved, new VotePersistenceException);

        return $saved;
    }

    public function registerVote(Votable|Model $votable, User $user, CreatedViaEnum $via): Vote
    {
        /** @var VoteStrategy $strategy */
        $strategy = app($this->strategy->strategyClass());

        return $strategy->registerVote($votable, $user, $via);
    }
}
