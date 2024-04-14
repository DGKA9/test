<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingService;
use App\Services\Validator\BookingServiceValidator;
use Illuminate\Http\Request;

class BookingServiceController extends Controller
{
    protected $bookingServiceValidator;

    public function __construct(BookingServiceValidator $bookingServiceValidator)
    {
        $this->bookingServiceValidator = $bookingServiceValidator;
    }

    public function getById($id)
    {
        $bookingService = BookingService::find($id);
        return $bookingService ? response()->json($bookingService, 200) : response()->json(['message' => 'Không tìm thấy dịch vụ đặt hàng'], 404);
    }

    public function getAll()
    {
        try {
            $bookingServices = BookingService::all();
            return response()->json($bookingServices, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->bookingServiceValidator->validate($request->all());

            $bookingService = BookingService::create($validatedData);

            return response()->json($bookingService, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $bookingService = BookingService::find($id);
        if (!$bookingService) {
            return response()->json(['message' => 'Không tìm thấy dịch vụ đặt hàng'], 404);
        }

        try {
            $validatedData = $this->bookingServiceValidator->validate($request->all());

            $bookingService->update($validatedData);

            return response()->json($bookingService, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $bookingService = BookingService::find($id);
        if (!$bookingService) {
            return response()->json(['message' => 'Không tìm thấy dịch vụ đặt hàng'], 404);
        }

        $bookingService->delete();

        return response()->json(['message' => 'Dịch vụ đặt hàng đã được xóa'], 200);
    }
}
