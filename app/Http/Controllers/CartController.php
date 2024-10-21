<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Table;
use App\Models\Food;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function getData()
    {
        $data = Cart::with(['table', 'food'])->get(); 

        return response()->json([
            'data' => $data,
            'message' => 'Lấy dữ liệu thành công'
        ], Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $check = Cart::where('id_table', $request->id_table)->first();
        if ($check) {
            return response()->json([
                'message' => 'Giỏ hàng đã tồn tại cho bàn này'
            ], Response::HTTP_BAD_REQUEST);
        }

        $table = Table::find($request->id_table);
        $food = Food::find($request->id_food);

        if (!$table || !$food) {
            return response()->json([
                'message' => 'Bàn hoặc món ăn không tồn tại'
            ], Response::HTTP_BAD_REQUEST);
        }

        $cart = Cart::create([
            'id_table'  => $request->id_table,
            'id_food'   => $request->id_food,
            'quantity'  => 1,
        ]);

        return response()->json([
            'data' => $cart,
            'message' => 'Thêm vào giỏ hàng thành công'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request)
    {
        $cart = Cart::find($request->id);
        if (!$cart) {
            return response()->json([
                'message' => 'Giỏ hàng không tồn tại'
            ], Response::HTTP_NOT_FOUND);
        }

        $cart->update($request->all());

        return response()->json([
            'data' => $cart,
            'message' => 'Cập nhật thành công'
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json([
                'message' => 'Xóa giỏ hàng thành công'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Giỏ hàng không tồn tại'
        ], Response::HTTP_NOT_FOUND);
    }
}