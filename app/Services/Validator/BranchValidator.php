<?php

namespace App\Services\Validator;

use Illuminate\Support\Facades\Validator;

class BranchValidator
{
    public function validate(array $data)
    {
        return Validator::make($data, [
            'branchName' => 'required|string',
            'branchAddress' => 'required|string',
            'branchPhone' => 'required|string',
            'workingHoursID' => 'required|exists:working__hours,workingHoursID',
        ])->validate();
    }
}
