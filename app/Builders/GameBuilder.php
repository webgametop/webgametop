<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\GameProvider as GameProviderEnum;
use Illuminate\Database\Eloquent\Builder;

class GameBuilder extends Builder
{
    public function ofProvider(GameProviderEnum $provider): self
    {
        return $this->whereHas('developer', static fn(Builder $q) => $q->where('provider', $provider));
    }
}
