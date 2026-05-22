<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasInteractionAttributes
{
    protected function isFavorite(): Attribute
    {
        return Attribute::make(fn() => $this->favorites()->where('user_id', auth()->id())->exists());
    }

    protected function isRating(): Attribute
    {
        return Attribute::make(fn() => $this->ratings()->where('user_id', auth()->id())->exists());
    }

    protected function likesCount(): Attribute
    {
        return Attribute::make(fn() => $this->ratings()->where('rate', 1)->count());
    }

    protected function dislikesCount(): Attribute
    {
        return Attribute::make(fn() => $this->ratings()->where('rate', -1)->count());
    }
}
