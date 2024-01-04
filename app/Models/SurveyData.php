<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyData extends Model
{
    protected $fillable = [
        'id', 'attend', 'opinion', 'user_id', 'survey_id', 'created_at', 'updated_at'
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class,'survey_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    use HasFactory;
}
