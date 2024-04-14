<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evaluate;
use Illuminate\Http\Request;
use App\Services\Validator\EvaluateValidator;

class EvaluateController extends Controller
{
    protected $evaluateValidator;

    public function __construct(EvaluateValidator $evaluateValidator)
    {
        $this->evaluateValidator = $evaluateValidator;
    }

    public function getById($id)
    {
        $evaluate = Evaluate::find($id);
        return $evaluate ? response()->json($evaluate, 200) : response()->json(['message' => 'Không tìm thấy đánh giá'], 404);
    }

    public function getAll()
    {
        $evaluates = Evaluate::all();
        return response()->json($evaluates, 200);
    }

    public function create(Request $request)
    {
        try {
           // $validatedData = $this->evaluateValidator->validate($request->all());
            $evaluate = Evaluate::create($request->all());
            return response()->json($evaluate, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $evaluate = Evaluate::find($id);
        if (!$evaluate) {
            return response()->json(['message' => 'Không tìm thấy đánh giá'], 404);
        }

        try {
            $validatedData = $this->evaluateValidator->validate($request->all());

            $evaluate->update($validatedData);

            return response()->json($evaluate, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $evaluate = Evaluate::find($id);
        if (!$evaluate) {
            return response()->json(['message' => 'Không tìm thấy đánh giá'], 404);
        }

        $evaluate->delete();

        return response()->json(['message' => 'Đánh giá đã được xóa'], 200);
    }
}
