<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id', 'payment_type', 'amount', 'status', 'created_at', 'updated_at', 'trip_id', 'user_id','coupon_id'
    ];

    public function books()
    {
        return $this->hasOne(Booking::class);
    }

    public function coupons()
     {
        return $this->belongsTo(Coupon::class,'coupon_id');
     }

    use HasFactory;
}
