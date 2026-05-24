<?php

declare(strict_types=1);

namespace App\Models\Concerns\Developers;

use App\Models\Concerns\HasFavoriteAttributes;
use App\Models\Concerns\HasRatingAttributes;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasDeveloperAttributes
{
    use HasFavoriteAttributes, HasRatingAttributes;

    protected function url(): Attribute
    {
        return Attribute::make(fn() => route('developers.show', [$this, $this->slug]));
    }

    protected function display(): Attribute
    {
        return Attribute::make(fn() => $this->name);
    }
}
