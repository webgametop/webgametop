<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class GameVoteNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('You are trying to vote in a non-existent game. Please select another one.');
    }
}
