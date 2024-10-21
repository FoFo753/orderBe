<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'id_table',
        'id_food',
        'quantity',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class, 'id_table');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'id_food');
    }
}
