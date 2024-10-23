<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";
    protected $fillable = [
        'id_table',
        'timeBooking',
        'id_food',
        'quantity',
    ];

    public function food(): HasMany
    {
        return $this->hasMany(Food::class, 'id', 'id_food');
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'id_table');
    }
}
