<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\Contracts\HasMetadata as Contract;
use App\Attributes\HashingAlgoMetadata as Attribute;
use App\Traits\HasMetadataTrait;

enum HashingAlgo: string implements Contract
{
    use HasMetadataTrait;

    #[Attribute('secure', 256)]
    case SHA256 = 'sha256';
    #[Attribute('secure', 512)]
    case SHA512 = 'sha512';
    #[Attribute('legacy', 128)]
    case MD5 = 'md5';
    #[Attribute('legacy', 160)]
    case SHA1 = 'sha1';

    public function isSecure(): bool
    {
        return $this->getCategory() === 'secure';
    }

    public function getHexLength(): int
    {
        return intdiv($this->getBits(), 4);
    }

    public function getCategory(): string
    {
        return $this->getMetadata()->category;
    }

    public function getBits(): int
    {
        return $this->getMetadata()->bits;
    }

    public function getMetadata(): object
    {
        return $this->getInstance(Attribute::class);
    }
}
