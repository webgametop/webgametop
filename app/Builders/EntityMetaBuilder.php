<?php

declare(strict_types=1);

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EntityMetaBuilder extends Builder
{
    public function ofEntity(Model $model): self
    {
        return $this->where('entity_type', $model::class)->where('entity_id', $model->getKey());
    }

    public function ofKey(string $key): self
    {
        return $this->where('key', $key);
    }
}
