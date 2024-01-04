<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'id', 'coupon_code', 'discount_percentage', 'expiry_date', 'status', 'created_at', 'updated_at', 'user_id'
    ];
    protected $casts = [
        'expiry_date' => 'datetime'
    ];
    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function users()
     {
        return $this->belongsTo(User::class,'user_id');
     }
     
    use HasFactory;
}
