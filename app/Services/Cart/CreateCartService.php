<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Table;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class CreateCartService extends BaseService
{
    public function handle()
    {
        $check = Cart::where('id_table', $this->data['id_table'])
            ->where('id_food', $this->data['id_food'])
            ->first();

        if ($check) {
            $checkUpdate = resolve(UpdateCartService::class)->setParams([
                'id' => $check->id,
                'quantity' => $this->data['quantity']
            ])->handle();

            if ($checkUpdate) return response()->json([
                'message'    =>  'Cập nhật thành công',
            ]);

            return response()->json([
                'message'    =>  'lỗi cập nhật',
            ]);
        };

        $table = Table::find($this->data['id_table']);
        $food = Food::find($this->data['id_food']);

        if (!$table || !$food) return response()->json([
            'message' => 'no ban, no food'
        ], Response::HTTP_BAD_REQUEST);

        $cart = Cart::create([
            'id_table'  => $this->data['id_table'],
            'id_food'   => $this->data['id_food'],
            'quantity'  => $this->data['quantity'],
        ]);

        return response()->json([
            'cart' => $cart
        ], Response::HTTP_CREATED);
    }
}
