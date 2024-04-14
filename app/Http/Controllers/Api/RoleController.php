<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\Validator\RoleValidator;

class RoleController extends Controller
{
    protected $roleValidator;

    public function __construct(RoleValidator $roleValidator)
    {
        $this->roleValidator = $roleValidator;
    }

    public function getById($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Không tìm thấy vai trò'], 404);
        }
        return response()->json($role, 200);
    }

    public function getAll()
    {
        $roles = Role::all();
        return response()->json($roles, 200);
    }

    public function create(Request $request)
    {
        try {
            //$validatedData = $this->roleValidator->validate($request->all());
            $role = Role::create($request->all());
            return response()->json($role, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Không tìm thấy vai trò'], 404);
        }

        try {
            $validatedData = $this->roleValidator->validate($request->all());
            $role->update($validatedData);
            return response()->json($role, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function delete($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['message' => 'Không tìm thấy vai trò'], 404);
        }

        $role->delete();

        return response()->json(['message' => 'Vai trò đã được xóa'], 200);
    }
}
