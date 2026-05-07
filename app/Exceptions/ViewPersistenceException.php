<?php

declare(strict_types=1);

namespace App\Exceptions;

class ViewPersistenceException extends EntityPersistenceException
{
    protected static string $entityName = 'View';
}
