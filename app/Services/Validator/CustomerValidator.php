<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerValidator
{
    public function validate(array $request)
    {
        $validator = Validator::make($request, [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'userID' => 'required|exists:users,userID',
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return $request;
    }
}
