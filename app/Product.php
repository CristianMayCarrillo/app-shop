<?php
//este es un modelo
//Un producto pertenece a una categoria y una categoria tiene varios productos
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //aque categoria pertenece un producto determinado

    //$product->category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //$product->images
    public function images()
    {
        return $this->hasmany(ProductImage::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        $featuredImage = $this->images()->where('featured', true)->first();
        if (!$featuredImage) //si el producto no tiene una imagen destacada
        $featuredImage = $this->images()->first();

        if  ($featuredImage){ //si encuentra imagen asociada devuelve la url de la imagen
            return $featuredImage->url;
        }

        //devolver imagen por defecto
        return '/images/products/default.jpg';
        
    }

}
