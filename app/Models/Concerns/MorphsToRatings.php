<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsToRatings
{
    public function ratings(): MorphMany
    {
        return $this->morphMany(Rating::class, 'rateable');
    }
}
