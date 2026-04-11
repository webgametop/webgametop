<?php

declare(strict_types=1);

namespace App\Casts;

use App\Enums\GameProvider;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DeveloperProviderCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): GameProvider
    {
        return GameProvider::tryFrom($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        $provider = $value instanceof GameProvider ? $value : GameProvider::tryFrom($value);

        return $provider->value;
    }
}
