<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class UserHeartbeat
{
    private const OFFLINE_THRESHOLD_MINUTES = 3;

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Facades\Auth::check()) {
            return $next($request);
        }

        /** @var ?User $user */
        $user = Facades\Auth::user();

        $now = Carbon::now();
        $expiresAt = $now->copy()->subMinutes(self::OFFLINE_THRESHOLD_MINUTES);
        $lastSeenAt = Carbon::parse($user->last_seen_at);

        $keyCache = 'users:{id}:online';
        $ttlCache = $expiresAt->diffInSeconds($now);

        $key = cache_key(Str::replace('{id}', $user->id, $keyCache));

        if (! Facades\Cache::has($key)) {
            Facades\Cache::put($key, true, $ttlCache);

            $user->timestamps = false;
            $user->updateQuietly(['last_seen_at' => $now]);
        }

        return $next($request);
    }
}
