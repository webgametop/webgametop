<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\EntityMeta;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsToMetadata
{
    public function metadata(): MorphMany
    {
        return $this->morphMany(EntityMeta::class, 'entity');
    }
}
