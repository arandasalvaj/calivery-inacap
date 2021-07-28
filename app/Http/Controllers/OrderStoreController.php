<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //---------------------------------------------------------------
        $cart=Cart::find($request->cart_id);
        $cartProduct=CartProduct::where('cart_id',$cart->id)->get();
        //BUSCO LOS PRODUCTOS PAGADOS

        foreach($cartProduct as $cProduct){
            $prod[]=$cProduct->productos->store_id;
        }
        $tienda=array_unique($prod, SORT_REGULAR);
        //GUARDO LAS TIENDAS QUE SE ENCUENTRAN EN LA ORDEN Y SOLO ME MUESTRA 1 VEZ LA TIENDA ()
        
        foreach($tienda as $id){//[tienda 1, tienda2, etc], la tienda 1 y entra en el foreach

            $totalOrden=$request->envio+$request->total;
            $idOrden=$request->id;
            $orderStore=new OrderStore();
            $orderStore->order_at=Carbon::now()->toDateTimeString();
            $orderStore->status=0;
            $orderStore->total=$totalOrden;
            $orderStore->store_id=$id;
            $orderStore->order_id=$idOrden;
            $orderStore->shipping_cost=$request->envio;
            $orderStore->save();
        }

        return view('Cliente.Orden.index',compact('idOrden'));
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

}
