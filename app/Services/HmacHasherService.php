<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\HashingFormat as Format;
use App\Services\Contracts\HasherInterface;

class HmacHasherService implements HasherInterface
{
    public function hash(string $value, ?Format $format = Format::HEX): string
    {
        return hash_hmac('sha256', $value, config('app.key'), $format === Format::BINARY);
    }

    public function verify(string $value, string $hash, ?Format $format = Format::HEX): bool
    {
        return hash_equals($this->hash($value, $format), $hash);
    }
}
