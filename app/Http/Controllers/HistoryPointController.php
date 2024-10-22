<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\History_point;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HistoryPointController extends Controller
{
    public function getData()
    {
        $data = History_point::with('customer')->get();
        
        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $checkCustomer = Customer::where('id', $request->id_customer)->first();
        if (!$checkCustomer) {
            return response()->json([
                'message' => 'Khách hàng không tồn tại'
            ], Response::HTTP_BAD_REQUEST);
        }

        $historyPoint = History_point::create([
            'id_customer' => $request->id_customer,
            'point'       => $request->point,
            'date'        => $request->date,
        ]);

        return response()->json([
            'data' => $historyPoint,
            'message' => 'Tạo lịch sử điểm thành công'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $historyPoint = History_point::find($request->id);
        if (!$historyPoint) {
            return response()->json([
                'message' => 'Không tìm thấy lịch sử điểm'
            ], Response::HTTP_NOT_FOUND);
        }

        $historyPoint->update($request->all());

        return response()->json([
            'data' => $historyPoint,
            'message' => 'Cập nhật thành công'
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $historyPoint = History_point::find($id);
        if ($historyPoint) {
            $historyPoint->delete();

            return response()->json([
                'message' => 'Xóa thành công',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Lịch sử điểm này không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
