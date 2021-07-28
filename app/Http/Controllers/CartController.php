<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Listado de carro
    public function index()
    {
        return view('Cliente.Carro.index');
    }

    //Formulario crear de carro
    public function create()
    {
        //
    }
    //Guardar carro
    //'quantity','total','user_id' CART
    //'quantity','subtotal','product_id','cart_id' PRODUCT_CART
    public function store(Request $request)
    {

        $user=Auth::user();

        $product= Product::find($request->product_id);

        if(!Cart::where('user_id',$user->id)->exists()){
            $carts=new Cart();
            $carts->quantity=0;
            $carts->total=0;
            $carts->user_id=$user->id;
            $carts->save();
        }
        $carts=Cart::where('user_id',$user->id)->get();
            foreach($carts as $cart){
                if(CartProduct::where('cart_id',$cart->id)->where('product_id',$product->id)->exists()){
                    $newCart=CartProduct::where('cart_id',$cart->id)->where('product_id',$product->id)->get();
                    foreach($newCart as $ncart){
                        $newCart=$ncart;
                        $newCart->quantity=$newCart->quantity+$request->quantity;
                        $newCart->subtotal=$newCart->quantity*$product->price;
                    }
                    $newCart->save();
                    $carros=CartProduct::all();
                    $total=0;
                    $quantity=0;
                    foreach($carros as $carro){
                        $total=$total+$carro->subtotal;
                        $quantity=$quantity+$carro->quantity;
                    }
                    $cart->total=$total;
                    $cart->quantity=$quantity;
                    $cart->save();
                    return back();
                }
            }

        $newCart =new CartProduct();
        foreach($carts as $cart){
            $newCart->cart_id=$cart->id;
            $carts=$cart;
        }
        $newCart->product_id=$product->id;
        $newCart->quantity=$request->quantity;
        $newCart->subtotal=$request->quantity*$product->price;
        $newCart->store_id=$product->store_id;
        $newCart->save();
        $carros=CartProduct::all();
        $total=0;
        $quantity=0;
        foreach($carros as $carro){
            $total=$total+$carro->subtotal;
            $quantity=$quantity+$carro->quantity;
        }
        $carts->total=$total;
        $carts->quantity=$quantity;
        $carts->save();
        return back();
    }

    //Ni Idea
    public function show($id)
    {
        //
    }

    //Formulario editar de carro
    public function edit($id)
    {
        //
    }

    //Actualizar carro
    public function update(Request $request, $id)
    {
        $cartProduct=CartProduct::find($id);
        $cartProduct->quantity=$request->quantity;
        $cartProduct->subtotal=$request->quantity*$request->price;
        $cartProduct->save();

        
        $carros=CartProduct::all();
        $total=0;
        $quantity=0;
        foreach($carros as $carro){
            $total=$total+$carro->subtotal;
            $quantity=$quantity+$carro->quantity;
        }


        $carts=Cart::find($cartProduct->cart_id);
        $carts->total=$total;
        $carts->quantity=$quantity;
        $carts->save();
        return back();
    }

    //Eliminar de carro
    public function destroy($id)
    {
        $cProduct=CartProduct::where('id',$id)->first();
        $carts=Cart::find($cProduct->cart_id);
        CartProduct::destroy($id);
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
        return back();
    }
}
