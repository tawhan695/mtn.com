<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportProducts extends Model
{
    public function  product(){
        return $this->belongsToMany('App\products');
    }
    public function branch(){
        return $this->belongsToMany('App\Branch');
    }
    public function hash_branch(){
        return $this->branch()->first()->name;
    }
}
