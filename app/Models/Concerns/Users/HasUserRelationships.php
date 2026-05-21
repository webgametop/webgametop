<?php

declare(strict_types=1);

namespace App\Models\Concerns\Users;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasUserRelationships
{
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
