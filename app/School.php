<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany('App\Student');
    }
}
