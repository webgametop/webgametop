<?php

declare(strict_types=1);

namespace App\Repositories;

class UserRepository extends Repository
{
    public function isEmailTaken(string $email): bool
    {
        return !empty($this->findOneBy(['email' => $email]));
    }

    public function countUsersByIpHash(string $ip_hash): int
    {
        return $this->modelClass::where(['registration_ip_hash' => $ip_hash])->count();
    }
}
