<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserEmailTakenException;
use App\Exceptions\UserPersistenceException;
use App\Exceptions\UserRegistrationLimitPerIpReachedException;
use App\Helpers\Email;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Values\User\UserCreateData;
use App\Values\User\UserUpdateData;

class UserService
{
    private const MAX_REGISTRATIONS_PER_IP = 3;

    public function __construct(
        private readonly UserRepository $repository,
    )
    {
    }

    public function createUser(UserCreateData $dto): User
    {
        $email = $dto->getEmail();

        throw_unless(Email::validate($email), new \InvalidArgumentException('Invalid email address.'));

        throw_unless($this->canUseEmail($email), new UserEmailTakenException);

        $user = User::make($dto->toArray());

        throw_unless($user->save(), new UserPersistenceException);

        return $user;
    }

    public function registerUser(UserCreateData $dto): User
    {
        $ip_hash = $dto->getIpHash();

        throw_unless(
            $this->canRegisterMoreUsersFromIp($ip_hash),
            new UserRegistrationLimitPerIpReachedException
        );

        return $this->createUser($dto);
    }

    public function updateUser(UserUpdateData $dto)
    {
    }

    public function deleteUser(User $user)
    {
    }

    public function canRegisterMoreUsersFromIp(string $ip_hash): bool
    {
        return $this->repository->countIpHashes($ip_hash) < self::MAX_REGISTRATIONS_PER_IP;
    }

    public function canUseEmail(string $email): bool
    {
        return empty($this->repository->findOneBy(['email' => $email]));
    }
}
