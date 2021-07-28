<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStore;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    //listado de Orden
    public function index()
    {
        //
    }

    //Formulario de crear Orden
    public function create()
    {
        //
    }

    public function totalOrdenes()
    {
        return response()->json([
            'mensaje'=> 'RESPUESTA EXITOSA DE AJAX'
        ]);
    }


    //Guardar Orden
    public function store(Request $request)
    {
        //PRIMERO CREO UNA ORDEN CON EL TOTAL DE LA COMPRA PARA MOSTRARLA AL CLIENTE
        $cart=Cart::find($request->cart_id);
        $order=new Order();
        $order->status_customer=0;
        $order->order_at=Carbon::now()->toDateTimeString();
        $order->status=0;
        $order->total= $cart->total;
        $order->shipping_cost=precioEnvioTotal();
        $order->user_id=Auth::user()->id;
        
        $cartProduct=CartProduct::where('cart_id',$cart->id)->get();
        $quantity=0;
        foreach($cartProduct as $product){
            $quantity=$quantity+$product->quantity;
        }

        $order->quantity=$quantity;
        $order->save();
        
        //BUSCO LOS PRODUCTOS PAGADOS PARA CREAR ORDENES SEPARADAS
        foreach($cartProduct as $cProduct){
            $prod[]=$cProduct->productos->store_id;
        }
        $tienda=array_unique($prod, SORT_REGULAR);
        //GUARDO LAS TIENDAS QUE SE ENCUENTRAN EN LA ORDEN Y SOLO ME MUESTRA 1 VEZ LA TIENDA ()
        
        //[tienda 1, tienda2, etc], la tienda 1 y entra en el foreach
        
        foreach($tienda as $id){
            $orderStore=new OrderStore();
            $orderStore->order_at=Carbon::now()->toDateTimeString();
            $orderStore->status=0;
            $totalCompra=Item::where('order_id',$order->id)->where('store_id',$id)->get();
            $total=0;
            $num=0;
            foreach($totalCompra as $item){
                $num=$item->quantity * $item->price;
                $total= $total+$num;
            }
            $orderStore->total=$total;
            $orderStore->store_id=$id;
            $orderStore->order_id=$order->id;
            $orderStore->save();
        }
        return view('Cliente.Orden.index',compact('order'));    
    }

    //NI IDEA 
    public function show($id)
    {
        //
    }

    //Formulario de editar Orden
    public function edit($id)
    {
        //
    }

    //Actualizar Orden
    public function update(Request $request, $id)
    {
        //
    }

    //Eliminar Orden
    public function destroy($id)
    {
        //
    }
    public function ordenesCliente()
    {
        return view('Cliente.Orden.misOrdenes');
    }
    public function detalleOrden($id)
    {
        $items=Item::where('order_id',$id)->get();
        $orden=Order::find($id);
        return view('Cliente.Orden.miDetalleOrden',compact('items','orden'));
    }
    
    public function detalleOrdenVendedor($order)
    {
        $store=Store::where('user_id',Auth::user()->id)->first();
        $orderStore=OrderStore::where('order_id',$order)->first();
        $items=Item::where('order_id',$order)->where('store_id',$orderStore->store_id)->get();
        $orden=Order::find($orderStore->orden->id);
        return view('Vendedor.Tienda.Orden.detalleOrden',compact('items','orden','orderStore'));
    }


    public function pay(Order $order, Request $request )
    {
        $payment_id= $request->get('payment_id');
        $response=Http::get("https://api.mercadopago.com/v1/payments/$payment_id"."?access_token=APP_USR-2228452056906864-071207-b2373a867b25992d210cda7f002b4797-789782884");
        $response=json_decode($response);
        $status=$request->status;
        if($status =='approved'){
            $pay= new Payment();
            $pay->amount=$order->total;
            $pay->provider='MercadoPago';
            $pay->status=1;
            $pay->payed_at=Carbon::now()->toDateTimeString();
            $pay->save();
            $ordenStore=OrderStore::where('order_id',$order->id)->get();
            foreach($ordenStore as $ordens){
                $items=Item::where('order_id',$order->id)->where('store_id',$ordens->store_id)->get();
                $cum=0;
                $cont=0;
                foreach($items as $item){
                    $cont=$item->quantity*$item->price;
                    $cum=$cum+$cont;
                }
                $ordens->total=$cum;
                
                $pay= new Payment();
                $pay->amount=$cum;
                $pay->provider='MercadoPago';
                $pay->status=1;
                $pay->payed_at=Carbon::now()->toDateTimeString();
                $pay->save();
                $ordens->status=1;
                $ordens->payment_id=$pay->id;
                $ordens->save();
            }
            $order->status=1;
            $order->payment_id=$pay->id;
            $order->save();
            return view('Cliente.Orden.confirmacion');
        }
        if($status =='pending'){

            $pay= new Payment();
            $pay->amount=$order->total;
            $pay->provider='MercadoPago';
            $pay->status=0;
            $pay->payed_at=Carbon::now()->toDateTimeString();
            $pay->save();
            $ordenStore=OrderStore::where('order_id',$order->id)->get();
            foreach($ordenStore as $ordens){
                $items=Item::where('order_id',$order->id)->where('store_id',$ordens->store_id);
                $cum=0;
                foreach($items as $item){
                    $cum=$cum+($item->quantity*$item->price);
                }

                $pay= new Payment();
                $pay->amount=$cum;
                $pay->provider='MercadoPago';
                $pay->status=0;
                $pay->payed_at=Carbon::now()->toDateTimeString();
                $pay->save();
            }
            $order->status=0;
            $order->payment_id=$pay->id;
            $order->save();
            return view('Cliente.Orden.fallo');
        }
        
    }

    function cambiarEstadoOrden($id){
        $orderStore=OrderStore::find($id);
        $orderStore->status=3; //Estado cambia a 3 osea disponible para el despacho
        $orderStore->save();
        return back();
    }



}
