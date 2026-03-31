<?php

declare(strict_types=1);

use App\Services\GravatarService;

function gravatar(string $email, int $size = 192): string
{
    return GravatarService::url($email, $size);
}
