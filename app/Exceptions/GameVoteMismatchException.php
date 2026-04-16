<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class GameVoteMismatchException extends Exception
{
    public function __construct()
    {
        parent::__construct('Oops! Your vote could not be processed. Refresh and try again.');
    }
}
