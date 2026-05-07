<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsToComment
{
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'target');
    }
}
