<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //$category->products
    public function products()
    {
        //una categoria tiene muchos products
        return $this->hasmany(Product::class);
    }
}
