<?php

declare(strict_types=1);

namespace App\Models\Concerns\Developers;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasDeveloperAttributes
{
    protected function isFavorite(): Attribute
    {
        return Attribute::make(fn() => $this->favorites()->where('user_id', auth()->id())->exists());
    }

    protected function isRating(): Attribute
    {
        return Attribute::make(fn() => $this->ratings()->where('user_id', auth()->id())->exists());
    }
}
