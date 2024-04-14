<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\Validator\EmployeeValidator;

class EmployeeController extends Controller
{
    protected $employeeValidator;

    public function __construct(EmployeeValidator $employeeValidator)
    {
        $this->employeeValidator = $employeeValidator;
    }

    public function getById($id)
    {
        $employee = Employee::find($id);
        return $employee ? response()->json($employee, 200) : response()->json(['message' => 'Không tìm thấy nhân viên'], 404);
    }

    public function getAll()
    {
        $employees = Employee::all();
        return response()->json($employees, 200);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->employeeValidator->validate($request->all());

            $employee = Employee::create($validatedData);

            return response()->json($employee, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Không tìm thấy nhân viên'], 404);
        }

        try {
            $validatedData = $this->employeeValidator->validate($request->all());

            $employee->update($validatedData);

            return response()->json($employee, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Không tìm thấy nhân viên'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Nhân viên đã được xóa'], 200);
    }
}
