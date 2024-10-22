<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Services\BaseService;
use Symfony\Component\HttpFoundation\Response;

class UpdateCartService extends BaseService
{
    public function handle()
    {
        $cart = Cart::find($this->data['id']);

        if (!$cart) return false;

        return $cart->update([
            'quantity' => $this->data['quantity'] + $cart->quantity,
        ]);
    }
}
