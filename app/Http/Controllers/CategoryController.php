<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Listado de categoria
    public function index()
    {
        //
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
