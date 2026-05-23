<?php

declare(strict_types=1);

namespace App\Enums;

enum RateableType: string
{
    case DEVELOPER = 'developer';
    case GAME = 'game';
}
