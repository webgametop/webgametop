<?php

declare(strict_types=1);

namespace App\Casts;

use App\Enums\UserStatus;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class UserStatusCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): UserStatus
    {
        return UserStatus::tryFrom($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        $status = $value instanceof UserStatus ? $value : UserStatus::tryFrom($value);

        return $status->value;
    }
}
