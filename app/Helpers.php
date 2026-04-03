<?php

declare(strict_types=1);

use App\Services\GravatarService;

function urlGravatar(string $email, int $size = 192): string
{
    return GravatarService::url($email, $size);
}
