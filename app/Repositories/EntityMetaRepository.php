<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builders\EntityMetaBuilder as Builder;
use App\Models\EntityMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EntityMetaRepository extends Repository
{
    public function getOneBy(array $params): EntityMeta
    {
        throw_if(! $res = $this->findOneBy(...$params)->first(), new ModelNotFoundException);

        return $res;
    }

    public function findOneBy(array $params): ?EntityMeta
    {
        return $this->metaBy(...$params)->first();
    }

    public function exists(array $params): bool
    {
        return $this->metaBy(...$params)->exists();
    }

    private function metaBy(Model $model, ?string $key = null): Builder
    {
        $q = EntityMeta::query();

        $q->ofEntity($model);

        if (! is_null($key)) {
            $q->ofKey($key);
        }

        return $q;
    }
}
