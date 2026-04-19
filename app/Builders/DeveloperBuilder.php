<?php

declare(strict_types=1);

namespace App\Builders;

use App\Enums\GameProvider as GameProviderEnum;
use Illuminate\Database\Eloquent\Builder;

class DeveloperBuilder extends Builder
{
    public function ofProvider(GameProviderEnum $provider): self
    {
        return $this->where('provider', $provider);
    }
}
