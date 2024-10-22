<?php

namespace App\Services\Cart;

use App\Models\Table;
use App\Models\Cart; 
use App\Services\BaseService;

class DeleteCartTableService extends BaseService
{
    public function handle()
    {
        $table = Table::find($this->data);

        if (!$table) return false; 

        $cartItems = Cart::where('id_table', $table->id)->get();

        if ($cartItems->isEmpty()) return false; 

        foreach ($cartItems as $item) {
            $item->delete();
        }

        return true; 
    }
}
