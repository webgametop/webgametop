<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\VoteCreatedViaCast;
use App\Casts\VoteTypeCast;
use App\Models\Concerns\BelongsToUser;
use Database\Factories\VoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Vote extends Model
{
    /** @use HasFactory<VoteFactory> */
    use HasFactory, BelongsToUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'created_via',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => VoteTypeCast::class,
            'created_via' => VoteCreatedViaCast::class,
        ];
    }

    public function votable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function payload(Game $game): string
    {
        /** @var User $user */
        $user = auth()->user();

        /**
         * @var array{
         *     sub: int,
         *     key: string,
         * } $payload
         */
        $payload = ['sub' => $game->id, 'key' => game_vote__cache_key($user->id)];

        return rtrim(strtr(base64_encode(json_encode($payload)), '+/', '-_'), '=');
    }
}
