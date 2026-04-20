<?php

declare(strict_types=1);

namespace App\Enums;

enum FileStorageType: string
{
    case S3 = 's3';
    case SFTP = 'sftp';
    case LOCAL = 'local';
}
