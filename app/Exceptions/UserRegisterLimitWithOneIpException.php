<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserRegisterLimitWithOneIpException extends Exception
{
    public function __construct()
    {
        parent::__construct('Maximum number of registrations from this IP address has been reached.');
    }
}
