<?php

namespace App\Services\Food;

use App\Models\Food;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class UpdateFoodService extends BaseService
{
    public function handle()
    {
        $food = Food::find($this->data['id']);

        if (!$food) {
            return response()->json([
                'message' => 'Không tìm thấy món ăn',
            ], Response::HTTP_NOT_FOUND);
        }

        $food->update([
            'name' => $this->data['name'],
            'type' => $this->data['type'],
            'cost' => $this->data['cost'],
            'detail' => $this->data['detail'],
            'status' => $this->data['status'],
        ]);

        return response()->json([
            'message' => 'Cập nhật thành công',
            'food'    => $food,
        ], Response::HTTP_OK);
    }
}
