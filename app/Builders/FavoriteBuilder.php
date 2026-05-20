<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Builder;

#[UseEloquentBuilder(FavoriteBuilder::class)]
class FavoriteBuilder extends Builder
{
}
