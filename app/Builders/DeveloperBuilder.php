<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\GameProvider as GameProviderEnum;

class DeveloperBuilder extends FavoriteBuilder
{
    public function whereProvider(GameProviderEnum $provider): self
    {
        return $this->where('provider', $provider);
    }
}
