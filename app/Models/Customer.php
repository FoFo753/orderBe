<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'phoneNumber',
        'fullName',
        'OTP',
        'point',
        'pointRank',
    ];

    public function historyPoints()
    {
        return $this->hasMany(History_point::class, 'id_customer', 'id');
    }
}
