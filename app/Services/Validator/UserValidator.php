<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserValidator
{
    public function validate(array $request, $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($userId ? ",{$userId},UserID" : ''),
            'password' => 'required|string|min:6',
            'roleID' => 'required|exists:roles,RoleID',
        ];

        $validator = Validator::make($request, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $request;
    }
}
