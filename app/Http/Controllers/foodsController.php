<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class foodsController extends Controller
{
    public function getData()
    {
        $foods = Food::get();

        return response()->json([
            'message' => 'Lấy danh sách thành công',
            'data' => $foods,
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $foods = Food::where('name', $request->name)->first();

        if ($foods) {
            return response()->json([
                'message' => 'Món này đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $foods = Food::create([
            'name'   => $request->name,
            'type'   => $request->type,
            'id_category'   => $request->id_category,
            'cost'   => $request->cost,
            'detail'   => $request->detail,
            'status'   => $request->status,
        ]);

        return response()->json([
            'message' => 'Tạo món mới thành công',
            'data' => $foods,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $foods = Food::where('name', $request->name)->first();

        if (!$foods) {
            return response()->json([
                'message' => 'Không có món này',
                'data' => $foods,
            ], Response::HTTP_BAD_REQUEST);
        }

        $foods->update($request->all());

        return response()->json([
            'message' => 'Cập nhật món thành công',
            'data' => $foods,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $foods = Food::where('name', $id)
            ->first();

        if ($foods) {
            $foods->delete();

            return response()->json([
                'message' => 'Xoá món thành công',
                'data' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Không có món này',
            'data' => $foods,
        ], Response::HTTP_BAD_REQUEST);
    }
}
