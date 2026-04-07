<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'developer_id',
        'original_id',
        'dedup_hash',
        'title',
        'description',
    ];

    public function developer(): HasOne
    {
        return $this->hasOne(Developer::class);
    }
}
