<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class StoreController extends Controller
{
    //listado de Tienda
    public function index()
    {
        
        return view('Vendedor.homeVendedor');
        //return view('Vendedor.Tienda.homeTienda', compact('tiendas'));
    }

    //Formulario de crear Tienda
    public function create()
    {
        return view('Vendedor.Tienda.create');
    }

    //Guardar  Tienda
    public function store(Request $request)
    {

        $users = Auth::user();
        $store = new Store();
        if(!$request->img==null){
            $imagen=$request->img->store('uploads','public');
            $url= Storage::url($imagen);
            $store->logo = $url;
        }
        $store -> name = $request->nombre;

        $direccion= new Address();
        $direccion->address_longitude=$request->longitude;
        $direccion->address_latitude=$request->latitude;
        $direccion->name=$request->direccion;
        $direccion->address=$request->direccion;
        $direccion->save();
        
        $store -> address_id =$direccion->id; 
        $store -> cellphone = $request->telefono;
        $store -> email =  $users->email;
        $store -> rubro = $request->rubro;
        $store -> user_id = $users->id;
        $store->save();
        $users->removeRole('Seller');
        $users->assignRole('Store');    
        session()->flash('success','La tienda fue creada exitosamente.');
        return view('Vendedor.Tienda.homeTienda', compact('store'));
    }

    //NI IDEA 
    public function show($id)
    {
        //
    }
    
    public function verTienda()
    {
        $store=Store::where('user_id',Auth::user()->id)->first();
        return view('Vendedor.Tienda.homeTienda', compact('store'));
    }

    //Formulario de editar Tienda
    public function edit($id)
    {
        return view('');
        
    }

    //Actualizar Tienda
    public function update(Request $request, $id)
    {
        $store = Store::find($id);
        $direccion= Address::find($store->address->id);

        if(!$request->img==null){
            $imagen=$request->img->store('uploads','public');
            $url= Storage::url($imagen);
            $store->logo = $url;
        }
        $direccion->address_longitude=$request->longitude;
        $direccion->address_latitude=$request->latitude;
        $direccion->name=$request->address;
        $direccion->address=$request->address;
        $direccion->save();
        if(isEmpty($request->name)){

        }else{
            $store=$request->name;
        }
        if(isEmpty($request->cellphone)){

        }else{
            $store=$request->name;
        }
        if(isEmpty($request->rubro)){

        }else{
            $store=$request->name;
        }
        $store->save();

        return view('Vendedor.Tienda.homeTienda', compact('store'));
    }

    //Eliminar Tienda
    public function destroy($id)
    {   
        $user=Auth::user();
        Store::destroy($id);
        $user->removeRole('Store');
        $user->assignRole('Seller');  
        return redirect()->route('tienda.index');
    
    }
    public function verorden()
    {
        return view('Vendedor.Tienda.Orden.misOrdenes');
    }

    public function tiendaInfo($id){
        $store=Store::find($id);
        return view('Vendedor.Tienda.showTiendaCliente',compact('store'));
    }

    

}
