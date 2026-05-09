<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\CommentableType;
use Illuminate\Validation\Rule;

class CommentStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'commentable.type' => ['required', 'string', Rule::enum(CommentableType::class)],
            'commentable.id' => ['required', 'integer'],
            'comment.parent_id' => ['integer', 'nullable', 'exists:comments,id'],
            'comment.body' => ['required', 'string'],
        ];
    }
}
