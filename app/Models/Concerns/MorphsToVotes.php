<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsToVotes
{
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
