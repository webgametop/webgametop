<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserEmailTakenException;
use App\Exceptions\UserPersistenceException;
use App\Exceptions\UserRegisterLimitWithOneIpException;
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

    public function registerUser(UserCreateData $dto): User
    {
        $ip_hash = $dto->getIpHash();

        throw_if(! $this->canRegisterFromIp($ip_hash), new UserRegisterLimitWithOneIpException);

        return $this->createUser($dto);
    }

    public function updateUser(UserUpdateData $dto)
    {
    }

    public function deleteUser()
    {
    }

    public function canRegisterFromIp(string $ip_hash): bool
    {
        return $this->repository->countUsersByIpHash($ip_hash) < self::MAX_REGISTER_PER_FROM_IP;
    }
}
