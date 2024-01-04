<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id','name','desc', 'image', 'deleted_at', 'created_at', 'updated_at','user_id'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    use HasFactory;
}
