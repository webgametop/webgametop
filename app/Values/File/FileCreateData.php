<?php

declare(strict_types=1);

namespace App\Values\File;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;

final readonly class FileCreateData implements Arrayable
{
    public function __construct(
        private string $original_name,
        private string $filename,
        private string $path,
        private int $size,
        private string $mime_type,
        private string $extension,
        private string $dedup_hash,
        private User $uploader,
    )
    {
    }

    public static function make(
        string $original_name,
        string $filename,
        string $path,
        int $size,
        string $mime_type,
        string $extension,
        string $dedup_hash,
        User $uploader,
    ) : self {
        return new self(
            $original_name,
            $filename,
            $path,
            $size,
            $mime_type,
            $extension,
            $dedup_hash,
            $uploader,
        );
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function toArray(): array
    {
        return [
            'original_name' => $this->original_name,
            'filename' => $this->filename,
            'path' => $this->path,
            'disk' => 'local',
            'size' => $this->size,
            'mime_type' => $this->mime_type,
            'extension' => $this->extension,
            'dedup_hash' => $this->dedup_hash,
            'uploaded_by' => $this->uploader->id,
        ];
    }
}
