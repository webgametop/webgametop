<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CommentableType;
use App\Values\Comment\CommentCreateData;
use Illuminate\Validation\Rule;

class CommentStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'commentable.type' => ['required', 'string', Rule::enum(CommentableType::class)],
            'commentable.id' => ['required', 'integer'],
            'comment.parent_id' => ['integer', 'nullable', 'exists:comments,id'],
            'comment.author_id' => ['required', 'integer', 'exists:users,id'],
            'comment.body' => ['required', 'string'],
        ];
    }

    public function toDto(): CommentCreateData
    {
        $commentable_type = (string) $this->input('commentable.type');
        $commentable_id = (int) $this->input('commentable.id');
        $parent_id = is_null($v = $this->input('comment.parent_id')) ? null : (int) $v;
        $user_id = (int) $this->input('comment.author_id');
        $body = (string) $this->input('comment.body');

        return new CommentCreateData(
            $commentable_type,
            $commentable_id,
            $parent_id,
            $user_id,
            $body,
        );
    }
}
