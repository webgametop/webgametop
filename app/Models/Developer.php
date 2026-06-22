<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\DeveloperBuilder;
use App\Casts\DeveloperProviderCast;
use App\Models\Concerns\Developers\HasDeveloperAttributes;
use App\Models\Concerns\Developers\HasDeveloperRelationships;
use App\Models\Concerns\MorphsToComments;
use App\Models\Concerns\MorphsToFavorites;
use App\Models\Concerns\MorphsToRatings;
use App\Models\Concerns\MorphsToViews;
use Database\Factories\DeveloperFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read bool $is_favorite
 * @property-read bool $is_rating
 * @property-read int $likes_count
 * @property-read int $dislikes_count
 * @property-read string $url
 * @property-read string $display
 */
#[UseEloquentBuilder(DeveloperBuilder::class)]
class Developer extends Model
{
    /** @use HasFactory<DeveloperFactory> */
    use HasFactory,
        HasDeveloperAttributes,
        HasDeveloperRelationships,
        MorphsToViews,
        MorphsToComments,
        MorphsToFavorites,
        MorphsToRatings;

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
}
