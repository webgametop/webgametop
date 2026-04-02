<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserEmailTakenException;
use App\Exceptions\UserPersistenceException;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Values\User\UserCreateData;
use App\Values\User\UserUpdateData;

class UserService
{
    private const MAX_REGISTER_PER_FROM_IP = 3;

    public function __construct(
        readonly private UserRepository $repository,
    )
    {
    }

    public function createUser(UserCreateData $dto): User
    {
        $user = User::make($dto->toArray());

        throw_if($this->repository->isEmailTaken($user->email), new UserEmailTakenException);

        throw_if(! $user->save(), new UserPersistenceException);

        return $user;
    }

    public function updateUser(UserUpdateData $dto)
    {
    }

    public function deleteUser()
    {
    }

    public function canRegisterFromIp(string $ipHash): bool
    {
        return $this->repository->countUsersByIpHash($ipHash) < self::MAX_REGISTER_PER_FROM_IP;
    }
}
