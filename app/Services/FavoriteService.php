<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Contracts\Favoriteable;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FavoriteService
{
    public function toggleFavorite(Favoriteable|Model $favoriteable, User $user): ?Favorite
    {
        return $favoriteable->favorites()->where('user_id', $user->id)->delete() === 0
            ? $favoriteable->favorites()->create(['user_id' => $user->id])
            : null;
    }
}
