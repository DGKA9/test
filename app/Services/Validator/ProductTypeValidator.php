<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductTypeValidator
{
    public function validate(array $request)
    {
        $validator = Validator::make($request, [
            'productTypeName' => 'required|string',
            'pt_Description' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $request;
    }
}
