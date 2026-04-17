<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades;
use Illuminate\Support;
use Illuminate\Validation\ValidationException;

class UserLoginRequest extends Request
{
    private const MAX_ATTEMPTS = 5;

    public function rules(): array
    {
        return [
            'user.email' => ['required', 'string', 'email'],
            'user.password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        /**
         * @var array{
         *     password: string,
         *     email: string,
         * } $data
         */
        $data = $this->only('user.password', 'user.email')['user'];

        if (! Facades\Auth::attempt($data, $this->boolean('user.remember'))) {
            Facades\RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Facades\RateLimiter::clear($this->throttleKey());
    }

    private function ensureIsNotRateLimited(): void
    {
        $key = $this->throttleKey();

        if (! Facades\RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            return;
        }

        event(new Lockout($this));

        $seconds = Facades\RateLimiter::availableIn($key);

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    private function throttleKey(): string
    {
        $ip = $this->normalizeIp($this->ip());
        $ua = preg_replace('/\d+\.\d+/', '*', $this->userAgent());

        $email = $this->string('user.email');

        return Support\Str::transliterate(implode('|', [$ip, $ua, Support\Str::lower($email)]));
    }

    private function normalizeIp(string $ip): string
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return inet_ntop(substr(inet_pton($ip), 0, 8) . str_repeat("\0", 8));
        }

        return $ip;
    }
}
