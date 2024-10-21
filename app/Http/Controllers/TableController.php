<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TableController extends Controller
{
    public function getData()
    {
        $dataTable = Table::get();

        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $dataTable
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $check = Table::where('number', $request->number)->first();

        if ($check) {
            return response()->json([
                'message' => 'Số bàn này đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $table = Table::create([
            'number'   => $request->number,
            'status'   => $request->status,
        ]);

        return response()->json([
            'message' => 'tạo bàn thành công',
            'data' => $table,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $table = Table::find($request->id);

        if (!$table) {
            return response()->json([
                'message' => 'Không tìm thấy bàn',
                'data' => $table,
            ], Response::HTTP_BAD_REQUEST);
        }

        $table->update($request->all());

        return response()->json([
            'message' => 'Cập nhật thành công',
            'data' => $table,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $check = Table::find($id);

        if ($check) {
            $check->delete();

            return response()->json([
                'message' => 'Xoá thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'id bàn không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
