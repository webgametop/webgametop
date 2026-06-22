<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\VoteCreatedVia as CreatedViaEnum;
use App\Enums\VoteMatch;
use App\Enums\VoteType as Strategy;
use App\Exceptions\VotePersistenceException;
use App\Models\Contracts\Votable;
use App\Models\User;
use App\Models\Vote;
use App\Services\Strategy\Contracts\VoteStrategy;
use Illuminate\Database\Eloquent\Builder;
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

    public function canVoteToday(Votable|Model $votable, User $user): bool
    {
        return !$this->hasVoted(
            $votable,
            $user,
            match: VoteMatch::TYPE,
            strategy: $this->strategy,
            created_at: Carbon::today(),
        );
    }

    public function hasVoted(Votable|Model $votable, User $user, ...$filter): bool
    {
        $q = Vote::query();

        $q->where('user_id', $user->id);

        $q->when(
            isset($filter['match']),
            static fn (Builder $q) => match ($filter['match']) {
                VoteMatch::MODEL => $q->whereMorphedTo('votable', $votable),
                VoteMatch::TYPE => $q->where('votable_type', $votable->getMorphClass()),
                default => throw new \Exception(__FILE__),
            },
        );

        $q->when(
            isset($filter['strategy']),
            static fn (Builder $q) => $q->where('type', $filter['strategy']),
        );

        $q->when(
            isset($filter['created_at']),
            static fn (Builder $q) => $q->whereDate('created_at', $filter['created_at']),
        );

        return $q->exists();
    }
}
