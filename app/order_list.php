<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_list extends Model
{
    public function  product(){
        return $this->belongsToMany('App\products');
    }
    public function  Saler(){
        return $this->belongsToMany('App\Saler');
    }
}
   

