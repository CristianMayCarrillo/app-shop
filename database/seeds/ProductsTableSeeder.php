<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*//ModelFactories
        factory(Category::class, 5)->create();
        factory(Product::class, 100)->create();
        factory(ProductImage::class, 200)->create();*/

        $categories = factory(Category::class, 4)->create();
        //para cada category ejecuta la sig. funcion
        $categories->each(function ($category) {
            $products = factory(Product::class, 5)->make(); //crea 20 productos por cada categoria
            $category->products()->saveMany($products);

            $products->each(function ($p) {
                $images = factory(ProductImage::class, 3)->make();
                $p->images()->saveMany($images);
            });
        });



        /*
        //QUE CREE 3 USUARIOS
        $users = factory(App\User::class, 3)
        ->create()
        ->each(function ($u) { // cada usuario va a tener una publucacion
            //el metodo save guarda el post en la BD y asiga atributo userid
            $u->posts()->save(factory(App\Post::class)->make());
        });*/
    }
}
