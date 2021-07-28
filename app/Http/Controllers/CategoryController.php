<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    //Listado de categoria
    public function index()
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

    //formulario de crear categoria
    public function create()
    {
        //
    }

    //Guardar categoria
    public function store(Request $request)
    {
        //
    }
    public function categoriaProducto($id){
        $productos=Product::Where('category_id',$id)->where('status',0)->paginate(8);
        return view('Cliente.Categoria.ProductoCategoria',compact('productos'));
    }
    //NI IDEA 
    public function show($id)
    {
        //
    }

    //formulario de editar categoria
    public function edit($id)
    {
        //
    }
    //Actualizar categoria
    public function update(Request $request, $id)
    {
        //
    }

    //Eliminar categoria
    public function destroy($id)
    {
        //
    }
}
