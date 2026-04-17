<?php

declare(strict_types=1);

namespace App\Http\Requests\API;

use App\Http\Requests\Request as BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends BaseRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(
            response()->json([
                'ok' => false,
                'message' => 'Failed validation.',
                'errors' => $errors,
            ], 422)
        );
    }
}
