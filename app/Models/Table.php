<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable=[
        'number',
        'status',
    ];
    public function carts()
    {
        return $this->hasMany(Cart::class, 'id_table');
    }
}
