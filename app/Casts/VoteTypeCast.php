<?php

declare(strict_types=1);

namespace App\Casts;

use App\Enums\VoteType;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class VoteTypeCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): VoteType
    {
        return VoteType::tryFrom($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        $status = $value instanceof VoteType ? $value : VoteType::tryFrom($value);

        return $status->value;
    }
}
