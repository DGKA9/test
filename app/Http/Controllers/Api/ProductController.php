<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Validator\ProductValidator;

class ProductController extends Controller
{
    protected $productValidator;

    public function __construct(ProductValidator $productValidator)
    {
        $this->productValidator = $productValidator;
    }

    public function getById($id)
    {
        $product = Product::with('Supplier', 'ProductType')->find($id);
        return $product ? response()->json($product, 200) : response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
    }

    public function getAll()
    {
        $products = Product::with('Supplier', 'ProductType')->get();
        return response()->json($products, 200);
    }

    public function create(Request $request)
    {
        $validatedData = $this->productValidator->validate($request->all());

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }

        $validatedData = $this->productValidator->validate($request->all());

        $product->update($validatedData);

        return response()->json($product, 200);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Sản phẩm đã được xóa'], 200);
    }
}
