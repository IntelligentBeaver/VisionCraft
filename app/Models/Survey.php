<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'survey_id');
    }

}