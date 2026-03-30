<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\HmacHasherInterface;

class HmacHasherService implements HmacHasherInterface
{
    public function hash(string $value): string
    {
        return hash_hmac('sha256', $value, config('app.key'));
    }

    public function verify(string $value, string $hash): bool
    {
        return hash_equals($this->hash($value), $hash);
    }
}
