<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserPersistenceException extends Exception
{
    public function __construct(string $action = 'saved')
    {
        parent::__construct("User not $action, please try again later.");
    }
}
