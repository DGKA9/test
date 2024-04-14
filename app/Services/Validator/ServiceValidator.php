<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceValidator
{
    public function validate(array $request)
    {
        $validator = Validator::make($request, [
            'serviceName' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'serviceTime' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $request;
    }
}
