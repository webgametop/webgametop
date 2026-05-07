<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ViewDeduplicationException;
use App\Exceptions\ViewPersistenceException;
use App\Models\View;
use App\Values\View\ViewCreateData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ViewService
{
    public function createView(ViewCreateData $dto): View
    {
        $view = View::make($dto->toArray());

        /** @var ?Model $target */
        $target = app($dto->getViewableType())->find($dto->getViewableId());
        throw_if(! $target, new ModelNotFoundException('Viewable model not found.', 404));

        /** @var false|View $saved */
        $saved = $target->views()->save($view);
        throw_if(! $saved, new ViewPersistenceException);

        return $saved;
    }

    public function registerView(ViewCreateData $dto): View
    {
        throw_if($this->existsByHash($dto->getHash()), new ViewDeduplicationException);

        return $this->createView($dto);
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
