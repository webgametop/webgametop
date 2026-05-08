<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\CommentPersistenceException;
use App\Models\Comment;
use App\Models\Contracts\Commentable;
use Illuminate\Database\Eloquent\Model;

class CommentService
{
    public function createComment(Commentable|Model $commentable, Comment $comment): Comment
    {
        /** @var false|Comment $saved */
        $saved = $commentable->comments()->save($comment);
        throw_if(! $saved, new CommentPersistenceException);

        return $saved;
    }
}
