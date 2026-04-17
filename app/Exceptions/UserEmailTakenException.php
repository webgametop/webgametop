<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserEmailTakenException extends Exception
{
    public function __construct()
    {
        parent::__construct('Oops! This email address is already taken and cannot be used for registration.');
    }
}
