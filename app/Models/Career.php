<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public function surveys() {
        return $this->hasMany(Survey::class);
    }

    public function industry() {
        return $this->belongsTo(Industry::class);
    }

    public function recommendations() {
        return $this->hasMany(Recommendation::class);
    }
}