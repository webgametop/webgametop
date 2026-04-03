<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\UserStatusCast;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades;
use Illuminate\Support;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'username',
        'nickname',
        'email',
        'password',
        'last_seen_at',
        'autologin_token',
        'registration_ip_hash',
        'registration_country',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => UserStatusCast::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_seen_at' => 'datetime',
        ];
    }

    public function equals(self $other): bool
    {
        return $this->is($other);
    }

    public function isOnline(): bool
    {
        $keyCache = 'users:{id}:online';

        $key = cache_key(Support\Str::replace('{id}', $this->id, $keyCache));

        return Facades\Cache::has($key);
    }

    public function gravatar(int $size = 192): string
    {
        return url_gravatar($this->email, $size);
    }
}
