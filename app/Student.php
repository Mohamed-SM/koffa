<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function schools()
    {
        return $this->belongsToMany('App\School');
    }
}
