<?php

declare(strict_types=1);

namespace App\Models\Concerns\Developers;

use App\Models\Concerns\HasFavoriteAttributes;
use App\Models\Concerns\HasRatingAttributes;

trait HasDeveloperAttributes
{
    use HasFavoriteAttributes, HasRatingAttributes;
}
