<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\CommentBuilder;
use App\Models\Concerns\BelongsToUser;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseEloquentBuilder(CommentBuilder::class)]
class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory, BelongsToUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'body',
    ];

    public static function query(): CommentBuilder
    {
        /** @var CommentBuilder */
        return parent::query();
    }
}
