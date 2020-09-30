<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProducts extends Model
{
    protected $fillable = [
        'image','name', 'retail','wholesale','des',
   ];
}
