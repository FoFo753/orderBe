<?php

namespace App\Http\Controllers;

use App\Models\Evaluate;
use App\Models\Food;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EvaluateController extends Controller
{
    public function getData()
    {
        $data = Evaluate::with('food')->get();
        
        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $checkFood = Food::where('id', $request->id_food)->first();
        if (!$checkFood) {
            return response()->json([
                'message' => 'Món ăn không tồn tại'
            ], Response::HTTP_BAD_REQUEST);
        }
    
        $evaluate = Evaluate::create([
            'id_food' => $request->id_food,
            'star'    => $request->star,
            'detail'  => $request->detail,
        ]);
    
        return response()->json([
            'data' => $evaluate,
            'message' => 'Tạo đánh giá thành công'
        ], Response::HTTP_CREATED);
    }
    

    public function update(Request $request)
{
    $evaluate = Evaluate::find($request->id);
    if (!$evaluate) {
        return response()->json([
            'message' => 'Không tìm thấy đánh giá'
        ], Response::HTTP_NOT_FOUND);
    }

    $evaluate->update($request->all());

    return response()->json([
        'data' => $evaluate,
        'message' => 'Cập nhật thành công'
    ], Response::HTTP_OK);
}


    public function delete($id)
    {
        $evaluate = Evaluate::find($id);
        if ($evaluate) {
            $evaluate->delete();

            return response()->json([
                'message' => 'Xóa thành công',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Đánh giá này không tồn tại',
        ], Response::HTTP_BAD_REQUEST);
    }
}
