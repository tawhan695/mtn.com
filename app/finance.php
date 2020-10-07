<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finance extends Model
{
    public function branch(){
        return $this->belongsToMany('App\Branch');
    }
}
