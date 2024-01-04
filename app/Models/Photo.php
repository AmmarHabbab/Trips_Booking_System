<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'id', 'path', 'album_id', 'user_id', 'created_at', 'updated_at'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class,'album_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    use HasFactory;
}
