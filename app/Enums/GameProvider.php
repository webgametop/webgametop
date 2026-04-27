<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\GameProviderInfo as Attribute;
use App\Enums\Concerns\HasInfo;
use App\Enums\Contracts\WithInfo as Contract;

enum GameProvider: string implements Contract
{
    use HasInfo;

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
