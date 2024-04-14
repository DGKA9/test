<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class PaymentValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'payMethod' => 'required|string',
        ]);

        return $validator->validate();
    }
}
