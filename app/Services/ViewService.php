<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\View;

class ViewService
{
    public function existsBy(array $params): bool
    {
        return View::query()->where($params)->exists();
    }

    public function existsByHash(string $hash): bool
    {
        return $this->existsBy(['dedup_hash' => $hash]);
    }
}
