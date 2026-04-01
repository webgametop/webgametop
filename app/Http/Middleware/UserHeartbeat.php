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

        $now = Carbon::now();
        $expiresAt = $now->copy()->subMinutes(15);

        $keyCache = 'users:{id}:online';
        $ttlCache = $expiresAt->diffInSeconds($now);

        /** @var ?User $user */
        $user = Facades\Auth::user();

        /** @var string $key */
        if (! Facades\Cache::has($key = Str::replace('{id}', $user->id, $keyCache))) {
            Facades\Cache::put($key, true, $ttlCache);
        }

        return $next($request);
    }
}
