<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\HashingAlgoMetadata as Metadata;

enum HashingAlgo: string
{
    #[Metadata('secure', 256)]
    case SHA256 = 'sha256';
    #[Metadata('secure', 512)]
    case SHA512 = 'sha512';
    #[Metadata('legacy', 128)]
    case MD5 = 'md5';
    #[Metadata('legacy', 160)]
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

    private function getMetadata(): Metadata
    {
        $reflection = new \ReflectionEnumUnitCase(self::class, $this->name);
        $attributes = $reflection->getAttributes(Metadata::class);

        throw_if(empty($attributes), new \RuntimeException("no metadata found for $this->name"));

        /** @var Metadata $instance */
        $instance = $attributes[0]->newInstance();

        return $instance;
    }
}
