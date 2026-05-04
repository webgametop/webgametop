<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/** @template T of Model */
interface Repository
{
    /** @return T */
    public function getOne($id): Model;
    /** @return T */
    public function getOneBy(array $params): Model;
    /** @return T|null */
    public function findOne($id): ?Model;
    /** @return T|null */
    public function findOneBy(array $params): ?Model;
    /** @return Collection<array-key, T> */
    public function getMany(array $ids, bool $preserveOrder = false): Collection;
    /** @return Collection<array-key, T> */
    public function getAll(): Collection;
}
