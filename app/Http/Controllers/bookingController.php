<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class bookingController extends Controller
{

    public function getData()
    {
        $booking = Booking::get();

        return response()->json([
            'message' => 'lấy data Booking thành công',
            '' => $booking,
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {

        $booking = Booking::where('id_tables', $request->id_tables)
            ->where('id_food', $request->id_food)
            ->first();


        if ($booking) {
            return response()->json([
                'message' => 'Booking này đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $booking = Booking::create([
            'id_tables'   => $request->id_tables,
            'timeBooking' => $request->timeBooking,
            'id_food'     => $request->id_food,
            'quantity'    => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Tạo Booking thành công',
            'data' => $booking,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $booking = Booking::where('id_tables', $request->id_tables)
            ->where('id_food', $request->old_id_food)
            ->first();

        if (!$booking) {
            return response()->json([
                'message' => 'không có booking này',
                'data' => $booking,
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($request->has('new_id_food')) {
            $booking->id_food = $request->new_id_food;
        }

        if ($request->has('quantity')) {
            $booking->quantity = $request->quantity;
        }

        if ($request->has('timeBooking')) {
            $booking->timeBooking = $request->timeBooking;
        }

        $booking->save();

        return response()->json([
            'message' => 'Cập nhật booking thành công',
            'data' => $booking,
        ], Response::HTTP_OK);
    }

    public function delete($id, $id2)
    {
        $booking = Booking::where('id_tables', $id)
            ->where('id_food', $id2)
            ->first();

        if ($booking) {
            $booking->delete();

            return response()->json([
                'message' => 'Xoá booking thành công',
                'id_tables' => $id,
                'id_food' => $id2,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Booking không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
