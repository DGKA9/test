<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class EmployeeValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'image' => 'nullable|string',
            'workDay' => 'nullable',
            'userID' => 'required|exists:users,userID',
            'branchID' => 'required|exists:branches,branchID',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->first();
            throw new \Exception($errors);
        }

        return $data;
    }
}
