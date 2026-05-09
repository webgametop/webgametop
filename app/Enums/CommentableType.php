<?php

declare(strict_types=1);

namespace App\Enums;

enum CommentableType: string
{
    case USER = 'user';
    case DEVELOPER = 'developer';
    case GAME = 'game';
}
