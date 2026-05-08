<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\CommentBuilder;
use App\Models\Concerns\BelongsToUser;
use App\Models\Concerns\Comments\HasCommentRelationships;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Attributes\UseEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[UseEloquentBuilder(CommentBuilder::class)]
class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory, BelongsToUser, HasCommentRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'parent_id',
        'user_id',
        'body',
    ];

    public static function query(): CommentBuilder
    {
        /** @var CommentBuilder */
        return parent::query();
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
