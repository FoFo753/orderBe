<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'id_table',
        'id_food',
        'quantity',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }
}
