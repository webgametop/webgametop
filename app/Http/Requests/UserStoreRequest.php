<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\HashingFormat;
use App\Enums\UserStatus as Status;
use App\Services\HmacHasherService;
use App\Services\PasswordHasherService;
use App\Values\User\UserCreateData;
use Illuminate\Support;
use Illuminate\Validation\Rules;

class UserStoreRequest extends Request
{
    public function __construct(
        private readonly PasswordHasherService $passwordHasherService,
        private readonly HmacHasherService $hmacHasherService,
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
         *     password: string,
         *     email: string,
         * } $data
         */
        $data = $this->only('user.password', 'user.email')['user'];

        return UserCreateData::make(
            status: Status::PENDING,
            username: uniqid(),
            nickname: strstr($data['email'], '@', true),
            email: Support\Str::lower($data['email']),
            password_hash: $this->passwordHasherService->hash($data['password']),
            registration_ip_hash: $this->hmacHasherService->hash($this->ip(), HashingFormat::BINARY),
            registration_country: 'RU',
        );
    }
}
