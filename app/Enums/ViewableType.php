<?php

declare(strict_types=1);

namespace App\Enums;

use App\Models\Comment;
use App\Models\Developer;
use App\Models\Game;
use App\Models\User;

enum ViewableType: string
{
    case GAME = Game::class;
    case DEVELOPER = Developer::class;
    case USER = User::class;
    case COMMENT = Comment::class;
}
