<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Table;
use App\Models\Food;
use App\Services\Cart\CreateCartService;
use App\Services\Cart\DeleteCartService;
use App\Services\Cart\DeleteCartTableService;
use App\Services\Cart\GetCartService;
use App\Services\Cart\UpdateCartService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseStatusCodeSame;

class CartController extends Controller
{
    public function getData($id_table)
    {
        $data = resolve(GetCartService::class)->setParams($id_table)->handle();

        if (count($data) == 0) return response()->json([
            'message'   =>  'giỏ hàng rỗng'
        ]);

        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $cart = resolve(CreateCartService::class)->setParams($request->all())->handle();

        if ($cart->getStatusCode() === Response::HTTP_BAD_REQUEST) {
            return response()->json(
                ['message'  => $cart->getData()->message],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json([
            $cart->getData()
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $cart = resolve(UpdateCartService::class)->setParams($request->all())->handle();

        if (!$cart) return response()->json([
            'message' => 'Lỗi cập nhật'
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'    =>  'Cập nhật thành công',
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $cart = resolve(DeleteCartService::class)
            ->setParams($id)
            ->handle();

        if (!$cart) return response()->json([
            'message' => 'Lỗi xóa',
        ], Response::HTTP_BAD_REQUEST);

        return response()->json([
            'message'   =>  'Xoa ok',
        ], Response::HTTP_OK);
    }

    public function deleteAllFoodFromTable($id_table)
    {
        $cartService = resolve(DeleteCartTableService::class)
            ->setParams($id_table)
            ->handle();

        if (!$cartService) {
            return response()->json([
                'message' => 'Lỗi xóa',
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => 'Xóa tất cả thành công',
        ], Response::HTTP_OK);
    }
}
