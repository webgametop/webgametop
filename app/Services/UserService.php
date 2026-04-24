<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserMetaKey as MetaKey;
use App\Exceptions\UserEmailTakenException;
use App\Exceptions\UserPersistenceException;
use App\Exceptions\UserRegisterLimitWithOneIpException;
use App\Models\EntityMeta as UserMeta;
use App\Models\User;
use App\Repositories\GameVoteRepository;
use App\Repositories\UserRepository;
use App\Values\User\UserCreateData;
use App\Values\User\UserUpdateData;
use Illuminate\Support\Carbon;

class UserService
{
    private const MAX_REGISTER_PER_FROM_IP = 3;

    public function __construct(
        readonly private UserRepository $repository,
        readonly private GameVoteRepository $gameVoteRepository,
        readonly private MetaService $metaService,
    )
    {
    }

    public function createUserMeta(User $user, MetaKey $key, mixed $value, bool $unique = false): UserMeta
    {
        return $this->metaService->createMetadata($user, $key->value, $value, $unique);
    }

    public function updateUserMeta()
    {
    }

    public function deleteUserMeta()
    {
    }

    public function createUser(UserCreateData $dto): User
    {
        $user = User::make($dto->toArray());

        throw_if($this->isEmailTaken($user->email), new UserEmailTakenException);

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

    public function deleteUser(int $id)
    {
    }

    public function canRegisterFromIp(string $ip_hash): bool
    {
        return $this->repository->countIpHashes($ip_hash) < self::MAX_REGISTER_PER_FROM_IP;
    }

    public function canVotedToday(int $user_id): bool
    {
        return !$this->hasVotedToday($user_id);
    }

    public function hasVotedToday(int $user_id): bool
    {
        return !empty($this->gameVoteRepository->findOneBy([
            'user_id' => $user_id,
            'voted_at' => Carbon::now()->format('Y-m-d'),
        ]));
    }

    public function isEmailTaken(string $email): bool
    {
        return !empty($this->repository->findOneBy(['email' => $email]));
    }
}
