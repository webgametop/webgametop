<?php

declare(strict_types=1);

namespace App\Models\Concerns\Developers;

use App\Models\Game;
use App\Models\GameVote as Vote;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasDeveloperRelationships
{
    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function votes(): HasManyThrough
    {
        return $this->hasManyThrough(
            Vote::class,
            Game::class,
            'developer_id',
            'game_id',
            'id',
            'id',
        );
    }
}
