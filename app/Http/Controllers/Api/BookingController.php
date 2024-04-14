<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\Validator\BookingValidator;

class BookingController extends Controller
{
    protected $bookingValidator;

    public function __construct(BookingValidator $bookingValidator)
    {
        $this->bookingValidator = $bookingValidator;
    }

    public function getAll()
    {
        $bookings = Booking::all();
        return response()->json($bookings, 200);
    }

    public function getById($id)
    {
        $booking = Booking::find($id);
        return $booking ? response()->json($booking, 200) : response()->json(['message' => 'Không tìm thấy booking'], 404);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->bookingValidator->validate($request->all());

            $booking = Booking::create($validatedData);

            return response()->json($booking, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Không tìm thấy booking'], 404);
        }

        try {
            $validatedData = $this->bookingValidator->validate($request->all());

            $booking->update($validatedData);

            return response()->json($booking, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Không tìm thấy booking'], 404);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking đã được xóa'], 200);
    }
}
