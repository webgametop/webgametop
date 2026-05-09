<?php

declare(strict_types=1);

namespace App\Enums;

enum CommentableType: string
{
    case GAME = 'game';
    case DEVELOPER = 'developer';
}
