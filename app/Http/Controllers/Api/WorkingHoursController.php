<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Working_Hours;
use App\Services\Validator\WorkingHoursValidator;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
    protected $workingHoursValidator;
    public function __construct(WorkingHoursValidator $workingHoursValidator)
    {
        $this->workingHoursValidator = $workingHoursValidator;
    }

    public function getAll()
    {
        $workingHours = Working_Hours::all();
        return response()->json($workingHours, 200);
    }

    public function getById($id)
    {
        $workingHours = Working_Hours::find($id);
        return $workingHours ? response()->json($workingHours, 200) : response()->json(['message' => 'Không tìm thấy giờ làm việc'], 404);
    }

    public function create(Request $request)
    {
        $validatedData = $this->workingHoursValidator->validate($request->all());
        $workingHours = Working_Hours::create($validatedData);
        return response()->json($workingHours, 201);
    }

    public function update(Request $request, $id)
    {
        $workingHours = Working_Hours::find($id);
        if (!$workingHours) {
            return response()->json(['message' => 'Không tìm thấy giờ làm việc'], 404);
        }
        $validatedData = $this->workingHoursValidator->validate($request->all());
        $workingHours->update($validatedData);
        return response()->json($workingHours, 200);
    }

    public function delete($id)
    {
        $workingHours = Working_Hours::find($id);
        if (!$workingHours) {
            return response()->json(['message' => 'Không tìm thấy giờ làm việc'], 404);
        }
        $workingHours->delete();
        return response()->json(['message' => 'Giờ làm việc đã được xóa'], 200);
    }
}
