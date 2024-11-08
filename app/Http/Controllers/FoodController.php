<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FoodController extends Controller
{
    public function getData()
    {
        $dataFood = Food::get();

        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $dataFood,
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $check = Food::where('name', $request->name)->first();

        if ($check) {
            return response()->json([
                'message' => 'Món ăn đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $food = Food::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Tạo món ăn thành công',
            'data' => $food,
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $food = Food::find($request->id);

        if (!$food) {
            return response()->json([
                'message' => 'Không có món ăn này',
                'data' => null,
            ], Response::HTTP_BAD_REQUEST);
        }

        $food->update($request->all());

        return response()->json([
            'message' => 'Cập nhật món ăn thành công',
            'data' => $food,
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $food = Food::find($id);

        if ($food) {
            $food->delete();

            return response()->json([
                'message' => 'Xoá món ăn thành công',
                'id' => $id,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Món ăn không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
