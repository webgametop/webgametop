<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface PasswordHasherInterface
{
    public function hash(string $value): string;
    public function verify(string $value, string $hash): bool;
    public function needsRehash(string $hash): bool;
}
