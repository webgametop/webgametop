<?php

declare(strict_types=1);

namespace App\Models\Concerns\Games;

use App\Models\Developer;
use App\Models\GameVote;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasGameRelationships
{
    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(GameVote::class);
    }
}
