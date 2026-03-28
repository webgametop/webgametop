<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\PasswordHasherInterface;
use Illuminate\Support\Facades\Hash;

class PasswordHasherService implements PasswordHasherInterface
{
    public function hash(string $password): string
    {
        return Hash::make($password);
    }

    public function verify(string $password, string $hash): bool
    {
        return Hash::check($password, $hash);
    }

    public function needsRehash(string $hash): bool
    {
        return Hash::needsRehash($hash);
    }
}
