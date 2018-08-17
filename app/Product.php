<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //protected $table = 'products';
    protected $fillable = [
      'description', 'price', 'qty', 'type', 'imglink'
    ];

    // public function setColumnAttribute($value){
    //   $this->attributes['column'] = (boolean)($value);
    // }
}
