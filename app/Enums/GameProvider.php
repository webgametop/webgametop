<?php

declare(strict_types=1);

namespace App\Enums;

enum GameProvider: string
{
    case YANDEXGAMES = 'yandexgames';
    case CRAZYGAMES = 'crazygames';
    case POKI = 'poki';

    public function label(): string
    {
        return match($this) {
            self::YANDEXGAMES => 'Яндекс.Игры',
            self::CRAZYGAMES => 'CrazyGames',
            self::POKI => 'Poki',
        };
    }
}
