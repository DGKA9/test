<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class EvaluateValidator
{
    public static function validate(array $request)
    {
        return Validator::make($request, [
            'rating' => 'required',
            'comment' => 'nullable|string',
            'lastUpdate' => 'nullable|date',
            'productID' => 'required|exists:products,productID',
            'customerID' => 'required|exists:customers,customerID',
        ]);
    }
}
