<?php

declare(strict_types=1);

namespace App\Enums;

use App\Models\Contracts\Favoriteable;
use App\Models\Developer;
use App\Models\Game;
use Illuminate\Database\Eloquent\Model;

enum FavoriteableType: string
{
    case DEVELOPER = 'developer';
    case GAME = 'game';

    /** @return class-string<Favoriteable|Model> */
    public function modelClass(): string
    {
        return match ($this) {
            self::DEVELOPER => Developer::class,
            self::GAME => Game::class,
        };
    }
}
