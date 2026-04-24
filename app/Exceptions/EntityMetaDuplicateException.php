<?php

namespace App\Exceptions;

use Exception;

class EntityMetaDuplicateException extends Exception
{
    public function __construct()
    {
        parent::__construct('Metadata already exists for this entity and key.');
    }
}
