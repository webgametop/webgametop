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
trait HasViewStatus
{
    public function withViewsCount(): static
    {
        return $this->withCount('views');
    }
}
