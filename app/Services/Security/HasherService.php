<?php

declare(strict_types=1);

namespace App\Services\Security;

use App\Enums\HashingAlgo as Algo;
use App\Services\Security\Contracts\HasherInterface;

class HasherService implements HasherInterface
{
    public function hash(string $value, Algo $algo = Algo::SHA256): string
    {
        return hash($algo->value, $value);
    }

    public function verify(string $value, string $hash, Algo $algo = Algo::SHA256): bool
    {
        return hash_equals($this->hash($value, $algo), $hash);
    }
}
