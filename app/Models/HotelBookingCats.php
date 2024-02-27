<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBookingCats extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'booking_id', 
        'cat_id' 
    ];
}
