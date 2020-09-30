<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function  users(){
        return $this->belongsToMany('App\User');
    }
    public function  product(){
        return $this->belongsToMany('App\products');
    }
    public function  Import(){
        return $this->belongsToMany('App\ImportProducts');
    }
   
}
