<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WorkingHoursValidator
{
    public function validate(array $request)
    {
        $validator = Validator::make($request, [
            'startTime' => 'required',
            'endTime' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $request;
    }
}
