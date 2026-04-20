<?php

declare(strict_types=1);

namespace App\Services\FileStorages;

use App\Enums\FileStorageType as StorageType;
use Illuminate\Support\Facades\Storage;

class LocalStorage implements FileStorage
{
    public function put(string $path, $contents): void
    {
        Storage::disk('public')->put($path, $contents);
    }

    public function delete(string $path): void
    {
        Storage::disk('public')->delete($path);
    }

    public function getStorageType(): StorageType
    {
        return StorageType::LOCAL;
    }
}
