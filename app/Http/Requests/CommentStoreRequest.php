<?php

declare(strict_types=1);

namespace App\Http\Requests;

class CommentStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'comment.body' => ['required', 'string'],
        ];
    }
}
