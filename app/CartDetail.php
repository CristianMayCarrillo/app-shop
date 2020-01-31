<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    //CartDetail N       product // un producto se puedde asociar con varios detalles de carritos de compras
    public function product()
    {
       return $this->belongsTo(Product::class);
    }
}
