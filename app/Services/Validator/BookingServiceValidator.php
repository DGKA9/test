<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class BookingServiceValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'bookingID' => 'required|exists:bookings,bookingID',
            'serviceID' => 'required|exists:services,serviceID',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
