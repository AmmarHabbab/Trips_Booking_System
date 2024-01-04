<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $fillable = [
        'id', 'body', 'user_id', 'created_at', 'updated_at'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    use HasFactory;
}
