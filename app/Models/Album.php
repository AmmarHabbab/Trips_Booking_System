<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    protected $fillable = [
        'id','image','user_id', 'name', 'desc', 'trip_id', 'created_at', 'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    use HasFactory;
}
