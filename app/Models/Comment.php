<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id', 'body', 'post_id', 'user_id', 'created_at', 'updated_at'
     ];

     public function users()
     {
        return $this->belongsTo(User::class,'user_id');
     }

     public function posts()
     {
        return $this->belongsTo(Post::class,'post_id');
     }

    use HasFactory;
}
