<?php

declare(strict_types=1);

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class GameProviderInfo
{
    public function __construct(
        public string $logo,
    )
    {
    }
}
