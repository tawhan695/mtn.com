<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saler extends Model
{
    public function  product_list(){
        return $this->belongsToMany('App\order_list');
    }
    public function branch(){
        return $this->belongsToMany('App\Branch');
    }
    public function  users(){
        return $this->belongsToMany('App\User');
    }
}
