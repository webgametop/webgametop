<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\DeveloperBuilder;
use App\Casts\DeveloperProviderCast;
use App\Models\Concerns\Developers\HasDeveloperAttributes;
use App\Models\Concerns\Developers\HasDeveloperRelationships;
use App\Models\Concerns\MorphsToComment;
use App\Models\Concerns\MorphsToFavorites;
use App\Models\Concerns\MorphsToRating;
use App\Models\Concerns\MorphsToView;
use Database\Factories\DeveloperFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read bool $is_favorite
 * @property-read bool $is_rating
 * @property-read int $likes_count
 * @property-read int $dislikes_count
 */
#[UseEloquentBuilder(DeveloperBuilder::class)]
class Developer extends Model
{
    /** @use HasFactory<DeveloperFactory> */
    use HasFactory,
        HasDeveloperAttributes,
        HasDeveloperRelationships,
        MorphsToView,
        MorphsToComment,
        MorphsToFavorites,
        MorphsToRating;

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

    public function favoriteable(): MorphTo
    {
        return $this->morphTo();
    }
}
