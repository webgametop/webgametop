<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\FavoriteableType;
use Illuminate\Validation\Rule;

class FavoriteToggleRequest extends Request
{
    public function rules(): array
    {
        return [
            'favoriteable.type' => ['required', 'string', Rule::enum(FavoriteableType::class)],
            'favoriteable.id' => ['required', 'integer'],
        ];
    }
}
