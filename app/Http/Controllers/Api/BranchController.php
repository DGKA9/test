<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Services\Validator\BranchValidator;

class BranchController extends Controller
{
    protected $branchValidator;

    public function __construct(BranchValidator $branchValidator)
    {
        $this->branchValidator = $branchValidator;
    }

    public function getById($id)
    {
        $branch = Branch::find($id);
        return $branch ? response()->json($branch, 200) : response()->json(['message' => 'Không tìm thấy chi nhánh'], 404);
    }

    public function getAll()
    {
        $branches = Branch::all();
        return response()->json($branches, 200);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->branchValidator->validate($request->all());

            $branch = Branch::create($validatedData);

            return response()->json($branch, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Không tìm thấy chi nhánh'], 404);
        }

        try {
            $validatedData = $this->branchValidator->validate($request->all());

            $branch->update($validatedData);

            return response()->json($branch, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Không tìm thấy chi nhánh'], 404);
        }

        $branch->delete();

        return response()->json(['message' => 'Chi nhánh đã được xóa'], 200);
    }
}
