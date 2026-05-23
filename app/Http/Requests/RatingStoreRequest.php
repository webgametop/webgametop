<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\RateableType;
use App\Enums\RatingType;
use Illuminate\Validation\Rule;

class RatingStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'rate' => ['required', 'string', Rule::enum(RatingType::class)],
            'rateable.type' => ['required', 'string', Rule::enum(RateableType::class)],
            'rateable.id' => ['required', 'int'],
        ];
    }
}
