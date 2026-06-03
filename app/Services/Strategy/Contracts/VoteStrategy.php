<?php

declare(strict_types=1);

namespace App\Services\Strategy\Contracts;

use App\Enums\VoteCreatedVia as CreatedViaEnum;
use App\Models\Contracts\Votable;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Model;

interface VoteStrategy
{
    public function registerVote(Votable|Model $votable, User $user, CreatedViaEnum $via): Vote;
}
