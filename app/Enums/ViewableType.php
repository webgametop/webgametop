<?php

declare(strict_types=1);

namespace App\Enums;

enum ViewableType: string
{
    case USER = 'user';
    case DEVELOPER = 'developer';
    case GAME = 'game';
    case COMMENT = 'comment';
}
