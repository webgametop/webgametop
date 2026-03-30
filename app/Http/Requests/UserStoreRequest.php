<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\UserStatus as Status;
use App\Services\Contracts\HasherInterface;
use App\Services\Contracts\PasswordHasherInterface;
use App\Values\User\UserCreateData;
use Illuminate\Support;
use Illuminate\Validation\Rules;

/**
 * @property-read array $user
 */
class UserStoreRequest extends Request
{
    public function __construct(
        private readonly PasswordHasherInterface $hasher,
        private readonly HasherInterface $dataHasher,
    )
    {
        parent::__construct();
    }

    public function rules(): array
    {
        return [
            'user.email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'user.password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function toDto(): UserCreateData
    {
        /**
         * @var array{
         *     email: string,
         *     password: string,
         * } $requestData
         */
        $requestData = $this->user;

        return UserCreateData::make(
            status: Status::PENDING,
            username: Support\Str::random(32),
            nickname: Support\Str::random(128),
            email: $requestData['email'],
            password_hash: $this->hasher->hash($requestData['password']),
            registration_ip_hash: $this->dataHasher->hash($ip = $this->ip()),
            registration_country: 'RU',
        );
    }
}
