<?php

declare(strict_types=1);

namespace App\Models\Concerns\Games;

use App\Models\Concerns\HasFavoriteAttributes;
use App\Models\Concerns\HasRatingAttributes;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasGameAttributes
{
    use HasFavoriteAttributes, HasRatingAttributes;

    protected function isVote(): Attribute
    {
        return Attribute::make(fn() => $this->votes()->where('user_id', auth()->id())->exists());
    }
}
