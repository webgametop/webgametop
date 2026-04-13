<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\GameVoteFactory as VoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVote extends Model
{
    /** @use HasFactory<VoteFactory> */
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'vote_dt',
        'name_ca',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'vote_dt' => 'date',
        ];
    }
}
