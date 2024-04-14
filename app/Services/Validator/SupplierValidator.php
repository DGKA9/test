<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SupplierValidator
{
    public function validate(array $request)
    {
        $validator = Validator::make($request, [
            'supplierName' => 'required|string',
            'supplierAddress' => 'required|string',
            'supplierDescription' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
