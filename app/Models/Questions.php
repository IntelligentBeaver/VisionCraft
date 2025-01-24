<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = ['question_text', 'question_type', 'question_category'];
    
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}