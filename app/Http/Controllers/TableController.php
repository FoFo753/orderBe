<?php

namespace App\Http\Controllers;

use App\Services\Table\CreateTableService;
use App\Services\Table\DeleteTableService;
use App\Services\Table\GetTableService;
use App\Services\Table\UpdateTableService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TableController extends Controller
{
    public function getData()
    {
        $dataTable = resolve(GetTableService::class)->handle();

        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => $dataTable,
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $table = resolve(CreateTableService::class)->setParams($request->all())->handle();

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
        $table = resolve(UpdateTableService::class)->setParams($request->all())->handle();

        if (!$table) return response()->json([
            'message' => 'Lỗi cập nhật',
            'data' =>  $table,
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'    =>  'Cập nhật thành công',
        ], Response::HTTP_OK);
    }
    public function delete($id)
    {
        $table = resolve(DeleteTableService::class)
            ->setParams($id)
            ->handle();

        if (!$table) return response()->json([
            'message' => 'Lỗi',
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'   =>  'Xoá Table thành công',
        ], Response::HTTP_OK);
    }
}
