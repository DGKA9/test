<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Validator\OrderValidator;

class OrderController extends Controller
{
    protected $orderValidator;
    
    public function __construct(OrderValidator $orderValidator)
    {
        $this->orderValidator = $orderValidator;
    }

    public function getById($id)
    {
        $order = Order::find($id);
        return $order ? response()->json($order, 200) : response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
    }

    public function getAll()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->orderValidator->validate($request->all());
            $order = Order::create($validatedData);
            return response()->json($order, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
        try {
            $validatedData = $this->orderValidator->validate($request->all());
            $order->update($validatedData);
            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
        $order->delete();
        return response()->json(['message' => 'Đơn hàng đã được xóa'], 200);
    }
}
