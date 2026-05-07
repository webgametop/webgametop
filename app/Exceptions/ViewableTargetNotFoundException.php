<?php

declare(strict_types=1);

namespace App\Exceptions;

class ViewableTargetNotFoundException extends EntityNotFoundException
{
    protected static string $entityName = 'Target';
}
