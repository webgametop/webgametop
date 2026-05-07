<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class ViewDeduplicationException extends Exception
{
    public function __construct()
    {
        parent::__construct('Duplicate view within the current time window.', 409);
    }
}
