<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id', 'seats', 'user_id', 'trip_id', 'hotel_id', 'room_id', 'payment_id', 'created_at', 'updated_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function trips()
    {
        return $this->belongsTo(Trip::class,'trip_id');
    }

    public function payments()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }

    public function translaters()
    {
        return $this->belongsTo(Translater::class,'translater_id');
    }
    use HasFactory;
}
