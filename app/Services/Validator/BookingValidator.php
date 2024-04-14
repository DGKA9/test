<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BookingValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'appointmentDate' => 'required|date',
            'startTime' => 'required',
            'endTime' => 'required',
            'note' => 'nullable|string',
            'customerID' => 'required|exists:customers,customerID',
        ]);

        $validator->validate();

        return $data;
    }
}
