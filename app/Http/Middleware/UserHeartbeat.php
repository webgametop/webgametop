<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades;
use Symfony\Component\HttpFoundation\Response;

class UserHeartbeat
{
    private const OFFLINE_THRESHOLD_MINUTES = 15;

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

        $cache_ttl = $expiresAt->diffInSeconds($now);
        $cache_key = $user->getCacheKeyOnline();

        if (! Facades\Cache::has($cache_key)) {
            Facades\Cache::put($cache_key, 'heartbeat', $cache_ttl);

            $user->timestamps = false;
            $user->updateQuietly(['last_seen_at' => $now]);
        }

        return $next($request);
    }
}
