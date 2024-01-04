<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextWidget extends Model
{
    protected $fillable = [
        'id', 'name', 'body', 'location', 'image', 'created_at', 'updated_at'
    ];
    use HasFactory;
}
