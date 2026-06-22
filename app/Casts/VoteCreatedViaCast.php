<?php

declare(strict_types=1);

namespace App\Casts;

use App\Enums\VoteCreatedVia;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class VoteCreatedViaCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): VoteCreatedVia
    {
        return VoteCreatedVia::tryFrom($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        $status = $value instanceof VoteCreatedVia ? $value : VoteCreatedVia::tryFrom($value);

        return $status->value;
    }
}
