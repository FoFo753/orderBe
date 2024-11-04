<?php

namespace App\Services\Food;

use App\Enums\Food\StatusFood;
use App\Enums\Food\TypeFood;
use App\Models\Food;
use App\Services\BaseService;

class GetFoodService extends BaseService
{
    public function handle()
    {
        $data = Food::with('category:id,name')->get();

        if ($data->isEmpty()) return false;

        return $data->map(function ($food) {
            return [
                'id' => $food->id,
                'name' => $food->name,
                'type_label' => TypeFood::getKey($food->type),
                'name_category' => $food->category->name ?? null,
                'cost' => $food->cost,
                'detail' => $food->detail,
                'status' => StatusFood::getKey($food->status),
                'created_at' => $food->created_at,
                'updated_at' => $food->updated_at,
            ];
        });
    }
}
