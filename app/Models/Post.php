<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id', 'title', 'slug','content', 'image', 'user_id', 'category_id', 'created_at', 'updated_at','deleted_at'
    ];

    public function category()
    {
       return $this->belongsTo(Category::class , 'category_id');
    }


    public function user()
    {
       return $this->belongsTo(User::class , 'user_id');
    }

    public function likes()
    {
       return $this->hasMany(Like::class);
    }

    public function comments()
    {
       return $this->hasMany(Comment::class);
    }
    
    use HasFactory;
}
