<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\Validator\ServiceValidator;

class ServiceController extends Controller
{
    protected $serviceValidator;

    public function __construct(ServiceValidator $serviceValidator)
    {
        $this->serviceValidator = $serviceValidator;
    }

    public function getById($id)
    {
        $service = Service::find($id);
        return $service ? response()->json($service, 200) : response()->json(['message' => 'Không tìm thấy dịch vụ'], 404);
    }

    public function getAll()
    {
        $services = Service::all();
        return response()->json($services, 200);
    }

    public function create(Request $request)
    {
        try{
            $validatedData = $this->serviceValidator->validate($request->all());
            $validatedData['serviceName'] = $request->input('serviceName');
            $validatedData['description'] = $request->input('description');
            $service = Service::create($validatedData);
            return response()->json($service, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Không tìm thấy dịch vụ'], 404);
        }
        $validatedData = $this->serviceValidator->validate($request->all());
        $service->update($validatedData);
        return response()->json($service, 200);
    }

    public function delete($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Không tìm thấy dịch vụ'], 404);
        }

        $service->delete();
        return response()->json(['message' => 'Dịch vụ đã được xóa'], 200);
    }
}
