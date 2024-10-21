<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller
{
    public  function getData()
    {
        $data = Sale::get();

        return response()->json([
            'data' => $data,
            'message' => 'Lấp dữ liệu thành công'
        ], Response::HTTP_OK);
    }
    public function create(Request $request)
    {
        $check = Sale::where('nameSale', $request->nameSale)->first();

        if ($check) {

            return response()->json([
                'message' => 'Tên mã giảm giá này đã tồn tại',
            ], response::HTTP_BAD_REQUEST);
        }

        $sale = Sale::create([
            'nameSale' => $request->nameSale,
            'status' => $request->status,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'percent' => $request->percent,
        ]);

        return response()->json([
            'message' => 'Tạo mã giảm giá thành công',
            'data' => $sale,
        ], Response::HTTP_CREATED);
    }
    public function update(Request $request)
    {
        $sale = Sale::find($request->id);

        if (!$sale) {
            return response()->json([
                'message' => 'Tìm không thấy mã giảm giá',
                'data' => $sale
            ], response::HTTP_BAD_REQUEST);
        }

        $sale->update($request->all());

        return response()->json([
            'message' => 'Cập nhật thành công',
            'data' => $sale
        ], response::HTTP_OK);
    }

    public function delete($id)

    {
        $check = Sale::find($id);
        if ($check) {
            $check->delete();

            return response()->json([
                'message' => 'Xóa thành công',
            ], response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Mã giảm giá này không tồn tại',
        ], response::HTTP_BAD_REQUEST);
    }
}
