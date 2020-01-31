<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');//

Route::post('/cart', 'CartDetailController@store');//
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () { //Estos dos Middleware estan funcioando sobre todas estas rutas
    Route::get('/products', 'ProductController@index');//listado
    Route::get('/products/create', 'ProductController@create');//ver formulario
    Route::post('/products', 'ProductController@store');//Registrar y hacer que se guarden en la bd
    Route::get('/products/{id}/edit', 'ProductController@edit');//formulario de edicion
    Route::post('/products/{id}/edit', 'ProductController@update');//formulario de Actualizar
    Route::delete('/products/{id}', 'ProductController@destroy');//formulario de Eliminacion con parametro id


    Route::get('/products/{id}/images', 'ImageController@index');//listado
    Route::post('/products/{id}/images', 'ImageController@store');//Registrar y hacer que se guarden en la bd
    Route::delete('/products/{id}/images', 'ImageController@destroy');//formulario de Eliminacion
    Route::get('/products/{id}/images/select/{image}', 'ImageController@select');//Destacar Imagen
    
});



//CR
//UD

//PUT PATCH DELETE --> petIcion PARAS SER MAS ESPECIFICOS
