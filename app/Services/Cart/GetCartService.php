<?php

namespace App\Services\Cart;

use App\Models\Cart;
use App\Services\BaseService;

class GetCartService extends BaseService
{
    public function handle()
    {
        $data = Cart::with('table', 'food')
            ->where('id_table', $this->data)
            ->get();

        if (!$data) return false;

        return $data;
    }
}
