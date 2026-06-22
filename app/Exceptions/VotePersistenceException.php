<?php

declare(strict_types=1);

namespace App\Exceptions;

class VotePersistenceException extends EntityPersistenceException
{
    protected static string $entityName = 'Vote';
}
