<?php

declare(strict_types=1);

namespace App\Builders\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function withRatingSummary()
    {
        return $this->withCount([
            'ratings as likes_count' => static fn(Builder $q) => $q->where('rate', 1),
            'ratings as dislikes_count' => static fn(Builder $q) => $q->where('rate', -1),
        ]);
    }

    public function withLikesPercentage()
    {
        $q = $this->withRatingSummary();
        $t = $this->getModel()->getTable();

        return $this->fromSub($q, $t)->select([
            "$t.*",
            DB::raw(
                "CASE " .
                    "WHEN (likes_count + dislikes_count) > 0 " .
                    "THEN ROUND(" .
                        "100 * likes_count / (likes_count + dislikes_count)" .
                    ") " .
                    "ELSE 0 " .
                "END AS likes_percentage"
            )
        ]);
    }
}
