<?php

declare(strict_types=1);

namespace App\Traits;

/** @internal works only with enums */
trait HasMetadataTrait
{
    /**
     * @template T of object
     * @param class-string<T> $attributeClass
     * @return ?T
     */
    protected function getInstance(string $attributeClass): ?object
    {
        $reflection = new \ReflectionEnumUnitCase(static::class, $this->name);
        $attributes = $reflection->getAttributes($attributeClass);

        throw_if(
            empty($attributes),
            new \RuntimeException(
                sprintf(
                    'Attribute %s not found for %s::%s',
                    $attributeClass,
                    static::class,
                    $this->name
                )
            )
        );

        return $attributes[0]->newInstance() ?? null;
    }
}
