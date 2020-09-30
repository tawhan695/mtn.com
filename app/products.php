<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
         'image',
         'name',
         'retail',
         'wholesale',
         'qty',
         'type',
         'des',
    ];
      // สาขา
      public function branch(){
        return $this->belongsToMany('App\Branch');
    }
}
