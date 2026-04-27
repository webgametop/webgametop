<?php

declare(strict_types=1);

namespace App\Enums\Contracts;

interface WithInfo
{
    public function getMetadata(): object;
}
