<?php

declare(strict_types=1);

namespace App\Exceptions;

abstract class EntityPersistenceException extends \RuntimeException
{
    protected static string $entityName = 'entity';

    public function __construct(string $action = 'saved')
    {
        parent::__construct(sprintf('%s not %s, please try again later.', static::$entityName, $action));
    }
}
