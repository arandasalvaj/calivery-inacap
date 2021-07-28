<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //listado de Productos
    public function index()
    {
        $StoreP=Store::where('user_id',Auth::user()->id)->first();
        $productos=Product::where('store_id',$StoreP->id)->get();
        
        return view('Vendedor.Tienda.Producto.index',compact('productos'));
    }

    //Formulario de crear Productos
    public function create()
    {
        $categorias=Category::all();
        return view('Vendedor.Tienda.Producto.create',compact('categorias'));
    }

    //Guardar Productos
    public function store(Request $request)
    {
        $imagen=$request->img->store('uploads','public');
        $url= Storage::url($imagen);
        $user = Auth::user();
        $tienda = Store::where('user_id',$user->id)->first();
        $productos = new Product();
        $productos -> name = $request->nombre;
        $productos -> stock = $request->stock;
        $productos -> price = $request->precio;
        $productos -> detail =  $request->detalle;
        $productos -> category_id = $request->categoria;
        $productos -> store_id = $tienda->id;
        $productos -> img = $url;
        $productos -> color = $request->color;
        $productos->save(); 
        $StoreP=Store::where('user_id',Auth::user()->id)->first();
        $productos=Product::where('store_id',$StoreP->id)->get();
        
        session()->flash('success_add','Producto registrado exitosamente.');
        return view('Vendedor.Tienda.Producto.index', compact('productos'))->with("success_add",'Producto registrado exitosamente!');
    }

    //NI IDEA 
    public function show($id)
    {
        //
    }

    //Formulario de editar Productos
    public function edit($id)
    {
        $producto = Product::find($id);
        $categorias=Category::all();
        return view('Vendedor.Tienda.Producto.edit',compact('categorias','producto'));
    }

    //Actualizar Productos
    public function update(Request $request, $id)
    {
        $productos = Product::find($id);
        if(!$request->img==null){
            $imagen=$request->img->store('uploads','public');
            $url= Storage::url($imagen);
            $productos -> img = $url;
        }
        $tienda = Store::where('user_id',Auth::user()->id)->first();
        if($request->detalle==null){
            $productos -> detail =  $request->detail;
        }
        
        $productos -> name = $request->name;
        $productos -> stock = $request->stock;
        $productos -> price = $request->price;
        $productos -> category_id = $request->category_id;
        $productos -> store_id = $tienda->id;
        $productos -> color = $request->color;
        $productos->save(); 
        session()->forget('success');
        session()->forget('delete');
        session()->flash('update','Producto actualizado exitosamente.');
        $StoreP=Store::where('user_id',Auth::user()->id)->first();
        $productos=Product::where('store_id',$StoreP->id)->get();
        return view('Vendedor.Tienda.Producto.index', compact('productos'));
    }

    //Eliminar Productos
    public function destroy($id)
    {
        Product::destroy($id);
        
        session()->flash('delete','Producto eliminado exitosamente.');
        $StoreP=Store::where('user_id',Auth::user()->id)->first();
        $productos=Product::where('store_id',$StoreP->id)->get();
        return view('Vendedor.Tienda.Producto.index', compact('productos'));
    }

    public function indexHome()
    {
        $StoreP=Store::where('user_id',Auth::user()->id)->first();
        $productos=Product::where('store_id',$StoreP->id)->get();
        return view('Vendedor.Tienda.Producto.index',compact('productos'));
    }

    public function productoindex($id){
        $producto=Product::find($id);
        return view('Cliente.Producto.indexProducto',compact('producto'));
    }

    public function categoriaProducto($id){
        $productos=Product::Where('category_id',$id)->where('status',0)->paginate(8);
        return view('Cliente.Categoria.ProductoCategoria',compact('productos'));
    }

    public function cambiarEstadoProducto($id){

        $productos=Product::find($id);
        
        if($productos->status==0){
            $productos->status=1;
            $productos->save();
            return back();
        }
        if($productos->status==1){
            $productos->status=0;
            $productos->save();
            return back();
        }

    }
}
