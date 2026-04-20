<?php

declare(strict_types=1);

namespace App\Services\FileStorages;

use App\Enums\FileStorageType as StorageType;
use Illuminate\Support\Facades\Storage;

class LocalStorage extends FileStorage
{
    public function put(string $path, $contents): void
    {
        Storage::disk($this->getStorageType())->put($path, $contents);
    }

    public function delete(string $location): void
    {
        Storage::disk($this->getStorageType())->delete($location);
    }

    public function url(string $path): string
    {
        return Storage::disk($this->getStorageType())->url($path);
    }

    public function getStorageType(): StorageType
    {
        return StorageType::LOCAL;
    }
}
