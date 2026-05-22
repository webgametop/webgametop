<?php

declare(strict_types=1);

namespace App\Models\Concerns\Games;

use App\Models\Concerns\HasInteractionAttributes;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasGameAttributes
{
    use HasInteractionAttributes;

    protected function isVote(): Attribute
    {
        return Attribute::make(fn() => $this->votes()->where('user_id', auth()->id())->exists());
    }
}
