<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;

class GameVoteStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'key' => 'required|string',
        ];
    }
}
