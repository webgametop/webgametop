<?php

declare(strict_types=1);

namespace App\Models\Concerns\Comments;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCommentRelationships
{
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
