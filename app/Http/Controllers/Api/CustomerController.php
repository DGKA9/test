<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\Validator\CustomerValidator;

class CustomerController extends Controller
{
    protected $customerValidator;

    public function __construct(CustomerValidator $customerValidator)
    {
        $this->customerValidator = $customerValidator;
    }

    public function getById($id)
    {
        $customer = Customer::find($id);
        return $customer ? response()->json($customer, 200) : response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
    }

    public function getAll()
    {
        $customers = Customer::all();
        return response()->json($customers, 200);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->customerValidator->validate($request->all());

            $customer = Customer::create($validatedData);

            return response()->json($customer, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        try {
            $validatedData = $this->customerValidator->validate($request->all());

            $customer->update($validatedData);

            return response()->json($customer, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Khách hàng đã được xóa'], 200);
    }
}
