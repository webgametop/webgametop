<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

abstract class EntityNotFoundException extends Exception
{
    protected static string $entityName = 'entity';

    public function __construct()
    {
        parent::__construct(sprintf('You are trying to access in a non-existent entity (%s). Please select another one.', static::$entityName));
    }
}
