<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_point extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'point',
        'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
}
