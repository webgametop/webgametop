<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class GameVoteNotFoundException extends EntityNotFoundException
{
    protected static string $entityName = 'Game';
}
