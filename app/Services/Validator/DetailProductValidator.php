<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class DetailProductValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'productID' => 'required|exists:products,productID',
            'orderID' => 'required|exists:orders,orderID',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
