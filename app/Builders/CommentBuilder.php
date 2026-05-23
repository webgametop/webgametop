<?php

declare(strict_types=1);

namespace App\Builders;

use App\Builders\Concerns\HasRatingStatus;
use Illuminate\Database\Eloquent\Builder;

class CommentBuilder extends Builder
{
    use HasRatingStatus;
}
