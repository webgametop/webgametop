<?php

declare(strict_types=1);

namespace App\Builders;

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
abstract class FavoriteBuilder extends Builder
{
    public function withFavoriteStatus(): static
    {
        /** @var ?User $user */
        $user = auth()->user();

        return $this->withExists([
            'favorites as is_favorite' => static fn(Builder $q) => $q->where('user_id', $user->id)
        ]);
    }
}
