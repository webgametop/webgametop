<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Contracts\HasMetadata as Contract;
use App\Attributes\GameProviderMetadata as Attribute;
use App\Traits\HasMetadataTrait;

enum GameProvider: string implements Contract
{
    use HasMetadataTrait;

    #[Attribute('static/media/brands/yandexgames.svg')]
    case YANDEXGAMES = 'yandexgames';
    #[Attribute('static/media/brands/crazygames.svg')]
    case CRAZYGAMES = 'crazygames';
    #[Attribute('static/media/brands/poki.svg')]
    case POKI = 'poki';

    public function label(): string
    {
        return match($this) {
            self::YANDEXGAMES => 'Яндекс.Игры',
            self::CRAZYGAMES => 'CrazyGames',
            self::POKI => 'Poki',
        };
    }

    public function logo(): string
    {
        return asset($this->getMetadata()->logo);
    }

    public function getMetadata(): object
    {
        return $this->getInstance(Attribute::class);
    }
}
