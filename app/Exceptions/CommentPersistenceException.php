<?php

declare(strict_types=1);

namespace App\Exceptions;

class CommentPersistenceException extends EntityPersistenceException
{
    protected static string $entityName = 'Comment';
}
