<?php

declare(strict_types=1);

use App\Services\GravatarService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

function gravatar(string $email, int $size = 192): string
{
    return GravatarService::url($email, $size);
}

function game_vote_key(int $user_id): string
{
    $template_key = 'game,vote,:date,user,:id';
    $date = Carbon::now()->format('Y/m/d');

    return cache_key(Str::replace([':id', ':date'], [$user_id, $date], $template_key), config('app.key'));
}

function user_online_key(int $user_id): string
{
    $template_key = 'user,:id,online';

    return cache_key(Str::replace(':id', $user_id, $template_key));
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
