<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\File;
use App\Values\File\FileCreateData;

class FileService
{
    public function createFile(FileCreateData $dto): File
    {
        $file = File::make($dto->toArray());

        throw_if(! $file->save(), new \Exception('test save file'));

        return $file;
    }
}
