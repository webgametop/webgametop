<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\GameBuilder;
use App\Models\Concerns\Games\HasGameRelationships;
use App\Models\Concerns\MorphsToMetadata;
use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 */
#[UseEloquentBuilder(GameBuilder::class)]
class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory, MorphsToMetadata, HasGameRelationships;

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

    public function payload(): string
    {
        /** @var User $user */
        $user = \Auth::user();

        /**
         * @var array{
         *     sub: int,
         *     key: string,
         * } $payload
         */
        $payload = ['sub' => $this->id, 'key' => game_vote_key($user->id)];

        return rtrim(strtr(base64_encode(json_encode($payload)), '+/', '-_'), '=');
    }
}
