<?php

declare(strict_types=1);

namespace App\Builders\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 *
 * @property ?User $user
 */
trait HasGameVoteStatus
{
    public function withVotesCount(): static
    {
        return $this->withCount('votes');
    }
}
