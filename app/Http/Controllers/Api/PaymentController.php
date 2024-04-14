<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\Validator\PaymentValidator;

class PaymentController extends Controller
{
    protected $paymentValidator;

    public function __construct(PaymentValidator $paymentValidator)
    {
        $this->paymentValidator = $paymentValidator;
    }

    public function getById($id)
    {
        $payment = Payment::find($id);
        return $payment ? response()->json($payment, 200) : response()->json(['message' => 'Không tìm thấy phương thức thanh toán'], 404);
    }

    public function getAll()
    {
        $payments = Payment::all();
        return response()->json($payments, 200);
    }

    public function create(Request $request)
    {
        $validatedData = $this->paymentValidator->validate($request->all());
        $payment = Payment::create($validatedData);
        return response()->json($payment, 201);
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Không tìm thấy phương thức thanh toán'], 404);
        }
        $validatedData = $this->paymentValidator->validate($request->all());
        $payment->update($validatedData);
        return response()->json($payment, 200);
    }

    public function delete($id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Không tìm thấy phương thức thanh toán'], 404);
        }
        $payment->delete();
        return response()->json(['message' => 'Phương thức thanh toán đã được xóa'], 200);
    }
}
