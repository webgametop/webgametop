<?php

declare(strict_types=1);

namespace App\Exceptions;

class UserPersistenceException extends EntityPersistenceException
{
    protected static string $entityName = 'User';
}
