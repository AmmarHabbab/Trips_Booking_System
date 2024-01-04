<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'id', 'name','info','image', 'area',
        'location', 'status','seats','pricesy','priceusd',
        'hotel_id','start_date','expiry_date','type'
    ];

    public function books()
    {
        return $this->hasMany(Booking::class);
    }
//     protected $dates = [
//     'start_date',
//     'expiry_date',
// ];

protected $casts = [
    'start_date' => 'datetime',
    'expiry_date' => 'datetime',
];
    public $timestamps = false;
    use HasFactory;
}
