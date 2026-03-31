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
        $email = $this->string('user.email');
        $password = $this->string('user.password');

        return UserCreateData::make(
            status: Status::PENDING,
            username: Support\Str::random(32),
            nickname: Support\Str::random(128),
            email: $email->value(),
            password_hash: $this->passwordHasherService->hash($password->value()),
            registration_ip_hash: $this->hmacHasherService->hash($this->ip(), HashingFormat::BINARY),
            registration_country: 'RU',
        );
    }
}
