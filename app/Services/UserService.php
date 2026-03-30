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
        $modelUser = User::make($dto->toArray());

        throw_if(! $modelUser->save(), new \Exception('user not saved'));

        return $modelUser;
    }

    public function updateUser(UserUpdateData $dto)
    {
    }

    public function deleteUser()
    {
    }
}
