<?php

declare(strict_types=1);

namespace App\Services\Contracts;

interface PasswordHasherInterface extends HasherInterface
{
    public function needsRehash(string $hash): bool;
}
