<?php

namespace App\Http\Controllers;

use App\Models\OrderStore;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    //listado de Envio seguimiento
    public function index()
    {
        //
    }

    //Formulario de Envio seguimiento
    public function create()
    {
        //
    }

    //Guardar seguimiento
    public function store(Request $request, $id)
    {
        // ['id','status','delivery_id','shipping_cost','user_id','created_at','orderStore_id'];
        $orderStore=OrderStore::where('id',$id)->first();
        $envio = new Shipping();
        $envio->status=1;
        $envio->delivery_id=Auth::user()->id;
        $envio->user_id=$orderStore->orden->user->id;
        $envio->orderStore_id=$id;
        $envio->shipping_cost=envioRepartidorCosto($orderStore->order_id,$orderStore->store_id);
        $envio->save();
        $orderStore->status=4;
        $orderStore->save();
        return view('Repartidor.Orden.activa',compact('envio'));

    }

    //NI IDEA
    public function show($id)
    {
        //
    }

    //Formulario de editar seguimiento
    public function edit($id)
    {
        //
    }

    //Actualizar seguimiento
    public function update(Request $request, $id)
    {
        //
    }

    //Eliminar seguimiento
    public function destroy($id)
    {
        //
    }
    public function estadoEnvioCambio(Request $request)
    {
        $envio=Shipping::find($request->id);
        $envio->status=$request->status;
        if($request->status==3){
            $orderStore=OrderStore::find($envio->orderStore_id);
            $orderStore->status=5;
            $orderStore->save();
        }
        $envio->save();
        return back();
    }

    public function paginaSeguimiento()
    {
        return view('paginaSeguimiento');
    }
    public function paginaSeguimientoBuscar(Request $request)
    {

        $numero=strval($request->numero);

        
        $nseguimiento=explode( '000', $numero );
        
        $envio=Shipping::find($nseguimiento[1]);
        
        return view('seguimiento',compact('envio'));
    }
}
