<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStore;
use App\Models\Shipping;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('Repartidor.homeRepartidor');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function agregarVehiculo(Request $request)
    {
        $vehiculo= new Vehicle();
        $vehiculo->number_plate=$request->placa;
        $vehiculo->vehicle_type=$request->tipo;
        $vehiculo->user_id=Auth::user()->id;

        if(!$request->img==null){
            $imagen=$request->img->store('uploads','public');
            $url= Storage::url($imagen);
            $vehiculo -> img = $url;
        }
        $vehiculo->save();

        return view('Repartidor.homeRepartidor');
    }
    public function crearOrdenEnvio($id)
    {
        $orden=Order::find($id);
        $envio = new Shipping();
        $envio->order_id=$orden->id;
        $envio->delivery_id=Auth::user()->id;
        $envio->shipping_cost=$orden->shipping_cost;
        $envio->user_id=$orden->user_id;
        $envio->status=0;
        $envio->save();
        return view('Repartidor.Orden.detalle',compact('envio','orden'));
    }
    public function buscarOrdenes()
    {
        $ordenes=Order::where('status_customer',0)->where('status',1)->get();
        $contadorTotal=0;
        $ordenesDisponibles = collect();
        foreach($ordenes as $orden){
            $contadorTotal=OrderStore::where('order_id',$orden->id)->get()->count();
            $contadorDisponibles=OrderStore::where('order_id',$orden->id)->where('status',1)->get()->count();
            if($contadorTotal==$contadorDisponibles){
                $ordenesDisponibles -> push($orden);
            }
        }
        return view('Repartidor.Orden.buscar',compact('ordenesDisponibles'));
    }


    public function historialOrden(){
        return view('Repartidor.Orden.historial');

    }
    public function buscarOrden(){
        return view('Repartidor.Orden.buscar');
    }
    
    
    public function ordenActiva(){
        $envio=Shipping::where('delivery_id',Auth::user()->id)->where('status',0)->first();
        return view('Repartidor.Orden.activa',compact('envio'));
    }

    public function perfil(){
        return view('Repartidor.Perfil.perfil');
    }

}
