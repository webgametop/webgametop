<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\VotableType;
use Illuminate\Validation\Rule;

class VoteStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'votable.type' => ['required', 'string', Rule::enum(VotableType::class)],
            'votable.id' => ['required', 'integer'],
        ];
    }
}
