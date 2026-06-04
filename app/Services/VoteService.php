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
use Illuminate\Support\Carbon;

class VoteService
{
    private Strategy $strategy;

    public function __construct()
    {
        $this->setStrategy(Strategy::DAILY);
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

    public function registerVote(Votable|Model $votable, User $user, CreatedViaEnum $via = CreatedViaEnum::WEB): Vote
    {
        /** @var VoteStrategy $strategy */
        $strategy = app($this->strategy->strategyClass());

        return $strategy->registerVote($votable, $user, $via);
    }

    public function canTodayVote(Votable|Model $votable, User $user): bool
    {
        $q = Vote::query();

        $q->where('user_id', $user->id);
        $q->where('votable_type', $votable->getMorphClass());
        $q->where('type', $this->strategy);
        $q->whereDate('created_at', Carbon::today());

        return !$q->exists();
    }
}
