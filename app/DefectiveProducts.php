<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefectiveProducts extends Model
{
    public function  product(){
        return $this->belongsToMany('App\products');
    }
    public function branch(){
        return $this->belongsToMany('App\Branch');
    }
}
