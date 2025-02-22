<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Questions;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'survey_id', 'answer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}