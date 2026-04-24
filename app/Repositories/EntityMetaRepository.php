<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builders\EntityMetaBuilder;
use Illuminate\Database\Eloquent\Model;

class EntityMetaRepository extends Repository
{
    public function exists(Model $model, ?string $key = null): bool
    {
        /** @var EntityMetaBuilder $q */
        $q = $this->modelClass::query();

        $q->ofEntity($model);

        if (! is_null($key)) {
            $q->ofKey($key);
        }

        return $q->exists();
    }
}
