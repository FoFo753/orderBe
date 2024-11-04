<?php

namespace App\Services\Evaluate;

use App\Models\Evaluate;
use App\Models\Food;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateEvaluateService extends BaseService
{
    public function handle()
    {
        $food = Food::find($this->data['id_food']);

        if (!$food) {
            return response()->json([
                'message' => 'Không tìm thấy thức ăn'
            ], Response::HTTP_BAD_REQUEST);
        }

        $evaluate = Evaluate::create([
            'id_food' => $this->data['id_food'],
            'star'    => $this->data['star'],
            'detail'  => $this->data['detail'],
        ]);

        return response()->json([
            'evaluate' => $evaluate,
            'message' => 'Đánh giá thành công',
        ], Response::HTTP_CREATED);
    }
}
