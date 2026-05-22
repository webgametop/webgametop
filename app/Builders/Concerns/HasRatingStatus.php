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
trait HasRatingStatus
{
    public function withRatingStatus(): static
    {
        /** @var ?User $user */
        $user = auth()->user();

        return $this->withExists([
            'ratings as is_rating' => static fn(Builder $q) => $q->where('user_id', $user?->id)
        ]);
    }
}
