<?php

declare(strict_types=1);

namespace App\Enums;

enum GameProviderEnum: string
{
    case YANDEXGAMES = 'yandexgames';
    case CRAZYGAMES = 'crazygames';
    case POKI = 'poki';
}
