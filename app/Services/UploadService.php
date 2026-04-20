<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\HashingFormat;
use App\Models\File;
use App\Models\User;
use App\Services\FileStorages\FileStorage;
use App\Services\Security\HmacHasherService;
use App\Values\File\FileCreateData;
use GuzzleHttp\Client;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile as FormFile;
use Illuminate\Support\Str;

class UploadService
{
    public function __construct(
        private readonly FileService $fileService,
        private readonly FileStorage $storage,
        private readonly HmacHasherService $hasher,
        private readonly Client $client,
    )
    {
    }

    public function handleUpload(HttpFile|FormFile $file, User $uploader): File
    {
        $file_path = $file->path();

        $checksum = hash_file('sha256', $file_path, true);

        $path = 'uploads/:filename';

        $dto = FileCreateData::make(
            $file->getFilename(),
            $filename = Str::random(32),
            Str::replace(':filename', $filename, $path),
            $file->getSize(),
            $file->getMimeType(),
            $file->extension(),
            $this->hasher->hash($checksum, HashingFormat::BINARY),
            $uploader
        );


        $stream = fopen($file_path, 'rb');

        $this->storage->put($dto->path(), $stream);

        fclose($stream);

        return $this->fileService->createFile($dto);
    }

    public function handleUploadFromUrl(string $url, User $uploader): File
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid URL.');
        }

        $temp_path = tempnam(sys_get_temp_dir(), 'url_');

        $this->client->get($url, ['sink' => $temp_path, 'timeout' => 30]);

        $result = $this->handleUpload(new HttpFile($temp_path), $uploader);

        unlink($temp_path);

        return $result;
    }
}
