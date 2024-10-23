<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_bookings',
        'timeEnd',
        'total',
        'id_user',
    ];

    public function bookings($id_bookings = null)
    {
        $bookings = Booking::query();
        $listIdBooking = explode(',', $id_bookings); // '1,2,3,4' => [1,2,3,4]
        $bookings->where(function ($query) use ($listIdBooking) {
            $query->whereIn('id', $listIdBooking);
        });

        return $bookings->with('food')->get();
    }
}
