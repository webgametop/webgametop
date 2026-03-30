<?php

declare(strict_types=1);

namespace App\Services;

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

    public function createUser(UserCreateData $dto)
    {
        dd($dto);
    }

    public function updateUser(UserUpdateData $dto)
    {
    }

    public function deleteUser()
    {
    }
}
