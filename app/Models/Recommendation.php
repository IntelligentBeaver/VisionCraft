<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class Recommendation extends Model
{
     public function user() {
        return $this->belongsTo(Users::class);
    }

    public function career() {
        return $this->belongsTo(Career::class);
    }

}