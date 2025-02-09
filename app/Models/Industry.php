<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{

    public function careers() {
        return $this->hasMany(Career::class);
    }
}