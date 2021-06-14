<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    function product(){
        return $this->belongsTo('App\Product');
    }

    function product_stock(){
        return $this->belongsTo('App\ProductStock');
    }

}
