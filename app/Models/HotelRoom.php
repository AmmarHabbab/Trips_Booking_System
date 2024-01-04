<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $fillable = [
        'id', 'room_type', 'price', 'capacity', 'created_at', 'updated_at', 'hotel_id', 'status'
    ];
    use HasFactory;
}
