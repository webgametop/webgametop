<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\File;
use App\Models\User;
use App\Services\FileStorages\FileStorage;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Str;

class UploadService
{
    public function __construct(
        private readonly FileService $fileService,
        private readonly FileStorage $storage,
    )
    {
    }

    public function handleUpload(HttpFile $file, User $uploader)
    {
        // 1. checksum
        $checksum = hash_file('sha256', $file->getRealPath(), true);

        // 3. имя
        $ext = $file->extension();
        $name = Str::random(32) . ($ext ? '.' . $ext : '');

        $dir = 'files/' . now()->format('Y/m');
        $path = $dir . '/' . $name;

        // 4. сохраняем (stream — важно!)
        $stream = fopen($file->getRealPath(), 'rb');
        $this->storage->put($path, $stream);
        fclose($stream);

        // 5. запись в БД
        return File::create([
            'original_name' => $file->getBasename(),
            'storage_name' => $name,
            'storage_path' => $path,
            'size_bytes' => $file->getSize(),
            'extension' => $ext,
            'mime_type' => $file->getMimeType(),
            'checksum' => $checksum,
            'uploaded_by' => $uploader->id,
        ]);
    }
}
