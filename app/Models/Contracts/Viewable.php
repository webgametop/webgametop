<?php

declare(strict_types=1);

namespace App\Models\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Viewable
{
    // @todo провести рефакторинг логики просмотров, см. ICommentable
    public function views(): MorphMany;
}
