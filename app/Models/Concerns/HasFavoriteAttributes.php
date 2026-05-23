<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasFavoriteAttributes
{
    protected function isFavorite(): Attribute
    {
        return Attribute::make(fn() => $this->favorites()->where('user_id', auth()->id())->exists());
    }
}
