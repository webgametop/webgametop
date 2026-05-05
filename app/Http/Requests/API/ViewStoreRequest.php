<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\ValidationRule;

class ViewStoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'viewable_type' => 'required|string',
            'viewable_id' => 'required|integer',
        ];
    }
}
