<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\ProductImage;
use File;



class ImageController extends Controller
{    //es el que se encarga de devolver la informacion del producto y de las imagenes asociadas al producto
    public function index($id)
    {  
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured', 'desc')->get();
        return view('admin.products.images.index')->with(compact('product', 'images'));

    }
    public function store(Request $request, $id)
    {
        //guardar la imagen en  nuestro proyecto
        $file = $request->file('photo'); //obtiene el archivo por medio de la variable $file
        $path = public_path() . '/images/products'; //la ruta donde se guardara la imagn concatenabdo con la ruta images de products
        $fileName = uniqid() . $file->getClientOriginalName();//Nombre para el archivo con un idunico concatenado com el nombre original del archivo qie se esta subiedno
        $moved = $file->move($path, $fileName); //orden para guardar

        //crear el registro en la bd , product_images
        if ($moved) {
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage->featured = false;
            $productImage->product_id = $id;
            $productImage->save(); //Insert
        }

        return back();
    }
    public function destroy(Request $request, $id)
    {   
        //Elimnar el archivo (IMAGEN)
        $productImage = ProductImage::find($request->image_id);
        //si la imagen es una url completa la variable delete tendra valor true, por que esta eliminada
        //nunca formo parte de los archivps
        if (substr($productImage->image, 0, 4) === "http")  {
            $deleted = true; 
        // Si no empiezaa con 'Http' si lo vamos a eliminar     
        } else {
            $fullPath = public_path() . '/images/products/' . $productImage->image;
            $deleted =  File::delete($fullPath); //donde se ubica la iamgen    
        }
        //eliminar el registro de la imagen en la bd
        if ($deleted) {
            $productImage->delete();
        }

        return back();
    }
    public function select($id, $image)
    {   //todas las imagesn de prodicto que esten asociadas con el producto que tiene este id se van actualizar en base al campo featured
        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);

        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
