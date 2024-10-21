<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $fillable = [
        "name",
        "type",
        "id_category",
        "cost",
        "detail",
        "status",
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_food');
    }
}
