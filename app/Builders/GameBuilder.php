<?php

declare(strict_types=1);

namespace App\Builders;

use App\Builders\Concerns\HasFavoriteStatus;
use App\Builders\Concerns\HasGameVoteStatus;
use App\Builders\Concerns\HasRatingStatus;
use App\Builders\Concerns\HasViewStatus;
use App\Enums\GameProvider as GameProviderEnum;
use Illuminate\Database\Eloquent\Builder;

class GameBuilder extends Builder
{
    use HasFavoriteStatus, HasRatingStatus, HasViewStatus, HasGameVoteStatus;

    public function whereProvider(GameProviderEnum $provider): self
    {
        return $this->whereHas('developer', static fn(Builder $q) => $q->where('provider', $provider));
    }
}
