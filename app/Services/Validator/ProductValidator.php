<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class ProductValidator
{
    public function validate(array $data)
    {
        $validator = Validator::make($data, [
            'productName' => 'required|string',
            'productImage' => 'required|string',
            'productPrice' => 'required',
            'productQuantity' => 'required',
            'productDescription' => 'required|string',
            'productTypeID' => 'required|exists:product_types,productTypeID',
            'supplierID' => 'required|exists:suppliers,supplierID',
        ]);

        $validator->validate();

        return $validator->validated();
    }
}
