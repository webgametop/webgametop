<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class GameVoteLimitExceededException extends Exception
{
    public function __construct()
    {
        parent::__construct('You already voted today. Come back tomorrow.');
    }
}
