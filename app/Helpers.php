<?php

declare(strict_types=1);

use App\Services\GravatarService;

function url_gravatar(string $email, int $size = 192): string
{
    return GravatarService::url($email, $size);
}

/**
 * Simple, non-cryptographically secure hash function for strings.
 * This is used for generating hashes for identifiers that do not require high security.
 */
function simple_hash(?string $string): string
{
    return md5("noilty-hash:$string");
}

/**
 * @param string|int ...$parts
 */
function cache_key(...$parts): string
{
    return simple_hash(implode('.', $parts));
}
