<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Services\Validator\SupplierValidator;

class SupplierController extends Controller
{
    protected $supplierValidator;

    public function __construct(SupplierValidator $supplierValidator)
    {
        $this->supplierValidator = $supplierValidator;
    }

    public function getById($id)
    {
        $supplier = Supplier::find($id);
        return $supplier ? response()->json($supplier, 200) : response()->json(['message' => 'Không tìm thấy nhà cung cấp'], 404);
    }

    public function getAll()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers, 200);
    }

    public function create(Request $request)
    {
        $validatedData = $this->supplierValidator->validate($request->all());

        $supplier = Supplier::create($validatedData);

        return response()->json($supplier, 201);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Không tìm thấy nhà cung cấp'], 404);
        }

        $validatedData = $this->supplierValidator->validate($request->all());

        $supplier->update($validatedData);

        return response()->json($supplier, 200);
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Không tìm thấy nhà cung cấp'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Nhà cung cấp đã được xóa'], 200);
    }
}
