<?php

declare(strict_types=1);

namespace App\Services\FileStorages;

use App\Enums\FileStorageType;

abstract class FileStorage
{
    abstract public function put(string $path, $contents): void;

    abstract public function delete(string $path): void;

    abstract public function url(string $path): string;

    abstract public function getStorageType(): FileStorageType;
}
