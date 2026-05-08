<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use App\Models\View;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphsToView
{
    public function views(): MorphMany
    {
        return $this->morphMany(View::class, 'viewable');
    }
}
