<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasInteractionAttributes
{
    private ?int $cachedRatingSum = null;

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

    protected function ratingTotal(): Attribute
    {
        return Attribute::make(fn() => $this->getRatingSum());
    }

    protected function ratingClass(): Attribute
    {
        return Attribute::make(
            function () {
                $rate = $this->getRatingSum();

                return match (true) {
                    $rate > 0 => 'bg-success-lt',
                    $rate < 0 => 'bg-danger-lt',
                    default => null,
                };
            }
        );
    }

    private function getRatingSum(): int
    {
        if (null === $this->cachedRatingSum) {
            $this->cachedRatingSum = (int) $this->ratings()->sum('rate');
        }

        return $this->cachedRatingSum;
    }
}
