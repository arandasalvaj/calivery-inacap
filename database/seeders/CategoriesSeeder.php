<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category -> name="Infantil";
        $category ->save();

        $category1 = new Category();
        $category1 -> name="Regalo y Accesorios";
        $category1 ->save();

        $category2 = new Category();
        $category2 -> name="Salud y belleza";
        $category2 ->save();

        $category3 = new Category();
        $category3 -> name="Tiempo Libre";
        $category3 ->save();

        $category4 = new Category();
        $category4 -> name="Vestuario y Calzado ";
        $category4 ->save();

        $category5 = new Category();
        $category5 -> name="Artesanias y Manualidades";
        $category5 ->save();

        $category6 = new Category();
        $category6 -> name="Decohogar";
        $category6 ->save();

        $category7 = new Category();
        $category7 -> name="Tecnologia";
        $category7 ->save();
    }
}
