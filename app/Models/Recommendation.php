<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Recommendation extends Model
{
    protected $fillable = [
        'user_id',
        'survey_id',
        'job_title',
        'industry',
        'functional_area',
        'role',
        'similarity_score',
    ];
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

}