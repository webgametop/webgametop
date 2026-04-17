<?php

declare(strict_types=1);

namespace App\Attributes\Contracts;

interface HasMetadata
{
    public function getMetadata(): object;
}
