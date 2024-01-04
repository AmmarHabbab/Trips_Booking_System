<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'id', 'name', 'desc', 'status', 'created_at', 'updated_at'
    ];

    public function surveydata()
    {
        return $this->hasMany(SurveyData::class);
    }
    
    use HasFactory;
}
