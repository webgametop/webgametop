<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\GameBuilder;
use App\Models\Concerns\Games\HasGameRelationships;
use App\Models\Concerns\MorphsToComments;
use App\Models\Concerns\MorphsToFavorites;
use App\Models\Concerns\MorphsToRatings;
use App\Models\Concerns\MorphsToViews;
use App\Models\Concerns\MorphsToVotes;
use Database\Factories\GameFactory;
use App\Models\Concerns\Games\HasGameAttributes;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read bool $is_favorite
 * @property-read bool $is_rating
 * @property-read int $likes_count
 * @property-read int $dislikes_count
 * @property-read int $likes_percentage
 * @property-read string $url
 * @property-read string $display
 */
#[UseEloquentBuilder(GameBuilder::class)]
class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory,
        HasGameAttributes,
        HasGameRelationships,
        MorphsToViews,
        MorphsToComments,
        MorphsToFavorites,
        MorphsToRatings,
        MorphsToVotes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'developer_id',
        'identity',
        'dedup_hash',
        'slug',
        'title',
        'description',
        'released_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'released_at' => 'datetime',
        ];
    }

    public static function query(): GameBuilder
    {
        /** @var GameBuilder */
        return parent::query();
    }
}
