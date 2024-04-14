<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail_Product;
use Illuminate\Http\Request;
use App\Services\Validator\DetailProductValidator;

class DetailProductController extends Controller
{
    protected $detailProductValidator;

    public function __construct(DetailProductValidator $detailProductValidator)
    {
        $this->detailProductValidator = $detailProductValidator;
    }

    public function getById($id)
    {
        $detail = Detail_Product::find($id);
        return $detail ? response()->json($detail, 200) : response()->json(['message' => 'Không tìm thấy chi tiết sản phẩm'], 404);
    }

    public function getAll()
    {
        $details = Detail_Product::all();
        return response()->json($details, 200);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->detailProductValidator->validate($request->all());

            $detail = Detail_Product::create($validatedData);

            return response()->json($detail, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $detail = Detail_Product::find($id);
        if (!$detail) {
            return response()->json(['message' => 'Không tìm thấy chi tiết sản phẩm'], 404);
        }

        try {
            $validatedData = $this->detailProductValidator->validate($request->all(), $id);

            $detail->update($validatedData);

            return response()->json($detail, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $detail = Detail_Product::find($id);
        if (!$detail) {
            return response()->json(['message' => 'Không tìm thấy chi tiết sản phẩm'], 404);
        }

        $detail->delete();

        return response()->json(['message' => 'Chi tiết sản phẩm đã được xóa'], 200);
    }
}
