<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Enums\HashingAlgo as Algo;

interface HmacHasherInterface
{
    public function hash(string $value): string;
    public function verify(string $value, string $hash): bool;
}
