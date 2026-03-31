<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Values\User\UserCreateData;
use App\Values\User\UserUpdateData;

class UserService
{
    public function __construct(
        readonly private UserRepository $repository,
    )
    {
    }

    public function createUser(UserCreateData $dto): User
    {
        $user = User::make($dto->toArray());

        throw_if(! $user->save(), new \Exception('user not saved'));

        return $user;
    }

    public function updateUser(UserUpdateData $dto)
    {
    }

    public function deleteUser()
    {
    }
}
