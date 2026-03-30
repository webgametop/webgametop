<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

class PasswordHasherService implements PasswordHasherInterface
{
    public function hash(string $value): string
    {
        return Hash::make($value);
    }

    public function verify(string $value, string $hash): bool
    {
        return Hash::check($value, $hash);
    }

    public function needsRehash(string $hash): bool
    {
        return Hash::needsRehash($hash);
    }
}
