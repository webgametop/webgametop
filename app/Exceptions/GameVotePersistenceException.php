<?php

declare(strict_types=1);

namespace App\Exceptions;

class GameVotePersistenceException extends EntityPersistenceException
{
    protected static string $entityName = 'Vote';
}
