<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Recommendation extends Model
{
     public function user() {
        return $this->belongsTo(User::class);
    }

    public function career() {
        return $this->belongsTo(Career::class);
    }

}