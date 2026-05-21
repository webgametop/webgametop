<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\FavoriteableType;
use App\Models\User;
use Illuminate\Support\Collection;

class FavoriteRepository extends Repository
{
    public function getFavorites(FavoriteableType $type, User $user): Collection
    {
        // @todo нужно подумать что с этим ужасом можно сделать
        return $user->morphedByMany($type->modelClass(), 'favoriteable', 'favorites')->get();
    }
}
