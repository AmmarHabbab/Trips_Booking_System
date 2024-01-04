<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'id', 'stars', 'body', 'trip_id', 'user_id'
    ];
    public function users() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trips() 
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    use HasFactory;
}
