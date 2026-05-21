<?php

declare(strict_types=1);

namespace App\Models\Concerns\Games;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasGameAttributes
{
    protected function isFavorite(): Attribute
    {
        return Attribute::make(fn() => $this->favorites()->where('user_id', auth()->id())->exists());
    }
}
