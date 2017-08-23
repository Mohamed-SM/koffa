<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
