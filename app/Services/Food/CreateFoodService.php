<?php

namespace App\Services\Food;

use App\Models\Food;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateFoodService extends BaseService
{
    public function handle()
    {
        $existingFood = Food::where('name', $this->data['name'])->exists();

        if ($existingFood) {
            return response()->json([
                'message' => 'Món ăn đã tồn tại',
            ], Response::HTTP_BAD_REQUEST);
        }

        $food = Food::create($this->data);

        return response()->json([
            'food' => $food,
        ], Response::HTTP_CREATED);
    }
}
