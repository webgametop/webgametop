<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\UserStatusCast;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

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

    public function gravatar(int $size = 192): string
    {
        return gravatar($this->email, $size);
    }

    public function getCacheKeyOnline(): string
    {
        return user_online_key($this->id);
    }

    public function isOnline(): bool
    {
        return Cache::has($this->getCacheKeyOnline());
    }
}
