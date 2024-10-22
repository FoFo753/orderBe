<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Services\BaseService;

class DeleteCartService extends BaseService
{
    public function handle()
    {
        $cart = Cart::find($this->data);

        if (!$cart) return false;

        return $cart->delete();
    }
}
