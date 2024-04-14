<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RoleValidator
{
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $request)
    {
        $validator = Validator::make($request, [
            'roleName' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toArray();
        }

        return true;
    }
}
