<?php

declare(strict_types=1);

namespace App\Enums;

use App\Attributes\HashingAlgoMetadata as Metadata;

enum HashingAlgo: string
{
    #[Metadata('secure')]
    case SHA256 = 'sha256';
    #[Metadata('secure')]
    case SHA384 = 'sha384';
    #[Metadata('secure')]
    case SHA512 = 'sha512';
    #[Metadata('legacy')]
    case MD5 = 'md5';

    public function isSecure(): bool
    {
        return $this->getCategory() === 'secure';
    }

    public function getCategory(): string
    {
        return $this->getMetadata()->category;
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
