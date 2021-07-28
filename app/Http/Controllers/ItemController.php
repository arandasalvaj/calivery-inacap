<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStore;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    //listado de item
    public function index()
    {
        //
    }

    //Formulario de crear item
    public function create()
    {
        //
    }

    //Guardar item
    public function store(Request $request)
    {
        /////OBTENER CARRO
        $usuario=User::find(Auth::user()->id);
        $cart=Cart::where('user_id',Auth::user()->id)->first();
        $cartProduct=CartProduct::where('cart_id',$cart->id)->get();
        /////OBTENER CARRO

        /////GUARDAR ITEM
        foreach($cartProduct as $cProduct){
            $item = new Item();
            $item->name=$cProduct->productos->name;
            $item->price=$cProduct->productos->price;
            $item->detail=$cProduct->productos->detail;
            $item->img=$cProduct->productos->img;
            $item->color=$cProduct->productos->color;
            $item->size=$cProduct->productos->size;
            $item->product_id=$cProduct->productos->id;
            $item->order_id=$request->idOrden;
            $item->quantity=$cProduct->quantity;
            $item->store_id=$cProduct->productos->store_id;
            $item->save();

            $producto=Product::find($cProduct->productos->id);///BUSCAR PRODUCTO
            $qty=$producto->stock-$cProduct->quantity;////RESTAR STOCK DEL CARRO CON EL STOCK DEL PRODUCTO ORIGINAL
            $producto->stock=$qty;///ASIGNAR STOCK NUEVO AL PRODUCTO ORIGINAL CON EL DESCUENTO CORRESPONDIENTE
            $producto->save();////GUARDAR CAMBIONS DEL PRODUCTO ORIIGINAL
            
            $carts=Cart::find($cProduct->cart_id);
            CartProduct::destroy($cProduct->id);
            $carros=CartProduct::where('cart_id',$carts->id)->get();
            $total=0;
            $quantity=0;
            foreach($carros as $carro){
                $total=$total+$carro->subtotal;
                $quantity=$quantity+$carro->quantity;
            }
            $carts->total=$total;
            $carts->quantity=$quantity;
            $carts->save();
        }
        if(Auth::user()->address==null){
            $direccion= new Address();
            $direccion->address_longitude=$request->longitude;
            $direccion->address_latitude=$request->latitude;
            $direccion->name=$request->direccion;
            $direccion->address=$request->direccion;
            $direccion->save();
            $usuario->address_id=$direccion->id;
        }
        $usuario->cellphone=$request->cellphone;
        $usuario->rut=$request->rut;
        $usuario->save();
        $order= Order::find($request->idOrden);
        $items=Item::where('order_id',$order->id)->get();
        return view('Cliente.Orden.detailOrder',compact('items', 'order'));
    }

    //NI IDEA 
    public function show($id)
    {
        //
    }

    //Formulario de editar item
    public function edit($id)
    {
        //
    }

    //Actualizar item
    public function update(Request $request, $id)
    {
        //
    }

    //Eliminar item
    public function destroy($id)
    {
        //
    }
}
