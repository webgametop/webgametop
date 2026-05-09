<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ViewDeduplicationException;
use App\Exceptions\ViewPersistenceException;
use App\Models\Contracts\Viewable;
use App\Models\View;
use Illuminate\Database\Eloquent\Model;

class ViewService
{
    public function createView(Viewable|Model $viewable, View $view): View
    {
        /** @var false|View $saved */
        $saved = $viewable->views()->save($view);
        throw_if(! $saved, new ViewPersistenceException);

        return $saved;
    }

    public function registerView(Viewable|Model $viewable, View $view): View
    {
        throw_if($this->existsByHash($view->dedup_hash), new ViewDeduplicationException);

        return $this->createView($viewable, $view);
    }

    public function existsBy(array $params): bool
    {
        return View::query()->where($params)->exists();
    }

    public function existsByHash(string $hash): bool
    {
        return $this->existsBy(['dedup_hash' => $hash]);
    }
}
