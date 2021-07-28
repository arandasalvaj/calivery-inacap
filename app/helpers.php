<?php

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStore;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Store;
use App\Models\StoreTime;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
//CARRO DE COMPRAS
function contadorCart(){

    $cantidad=Cart::select('quantity')->where('user_id',Auth::user()->id)->first();
    $count = Arr::get($cantidad, 'quantity');
    return $count;
    
}
///PARA EL VENDEDOR
function precioEnvioTotal(){

    $carro = Cart::where('user_id',Auth::user()->id)->first();
    $total=0;
    $cartProduct=CartProduct::where('cart_id',$carro->id)->get();
    
    foreach($cartProduct as $cProduct){
        $prod[]=$cProduct->productos->store_id;
    }
    $tienda=array_unique($prod, SORT_REGULAR);

    foreach($tienda as $cartP){
        $total=$total+precioEnvioOrden($cartP);
    }
    return $total;
}
////PARA EL CLIENTE
function precioEnvioTotalCliente(){

    $carro = Cart::where('user_id',Auth::user()->id)->first();
    $total=0;
    $cartProduct=CartProduct::where('cart_id',$carro->id)->get();
    
    foreach($cartProduct as $cProduct){
        $prod[]=$cProduct->productos->store_id;
    }
    $tienda=array_unique($prod, SORT_REGULAR);

    foreach($tienda as $cartP){
        $total=$total+precioEnvioOrden($cartP);
    }
    return $total;
}
function CantidadEnvioProducto($storeId){
    $carro = Cart::where('user_id',Auth::user()->id)->first();
    $quantity=0;
    $cartProduct=CartProduct::where('store_id',$storeId)->where('cart_id',$carro->id)->get();
    foreach($cartProduct as $cartP){
        $quantity=$quantity+$cartP->quantity;
    }
    return $quantity;
}

//////////////////
/////////////////
/////////////////
////////////////
//////////////////
/////////////////
////////////////
////////////////
function precioEnvioOrden($storeId){

    $carro = Cart::where('user_id',Auth::user()->id)->first();
    $quantity=0;
    $cartProduct=CartProduct::where('store_id',$storeId)->where('cart_id',$carro->id)->get();
    foreach($cartProduct as $cartP){
        $quantity=$quantity+$cartP->quantity;
    }

    if($quantity==1){
        return $quantity=1500;
    }
    if ($quantity>=2) {
        $inicio=1500;       
        $quantity=$quantity-1;
        $quantity=$quantity*500;
        $quantity=$quantity+$inicio;
        return $quantity;
    }


}

function carrito(){
    $user=Auth::user();

    $Carts=Cart::where('user_id',$user->id)->get();
    foreach ($Carts as $cart) {
        $products= Product::where('id',$cart->product_id)->get();
    }
    return $Carts;
}
function vaciarCarro(){
    $carts=Cart::all();
    foreach($carts as $cart){
        Cart::destroy($cart->id);
    }
}

function ordenesC(){
    $user=Auth::user();
    $ordenes= Order::where('user_id',$user->id)->get();
    return $ordenes;
}

function productos(){
    $products=Product::where('status',0)->get();
    return $products;
}

function tienda(){
    $tienda=Store::where('user_id',Auth::user()->id)->get();
    return $tienda;
}
function productosCart(){
    $cart=Cart::where('user_id',Auth::user()->id)->first();
    return CartProduct::where('cart_id',$cart->id)->get();
}

function cart(){
    return Cart::where('user_id',Auth::user()->id)->first();
}


function ordenesS(){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $ordenes= Order::where('store_id',$store->id)->get();
    return $ordenes;
}
function ordenesProductos($id){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $ordenProducto=OrderProduct::where('order_id',$id)->get();
    return $ordenProducto;
}

function store($id){

    return Store::where('id',$id)->first();

}
function categoriaProducto($id){
    return Product::where('category_id',$id)->get();
}
function categorias(){
    return Category::all();
}

//OBTIENE TODAS LAS ORDENES DE UN VENDEDOR EN ESPECIFICO
function totalOrdenesVendedor(){

    $user=Auth::user();
    $store=Store::where('user_id',$user->id)->first();
    $orderS= OrderStore::where('store_id',$store->id)->get();

    //$items=Item::where('order_id',$orderS->order_id)->where('store_id',$orderS->store_id)->get();
    //foreach($items as $item){
   //     $contador=$item->price*$item->quantity;
        
    //}
   // $orderS->total=$contador;
    //$orderS->save();
    return$orderS;
}
function estadoOrdenes(){
    $user=Auth::user();
    $store=Store::where('user_id',$user->id)->first();
    $orderS= OrderStore::where('store_id',$store->id)->get();
    if($orderS->isEmpty()){
        return true;
    }else{
        return false;
    }
}

function TotalOrdenesNoConfirmadas(){
    $user=Auth::user();
    $store=Store::where('user_id',$user->id)->first();
    $orderS= OrderStore::where('store_id',$store->id)->get();
    //$coleccion=collect();
    //foreach($orderS as $ord){
        //$ordenes=Order::where('id',$ord->order_id)->first();
        //$coleccion->push($ordenes);
   // }
    return $orderS;
}

function buscarOrden($id){
    $user=Auth::user();
    $store=Store::where('user_id',$user->id)->first();
    $orderS= OrderStore::where('store_id',$store->id)->where('order_id',$id)->first();
    return$orderS;
}

function totalOrdenes(){
    $user=Auth::user();
    $store=Store::where('user_id',$user->id)->first();
    $orderS= OrderStore::select('total')->where('store_id',$store->id)->get();
    return$orderS;
}


//OBTIENE EL DETALLE DE LA ORDEN EN ESPECIFICO
function ordenesVendedorEspecifico($orderStore){

    $orderS=OrderStore::find($orderStore->id);
    $items=Item::where('order_id',$orderStore->order_id)->where('store_id',$orderStore->store_id)->get();
    foreach($items as $item){
        $contador=$item->price*$item->quantity;
        
    }
    $orderS->total=$contador;
    $orderS->save();

    return $items;
}

function productosCategoria($idCategoria){
    $productos=Product::where('category_id',$idCategoria)->get();
    return $productos;
}

function productosTienda($idTienda){
    $productos=Product::where('store_id',$idTienda)->get();
    return $productos;
}

function estadoProducto(){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $productos=Product::where('store_id',$store->id)->where('status',0)->get()->count();
    return $productos;
}
function cantidadProductos(){
    
    $productos=Product::where('store_id',Auth::user()->id)->count();
    return $productos;
}
function estadoCambioProducto($id){
    $producto=Product::find($id);
    if($producto->status==1){
        return false;
    }
    if($producto->status==0){
        return true;
    }
    
}

function str_limit($value){
    $end = '...';
    $limit = 15 ;
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}


function tiendas(){
    return store::all();
}

function direccion(){
    return Auth::user();
}
function direccionReal(){
    return Auth::user()->address->name;
}
function verificarEstadoOrden($id){
    $user=Auth::user();
    $store=Store::where('user_id',$user->id)->first();
    $orderS= OrderStore::select('status')->where('order_id',$id)->where('store_id',$store->id)->first();
    if($orderS=='0'){
        return false;
    }else{
        return true;
    }
}

function numeroTiendasOrden($id){
    $contadorTotal=OrderStore::where('order_id',$id)->get()->count();
    return $contadorTotal;
}

function buscarTiendasOrden($id){
    $tiendas=OrderStore::where('order_id',$id)->get();
    return $tiendas;
}
function buscarTiendas($id){
    $tienda=Store::where('user_id',$id)->first();
    return $tienda;
}
function cantidadProductosOrdenStore($id){
    $orderStore=OrderStore::find($id);
    $items=Item::where('order_id',$orderStore->orden->id)->where('store_id',$orderStore->store->id)->get();
    $contador=0;
    foreach ($items as $item) {
        $contador=$contador+$item->quantity;
    }
    return $contador;
}

function cantidadProductosOrden($id){
    $orderStore=OrderStore::find($id);
    $items=Item::where('order_id',$orderStore->orden->id)->where('store_id',$orderStore->store->id)->get();
    $contador=0;
    foreach ($items as $item) {
        $contador++;
    }
    return $contador;
}



function totalOrdenesPanel(){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $tiendas=OrderStore::where('store_id',$store->id)->where('status',1)->get();
    $acumulador=0;
    foreach($tiendas as $tienda){
        $ordenes=Order::where('id',$tienda->order_id)->get();
        
        foreach($ordenes as $orden){
            if($orden->status_customer==1){
                $acumulador=$acumulador+1;
            }
        }
    }
    return $acumulador;
}

function totalOrdenHoy(){
    $date = new Carbon('tomorrow');
    $today = Carbon::today(); 
    $store=Store::where('user_id',Auth::user()->id)->first();
    $tiendas=OrderStore::where('store_id',$store->id)->where('status',1)->get();
    $count=0;
    foreach($tiendas as $tienda){
        $ordenes=Order::where('id',$tienda->order_id)->get();
        foreach($ordenes as $orden){
            if($orden->status_customer==0){
                $fecha =$orden->order_at;
                if($fecha > $today && $fecha < $date){
                    $count=$count+1;
                }
            }
        }
    }
    return $count;  
}

function tiempoHoy(){
    $date= Carbon::today()->toDateString();
    return $date;
}

function tiempoSemana(){
    $date=Carbon::today()->addWeek()->toDateString();
    return $date;
}
function tiempoSemanaUpdate($id){
    $horario=StoreTime::find($id);
    $hor= Carbon::parse($horario->time_end)->addWeek()->toDateString();
    
    return $hor;
}
function tiempoInicioUpdate($id){
    $horario=StoreTime::find($id);
    $hor= Carbon::parse($horario->time_start)->toDateString();
    
    return $hor;
}

function tiempoTerminoUpdate($id){
    $horario=StoreTime::find($id);
    $hor= Carbon::parse($horario->time_end)->toDateString();
    
    return $hor;
}
function tiempo(){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $storeTime=StoreTime::where('store_id',$store->id)->get();
    if($storeTime->isEmpty()){
        return "";
    }else{
        foreach($storeTime as $time){
            $prod[]=$time->time_start;
        }
        $tienda=array_unique($prod, SORT_REGULAR);
    
        return $tienda;
    }

}
function tiempoFin(){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $storeTime=StoreTime::where('store_id',$store->id)->get();
    foreach($storeTime as $time){
        $prod[]=$time->time_start;
    }
    $tienda=array_unique($prod, SORT_REGULAR);
    
    $mayor= new Carbon();
    foreach($tienda as $tiend){
        $time=Carbon::parse($tiend);
        foreach($tienda as $ti){
            if($time>$ti){
                $mayor=Carbon::parse($ti);
            }
        }
        
    }
    $fechat=Carbon::parse($tienda);
    return $tienda;
}


function todosProductos(){
    $productos=Product::all();
    return $productos;
}

function existeHorario(){
    $store=Store::where('user_id',Auth::user()->id)->first();
    $storeT=StoreTime::where('store_id',$store->id)->get();
    if($storeT->isEmpty()){
        return false;
    }else{
        return true;
    }
}

function vehiculoRepartidor(){
    $vehiculo=Vehicle::where('user_id',Auth::user()->id)->first();
    return $vehiculo;
}


function totalOrdenesRepartidor(){
    $ordenes=Shipping::where('delivery_id',Auth::user()->id)->first();
    return $ordenes;
}

function ordenesRepartir(){
    $orderStore=OrderStore::where('status',3)->get();
    return $orderStore;
}

function ordenesDisponibleReparto(){
    $orderStore=OrderStore::where('status',3)->get();
    if($orderStore->isEmpty()){
        return false;
    }
    return true;
}
function envioRepartidorCosto($idOrden,$idStore){

    $items=Item::where('order_id',$idOrden)->where('store_id',$idStore)->get();
    $quantity=0;
    foreach($items as $cartP){
        $quantity=$quantity+$cartP->quantity;
    }

    if($quantity==1){
        return $quantity=1500;
    }
    if ($quantity>=2) {
        $inicio=1500;       
        $quantity=$quantity-1;
        $quantity=$quantity*500;
        $quantity=$quantity+$inicio;
        return $quantity;
    }
}

function articulosRepartidor($idOrden,$idStore){

    $items=Item::where('order_id',$idOrden)->where('store_id',$idStore)->get();
    $quantity=0;
    foreach($items as $cartP){
        $quantity=$quantity+$cartP->quantity;
    }

    return $quantity;
    
}


function envioActivoActual(){
    $envio = Shipping::where('delivery_id',Auth::user()->id)->get();
    foreach($envio as $env){
        if($env->status==1  || $env->status==2){
            return true;
        }
    }
    return false;
}
function estadoShippingVendedor(){
    $envio = Shipping::where('delivery_id',Auth::user()->id)->get();
    foreach($envio as $env){
        if($env->status==1){
            return true;
        }
    }
    return false;

}
function estadoShippingCliente(){
    $envio = Shipping::where('delivery_id',Auth::user()->id)->get();

    foreach ($envio as $env) {
        if($env->status==2){
            return true;
        }
    }
    return false;
}

function envioActivoVendedor(){
    $envio = Shipping::where('delivery_id',Auth::user()->id)->where('status',1)->first();
    if(!$envio==null){
        return $envio;
    }
}


function envioActivoCliente(){
    $envio = Shipping::where('delivery_id',Auth::user()->id)->where('status',2)->first();
    if(!$envio==null){
        return $envio;
    }
}

function buscarItem($idOrden, $idStore){
    $item= Item::where('order_id',$idOrden)->where('store_id',$idStore)->get();
    return $item;
}

function buscarDireccionTienda($idStore){
    $tienda= Store::find($idStore);
    return $tienda;
}
function buscarDireccionCliente($idStore){
    $tienda= Store::find($idStore);
    return $tienda;
}
function buscarHistorialDelivery(){
    $envios=Shipping::where('status',3)->where('delivery_id',Auth::user()->id)->get();
    return $envios;
}
function saldoRepartidor(){
    $envios=Shipping::where('status',3)->where('delivery_id',Auth::user()->id)->get();
    $total=0;
    foreach($envios as $envio){
        
        $total=$total+$envio->shipping_cost;
    }
    return $total;
}

