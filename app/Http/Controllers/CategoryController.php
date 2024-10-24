<?php

namespace App\Http\Controllers;

use App\Services\Category\GetCategoryService;
use App\Services\Category\DeleteCategoryService;
use App\Services\Category\UpdateCategoryService;
use App\Services\Category\CreateCategoryService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getData()
    {
        $data = resolve(GetCategoryService::class)->handle();

        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $data,
        ], Response::HTTP_OK);
    }



    public function create(Request $request)
    {
        $table = resolve(CreateCategoryService::class)->setParams($request->all())->handle();

        if ($table->getStatusCode() === Response::HTTP_BAD_REQUEST) {
            return response()->json(
                ['message' => $table->getData()->message],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json(
            $table->getData(),
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request)
    {
        $table = resolve(UpdateCategoryService::class)->setParams($request->all())->handle();

        if (!$table) return response()->json([
            'message' => 'Lỗi cập nhật'
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'    =>  'Cập nhật thành công',
        ], Response::HTTP_OK);
    }
    public function delete($id)
    {
        $table = resolve(DeleteCategoryService::class)
            ->setParams($id)
            ->handle();

        if (!$table) return response()->json([
            'message' => 'Lỗi',
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'   =>  'Xoá Category thành công',
        ], Response::HTTP_OK);
    }
}
