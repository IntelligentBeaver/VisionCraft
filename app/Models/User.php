<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name',
        'email',
        'password',
        'google_id',
        'linkedin_id',
        'age',
        'image',
        'location',
        'skills',
        'education',
        'experience',
        'gender',
        'interest',];
    protected $hidden = ['password', 'remember_token'];
    public function recommendations() {
        return $this->hasMany(Recommendation::class);
    }
    public function skills() {
    return $this->hasMany(Skill::class);
}
public function resume() {
    return $this->hasOne(Resume::class);
}
}