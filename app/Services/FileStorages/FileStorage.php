<?php

declare(strict_types=1);

namespace App\Services\FileStorages;

use App\Enums\FileStorageType;

interface FileStorage
{
    public function put(string $path, $contents): void;

    public function delete(string $path): void;

    public function getStorageType(): FileStorageType;
}
