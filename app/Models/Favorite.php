<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\FavoriteBuilder;
use Database\Factories\FavoriteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /** @use HasFactory<FavoriteFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
    ];

    public static function query(): FavoriteBuilder
    {
        /** @var FavoriteBuilder */
        return parent::query();
    }
}
