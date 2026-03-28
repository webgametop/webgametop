<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Enums\HashingAlgo as Algo;

interface DataHasherInterface
{
    public function hash(string $value, Algo $algo): string;
    public function verify(string $value, string $hash, Algo $algo): bool;
}
