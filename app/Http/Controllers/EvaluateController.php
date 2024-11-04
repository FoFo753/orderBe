<?php

namespace App\Http\Controllers;

use App\Models\Evaluate;
use App\Services\Evaluate\CreateEvaluateService;
use App\Services\Evaluate\DeleteEvaluateService;
use App\Services\Evaluate\GetEvaluateService;
use App\Services\Evaluate\UpdateEvaluateService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EvaluateController extends Controller
{
    public function getData($id_food)
    {
        $data = resolve(GetEvaluateService::class)->setParams($id_food)->handle();

        if (count($data) == 0) {
            return response()->json([
                'message' => 'Không có đánh giá nào',
            ]);
        }

        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công',
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $evaluate = resolve(CreateEvaluateService::class)->setParams($request->all())->handle();

        if ($evaluate->getStatusCode() === Response::HTTP_BAD_REQUEST) {
            return response()->json(
                ['message' => $evaluate->getData()->message],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json([
            'data' => $evaluate->getData(),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $cart = resolve(UpdateEvaluateService::class)->setParams($request->all())->handle();

        if (!$cart) return response()->json([
            'message' => 'Lỗi cập nhật'
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'    =>  'Cập nhật thành công',
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $evaluate = resolve(DeleteEvaluateService::class)
            ->setParams($id)
            ->handle();

        if (!$evaluate) {
            return response()->json([
                'message' => 'Lỗi xóa',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => 'Xóa thành công',
        ], Response::HTTP_OK);
    }
}
