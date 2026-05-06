<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use App\Enums\ViewableType;
use Illuminate\Validation\Rule;

/**
 * @property-read string $viewable_type
 * @property-read int $viewable_id
 * @property-read int $user_id
 */
class ViewStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'viewable_type' => ['required', 'string', Rule::enum(ViewableType::class)],
            'viewable_id' => ['required', 'integer'],
            'user_id' => ['integer', 'nullable'],
        ];
    }
}
