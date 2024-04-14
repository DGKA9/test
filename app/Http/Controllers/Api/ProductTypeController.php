<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Services\Validator\ProductTypeValidator;

class ProductTypeController extends Controller
{
    protected $productTypeValidator;

    public function __construct(ProductTypeValidator $productTypeValidator)
    {
        $this->productTypeValidator = $productTypeValidator;
    }

    public function getById($id)
    {
        $product = ProductType::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        return response()->json($product, 200);
    }

    public function getAll()
    {
        try{
        $products = ProductType::all();
        return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->productTypeValidator->validate($request->all());
            $product = ProductType::create($validatedData);
            return response()->json($product, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = ProductType::findOrFail($id);
            $validatedData = $this->productTypeValidator->validate($request->all());
            $product->update($validatedData);
            return response()->json($product, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Cập nhật sản phẩm không thành công'], 422);
        }
    }

    public function delete($id)
    {
        try {
            $product = ProductType::findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'Sản phẩm đã được xóa'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Xóa sản phẩm không thành công'], 422);
        }
    }
}
