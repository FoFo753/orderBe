<?php

namespace App\Http\Controllers;

use App\Services\Food\CreateFoodService;
use App\Services\Food\DeleteFoodService;
use App\Services\Food\GetFoodService;
use App\Services\Food\UpdateFoodService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FoodController extends Controller
{
    public function getData()
    {
        $data = resolve(GetFoodService::class)->setParams()->handle();

        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $foodService = resolve(CreateFoodService::class);
        $foodService->setParams($request->all());

        return $foodService->handle();
    }

    public function update(Request $request)
    {
        $foodService = resolve(UpdateFoodService::class);
        $foodService->setParams($request->all());

        return $foodService->handle();
    }

    public function delete($id)
    {
        $foodService = resolve(DeleteFoodService::class);
        $foodService->setParams($id);

        return $foodService->handle();
    }
}
