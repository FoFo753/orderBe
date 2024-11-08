<?php

namespace App\Services\Food;

use App\Models\Food;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class DeleteFoodService extends BaseService
{
    public function handle()
    {
        $food = Food::find($this->data);

        if (!$food) {
            return response()->json([
                'message' => 'Không tìm thấy món ăn',
            ], Response::HTTP_NOT_FOUND);
        }

        $food->delete();

        return response()->json([
            'message' => 'Xoá món ăn thành công',
        ], Response::HTTP_OK);
    }
}
