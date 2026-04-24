<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\EntityMetaDuplicateException;
use App\Models\EntityMeta as Metadata;
use App\Repositories\EntityMetaRepository as MetadataRepository;
use Illuminate\Database\Eloquent\Model;

class MetaService
{
    public function __construct(
        private readonly MetadataRepository $repository,
    )
    {
    }

    public function createMetadata(Model $model, string $key, mixed $value, bool $unique = false) : Metadata
    {
        if ($unique && $this->repository->exists([$model, $key])) {
            throw new EntityMetaDuplicateException;
        }

        /** @var Metadata $q */
        $q = $model->metadata();

        return $q->create(['key' => $key, 'value' => $value]);
    }

    public function updateMetadata()
    {
    }

    public function deleteMetadata()
    {
    }
}
