<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\DeveloperBuilder;
use App\Casts\DeveloperProviderCast;
use Database\Factories\DeveloperFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UseEloquentBuilder(DeveloperBuilder::class)]
class Developer extends Model
{
    /** @use HasFactory<DeveloperFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'provider',
        'identity',
        'dedup_hash',
        'slug',
        'name',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'provider' => DeveloperProviderCast::class,
        ];
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
