<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;


class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products')); //ver el listado de productos
    }
    public function create() 
    {
        return view('admin.products.create'); //ver formulario de registro
    }
    public function store(Request $request)  //inyeccion de dependencias de laravel
    {
        //Validar Datos 
        $messages = [
            'name.required' => 'Es necesario un nombre para el producto.',
            'name.min' => 'el nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'la descripcion corta es un campo obligatorio.',
            'description.max' => 'la descripcion corta solo admite hasta 200 caracteres.',
            'price.required' => 'es obligatorio un precio para el producto.',
            'price.numeric' => 'Ingrese un precio valido.',
            'price.min' => 'No se admiten valores negativos.'
            

        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price'=> 'required|numeric|min:0'
            
        ];
        $this->validate($request, $rules, $messages); //si encuntra que una regla no se cumple entonces nos redirije ala pag anterior

        //guarde el nuevo  producto en la bd
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save();//INSERT IN THE BD

        return redirect('/admin/products'); //metodo espera como parametro la ruta a que queremos redirigir
    }


    public function edit($id) 
    {
        //return "Mostrar aqui el form de edicion para el prodcto con id $id";
        $product = Product::find($id); //Busca el producto con el id que recibe y lo selecciona para posterior guardar la actualizacion
        return view('admin.products.edit')->with(compact('product')); //devuelve er formulario de registro
    }
    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para el producto.',
            'name.min' => 'el nombre del producto debe tener al menos 3 caracteres.',
            'description.required' => 'la descripcion corta es un campo obligatorio.',
            'description.max' => 'la descripcion maxima solo admite hasta 200 caracteres.',
            'price.required' => 'es obligatorio un precio para el producto.',
            'price.numeric' => 'Ingrese un precio valido.',
            'price.min' => 'No se admiten valores negativos.'
            

        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price'=> 'required|numeric|min:0'
            
        ];
        $this->validate($request, $rules, $messages); //si encuntra que una regla no se cumple entonces nos redirije ala pag anterior
        //dd($request->all());
        $product = Product::find($id); //BUSCA AL PRODUCTO CON ESE ID DE PARAMETRO //UN PRODUCTO QUE HA SIDO UBICADO POR MEDIO DE SU ID
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save();//ACTUALIZA EN LA BASE DE DATOS

        return redirect('/admin/products'); //metodo espera como parametro la ruta a que queremos redirigir
    }

    public function destroy($id)
    {
        //guarde el registro en la bd
        //dd($request->all());
        $product = Product::find($id); //BUSCA AL PRODUCTO CON ESE ID DE PARAMETRO //UN PRODUCTO QUE HA SIDO UBICADO POR MEDIO DE SU ID
        $product->delete();//Elimina y ACTUALIZA EN LA BASE DE DATOS

        return back(); //Redirecciona a la pagina donde estambamos o anterior
    }
    
}
