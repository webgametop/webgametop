<?php

declare(strict_types=1);

namespace App\Values\User;

use App\Enums\UserStatus as Status;
use Illuminate\Contracts\Support\Arrayable;

final readonly class UserCreateData implements Arrayable
{
    public function __construct(
        private Status $status,
        private string $username,
        private string $nickname,
        private string $email,
        private string $password_hash,
        private string $registration_ip_hash,
        private string $registration_country,
    )
    {
    }

    public static function make(
        Status $status,
        string $username,
        string $nickname,
        string $email,
        string $password_hash,
        string $registration_ip_hash,
        string $registration_country,
    ) : self {
        return new self(
            status: $status,
            username: $username,
            nickname: $nickname,
            email: $email,
            password_hash: $password_hash,
            registration_ip_hash: $registration_ip_hash,
            registration_country: $registration_country,
        );
    }

    public function getIpHash(): string
    {
        return $this->registration_ip_hash;
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status->value,
            'username' => $this->username,
            'nickname' => $this->nickname,
            'email' => $this->email,
            'password' => $this->password_hash,
            'registration_ip_hash' => $this->registration_ip_hash,
            'registration_country' => $this->registration_country,
        ];
    }
}
