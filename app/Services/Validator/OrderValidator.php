<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class OrderValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'orderDate' => 'required|date',
            'deliveryDate' => 'required|date',
            'orderStatus' => 'required|string',
            'totalInvoice' => 'required',
            'customerID' => 'required|exists:customers,customerID',
            'paymentID' => 'required|exists:payments,paymentID',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}
